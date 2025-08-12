<?php

// app/Console/Commands/ProcessPlanMaturities.php
namespace App\Console\Commands;

use App\Models\UserLockedPlan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ProcessPlanMaturities extends Command
{
    protected $signature = 'plans:process-maturities';
    protected $description = 'Process matured investment plans';

    public function handle()
    {
        $maturedPlans = UserLockedPlan::with(['user', 'plan'])
            ->where('status', 'active')
            ->where('end_date', '<=', now())
            ->get();

        foreach ($maturedPlans as $plan) {
            DB::transaction(function () use ($plan) {
                // Mark as completed
                $plan->update(['status' => 'completed']);
                
                // Add yield to user balance
                $plan->user->increment('balance_usd', $plan->expected_yield);
                
                // Record transaction
                $plan->user->transactions()->create([
                    'type' => 'plan_matured',
                    'amount' => $plan->expected_yield,
                    'status' => 'completed',
                    'meta' => [
                        'plan_name' => $plan->plan->name,
                        'original_amount' => $plan->amount,
                        'locked_plan_id' => $plan->id,
                    ]
                ]);
            });
        }

        $this->info("Processed {$maturedPlans->count()} matured plans.");
    }
}