@extends('layouts.main')
@section('content')
<section id="dashboard" class="ccontainer-xxl pt-5">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
          <h2 class="section-title mb-0">Overview</h2>
          <p class="section-sub mb-0">Your balances, yields and recent activity</p>
        </div>
       
      </div>

      <div class="row g-3">
        <!-- Summary cards -->
        <div class="col-12 col-md-6 col-xl-4">
          <article class="card h-100" aria-label="Current balance">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted">Current Balance</span>
                <span class="badge badge-gold">USD</span>
              </div>
              <div class="metric" id="currentBalance" data-balance="15240.50">$ {{number_format(auth()->user()->balance_usd, 2) }}</div>
              <div class="metric-sub">Updated <time datetime="2025-08-10T09:00:00Z">today</time></div>
            </div>
          </article>
        </div>
       

<div class="col-12 col-md-6 col-xl-4">
    <article class="card h-100" aria-label="Locked balance">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted">Locked</span>
                <span class="badge text-bg-secondary">In plans</span>
            </div>
            <div class="metric" id="lockedBalance" data-locked="{{ auth()->user()->locked_balance }}">
                ${{ number_format(auth()->user()->locked_balance, 2) }}
            </div>
            <div class="metric-sub">
                Across {{ auth()->user()->active_plans_count }} active plan(s)
            </div>
        </div>
    </article>
</div>
        <div class="col-12 col-md-6 col-xl-4">
          <article class="card h-100" aria-label="Yield">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted">Yield</span>
                <span class="badge badge-emerald">APY</span>
              </div>
              <div class="d-flex align-items-baseline gap-3">
                <div>
                  <div class="metric" id="dailyYield" data-daily-yield="0.034">+0.594%</div>
                  <div class="metric-sub">Avarege yield</div>
                </div>
                
              </div>
            </div>
          </article>
        </div>
        @php
        $plans = App\Models\InvestmentPlan::where('is_active', true)->get();
    
        $lockedPlans = auth()->user()->lockedPlans()
                          ->with('plan')
                          ->active()
                          ->latest()
                          ->get();
    
        // Fetch inactive plans
        $inactivePlans = App\Models\InvestmentPlan::where('is_active', false)->get();
    @endphp
    
    <!-- Active plans -->
    <div class="col-12 col-xl-5">
        <article class="card h-100" aria-label="Active plans">
            <div class="card-header bg-transparent fw-semibold">Active Plans</div>
            <div class="card-body">
                @if($lockedPlans->count())
                    <ul class="list-group list-group-flush" id="activePlans">
                        @foreach($lockedPlans as $lockedPlan)
                            @php
                                $totalDays = $lockedPlan->start_date->diffInDays($lockedPlan->end_date);
                                $daysPassed = $lockedPlan->start_date->diffInDays(now());
                                $progress = min(100, max(0, ($daysPassed / $totalDays) * 100));
                                $daysLeft = $lockedPlan->end_date->diffInDays(now());
                                
                                $progressColor = 'bg-success';
                                if ($progress < 30) {
                                    $progressColor = 'bg-danger';
                                } elseif ($progress < 70) {
                                    $progressColor = 'bg-warning';
                                }
                            @endphp
                            
                            <li class="list-group-item d-flex align-items-center justify-content-between" 
                                data-plan-id="{{ $lockedPlan->id }}" 
                                data-maturity="{{ $lockedPlan->end_date->format('Y-m-d') }}">
                                <div>
                                    <div class="fw-semibold">{{ $lockedPlan->plan->name }}</div>
                                    <small class="text-muted">
                                        ${{ number_format($lockedPlan->amount, 2) }} • 
                                        Matures <time datetime="{{ $lockedPlan->end_date->format('Y-m-d') }}">
                                            {{ $lockedPlan->end_date->format('M j, Y') }}
                                        </time> • 
                                        <span class="text-success">+{{ $lockedPlan->plan->apy }}% APY</span>
                                    </small>
                                    <div class="progress mt-2" style="height:6px;" 
                                         role="progressbar" 
                                         aria-label="{{ $lockedPlan->plan->name }} progress" 
                                         aria-valuenow="{{ floor($progress) }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                        <div class="progress-bar {{ $progressColor }}" style="width: {{ $progress }}%"></div>
                                    </div>
                                </div>
                                <span class="badge rounded-pill text-bg-secondary">
                                    {{ $daysLeft }} {{ Illuminate\Support\Str::plural('day', $daysLeft) }} left
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-4">
                        <p class="text-muted">You don't have any active plans yet</p>
                        <a href="#plans-section" class="btn btn-sm btn-primary">Browse Plans</a>
                    </div>
                @endif
            </div>
        </article>
    </div>
    
    <!-- Inactive plans section (replaces chart) -->
    <div class="col-12 col-xl-7">
        <article class="card h-100" aria-label="Inactive plans">
            <div class="card-header bg-transparent fw-semibold">Inactive Plans</div>
            <div class="card-body">
                @if($inactivePlans->count())
                    <ul class="list-group list-group-flush">
                        @foreach($inactivePlans as $plan)
                            <li class="list-group-item">
                                <div class="fw-semibold">{{ $plan->name }}</div>
                                <small class="text-muted">
                                    Minimum: ${{ number_format($plan->minimum_amount, 2) }} • 
                                    APY: <span class="text-muted">{{ $plan->apy }}%</span>
                                </small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-4">
                        <p class="text-muted">No inactive plans found</p>
                    </div>
                @endif
            </div>
        </article>
    </div>
    

        <!-- Recent transactions -->
      @include('recents');
    </section>

@endsection