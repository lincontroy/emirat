<?php

// app/Http/Controllers/InvestmentPlanController.php
namespace App\Http\Controllers;

use App\Models\InvestmentPlan;
use App\Models\UserLockedPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Mail\NewKYCSubmissionNotification;
use Illuminate\Support\Facades\Mail;

class InvestmentPlanController extends Controller
{
    public function index()
{
    $plans = InvestmentPlan::where('is_active', true)->get();
    
    $lockedPlans = auth()->user()->lockedPlans()
                      ->with('plan')
                      ->active() // Now this will work
                      ->latest()
                      ->get();

    return view('plans', compact('plans', 'lockedPlans'));
}

public function lock(Request $request)
{
    $request->validate([
        'plan_id' => ['required', 'exists:investment_plans,id'],
        'amount' => ['required', 'numeric', 'min:0.00000001'],
    ]);

    $plan = InvestmentPlan::findOrFail($request->plan_id);
    $user = $request->user();

    if ($user->balance_usd < $request->amount) {
        return back()->withErrors(['amount' => 'Insufficient balance']);
    }

    if ($request->amount < $plan->min_amount) {
        return back()->withErrors(['amount' => "Minimum amount is {$plan->min_amount} USD"]);
    }

    return DB::transaction(function () use ($user, $plan, $request) {
        // Calculate expected yield based on APY and duration
        $principal = $request->amount;
        $apy = $plan->apy; // Annual Percentage Yield (in percentage)
        $durationDays = $plan->duration_days;
        
        // Formula: Yield = Principal × (APY/100) × (Duration in days/365)
        $expectedYield = $principal * ($apy / 100) * ($durationDays / 365);

        // Deduct from user balance
        $user->decrement('balance_usd', $principal);

        // Create locked plan
        $lockedPlan = UserLockedPlan::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'amount' => $principal,
            'expected_yield' => $expectedYield,
            'start_date' => now(),
            'end_date' => now()->addDays($durationDays),
            'status' => 'active',
        ]);

        // Create transaction record
        $user->transactions()->create([
            'type' => 'plan_lock',
            'amount' => $principal,
            'status' => 'completed',
            'meta' => [
                'plan_name' => $plan->name,
                'plan_id' => $plan->id,
                'locked_plan_id' => $lockedPlan->id,
                'expected_yield' => $expectedYield,
                'maturity_date' => $lockedPlan->end_date,
                'apy' => $apy,
                'duration_days' => $durationDays
            ]
        ]);

        return redirect()->route('plans.index')
            ->with('success', "Successfully locked {$principal} USD in {$plan->name} plan");
    });
}

    public function unlock(Request $request, UserLockedPlan $lockedPlan)
    {
        if ($lockedPlan->user_id !== $request->user()->id) {
            abort(403);
        }

        if ($lockedPlan->status !== 'active') {
            return back()->withErrors(['plan' => 'Plan is not active']);
        }

        return DB::transaction(function () use ($lockedPlan, $request) {
            $user = $request->user();
            $plan = $lockedPlan->plan;
            $isEarly = $lockedPlan->end_date > now();
            $penalty = $isEarly ? $lockedPlan->amount * ($plan->penalty_percentage / 100) : 0;
            $returnAmount = $lockedPlan->amount - $penalty;

            // Update locked plan
            $lockedPlan->update([
                'status' => $isEarly ? 'early_withdrawn' : 'completed',
                'tx_hash' => 'unlock_'.uniqid(),
            ]);

            // Return funds to user
            $user->increment('balance_usd', $returnAmount);

            // If matured, add yield
            if (!$isEarly) {
                $user->increment('balance_usd', $lockedPlan->expected_yield);
            }

            // Create transaction record
            $user->transactions()->create([
                'type' => $isEarly ? 'early_unlock' : 'plan_matured',
                'amount' => $returnAmount,
                'status' => 'completed',
                'meta' => [
                    'plan_name' => $plan->name,
                    'original_amount' => $lockedPlan->amount,
                    'penalty' => $penalty,
                    'yield' => $isEarly ? 0 : $lockedPlan->expected_yield,
                ]
            ]);

            return back()->with('success', 
                $isEarly 
                    ? "Early withdrawal processed with {$plan->penalty_percentage}% penalty"
                    : "Plan matured! You earned {$lockedPlan->expected_yield} USD yield");
        });
    }
}