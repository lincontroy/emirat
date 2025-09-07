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
use Carbon\Carbon;
use App\Models\User;

class InvestmentPlanController extends Controller
{


    public function processLockedPlans()
    {
        $plans = UserLockedPlan::where('status', 'active')->get();

        foreach ($plans as $plan) {
            $user = User::find($plan->user_id);
            if (!$user) continue;

            $totalPayout = $plan->amount + $plan->expected_yield;
            $days = Carbon::parse($plan->start_date)->diffInDays(Carbon::parse($plan->end_date)) + 1;
            $dailyPayout = $totalPayout / $days;

            // days passed
            $daysPassed = Carbon::parse($plan->start_date)->diffInDays(Carbon::now()) + 1;
            $expectedSoFar = min($daysPassed, $days) * $dailyPayout;

            $alreadyPaid = $plan->paid_out ?? 0; // requires `paid_out` column
            $toPay = $expectedSoFar - $alreadyPaid;

            if ($toPay > 0) {
                DB::transaction(function () use ($user, $plan, $toPay) {
                    $user->increment('balance_usd', $toPay);
                    $plan->paid_out = $plan->paid_out + $toPay;
                    $plan->save();
                });
            }

            if ($plan->paid_out >= $totalPayout) {
                $plan->status = 'completed';
                $plan->save();
                // optionally delete: $plan->delete();
            }
        }

        return response()->json(['message' => 'Locked plans processed successfully.']);
    }
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
            'type' => 'UserLockedPlan',
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

}