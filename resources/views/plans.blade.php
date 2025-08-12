@extends('layouts.main')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h2 class="section-title mb-1">Plans / Lock-in</h2>
        <p class="section-sub mb-0 text-muted">Choose a plan to lock funds and earn</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="row g-4">
    @foreach($plans as $plan)
    <div class="col-12 col-md-4">
        <article class="card h-100 shadow-sm border-0">
            <div class="card-header text-white 
                @switch($plan->slug)
                    @case('7-day') bg-primary @break
                    @case('30-day') bg-success @break
                    @case('6-month') bg-danger @break
                    @default bg-secondary
                @endswitch fw-bold">
                {{ $plan->name }}
            </div>
            <div class="card-body">
                <ul class="list-unstyled small mb-4">
                    <li>Expected yield: <strong>{{ $plan->yield_percentage }}%</strong></li>
                    <li>Min deposit: <strong>${{ number_format($plan->min_amount, 2) }}</strong></li>
                    <li>Early withdrawal penalty: <strong>{{ $plan->penalty_percentage }}%</strong></li>
                    <li>APY: <strong>{{ $plan->apy }}%</strong></li>
                    <li>Duration: <strong>{{ $plan->duration_days }} days</strong></li>
                </ul>
                <button 
                    class="btn btn-warning w-100" 
                    data-bs-toggle="modal" 
                    data-bs-target="#lockModal" 
                    data-plan-id="{{ $plan->id }}"
                    data-plan-name="{{ $plan->name }}"
                    data-plan-min="{{ $plan->min_amount }}"
                    data-plan-apy="{{ $plan->apy }}"
                    aria-label="Subscribe to {{ $plan->name }} plan">
                    Lock / Subscribe
                </button>
            </div>
        </article>
    </div>
    @endforeach
</div>

<!-- Current Active Plans -->
@if($lockedPlans->count())
<div class="mt-5">
    <h4 class="mb-3">Your Active Plans</h4>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Plan</th>
                    <th>Amount</th>
                    <th>Expected Yield</th>
                    <th>Start Date</th>
                    <th>Maturity Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lockedPlans as $lockedPlan)
                <tr>
                    <td>{{ $lockedPlan->plan->name }}</td>
                    <td>${{ number_format($lockedPlan->amount, 2) }}</td>
                    <td>${{ number_format($lockedPlan->expected_yield, 2) }}</td>
                    <td>{{ $lockedPlan->start_date->format('M d, Y') }}</td>
                    <td>{{ $lockedPlan->end_date->format('M d, Y') }}</td>
                    <td>
                        <span class="badge 
                            @if($lockedPlan->status == 'active') bg-success
                            @elseif($lockedPlan->status == 'completed') bg-primary
                            @else bg-warning @endif">
                            {{ ucfirst(str_replace('_', ' ', $lockedPlan->status)) }}
                        </span>
                    </td>
                    <td>
                        @if($lockedPlan->status == 'active')
                        <form action="{{ route('plans.unlock', $lockedPlan) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                Unlock Early
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<!-- Lock Modal -->
<div class="modal fade" id="lockModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="lockForm" action="{{ route('plans.lock') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Lock Funds</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="plan_id" id="modalPlanId">
                    
                    <div class="mb-3">
                        <label class="form-label">Plan</label>
                        <input type="text" class="form-control" id="modalPlanName" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="lockAmount" class="form-label">Amount (USD)</label>
                        <input type="number" class="form-control" id="lockAmount" name="amount" 
                               step="0.00000001" min="0" required>
                        <div class="form-text">Minimum: <span id="modalPlanMin">$0.00</span></div>
                        <div class="form-text">Available: ${{ number_format(auth()->user()->balance_usd, 2) }}</div>
                    </div>
                    
                    <div class="alert alert-info">
                        <div>APY: <strong id="modalPlanApy">0%</strong></div>
                        <div>Expected yield: <strong id="expectedYield">$0.00</strong></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm Lock</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .section-title {
        font-weight: 600;
    }
    .card-header {
        font-size: 1.1rem;
        padding: 0.75rem 1rem;
    }
    .card {
        border-radius: 0.75rem;
        overflow: hidden;
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lockModal = document.getElementById('lockModal');
        if (lockModal) {
            lockModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const planId = button.getAttribute('data-plan-id');
                const planName = button.getAttribute('data-plan-name');
                const planMin = button.getAttribute('data-plan-min');
                const planApy = button.getAttribute('data-plan-apy');
                
                document.getElementById('modalPlanId').value = planId;
                document.getElementById('modalPlanName').value = planName;
                document.getElementById('modalPlanMin').textContent = '$' + parseFloat(planMin).toFixed(2);
                document.getElementById('modalPlanApy').textContent = planApy + '%';
                document.getElementById('lockAmount').min = planMin;
            });
        }

        // Calculate expected yield in real-time
        const lockAmount = document.getElementById('lockAmount');
        if (lockAmount) {
            lockAmount.addEventListener('input', function() {
                const amount = parseFloat(this.value) || 0;
                const apy = parseFloat(document.getElementById('modalPlanApy').textContent) || 0;
                const yield = amount * (apy / 100);
                document.getElementById('expectedYield').textContent = '$' + yield.toFixed(2);
            });
        }
    });
</script>

@endsection