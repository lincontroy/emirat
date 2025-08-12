@extends('layouts.main')
@section('content')
<section id="dashboard" class="ccontainer-xxl pt-5">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
          <h2 class="section-title mb-0">Overview</h2>
          <p class="section-sub mb-0">Your balances, yields and recent activity</p>
        </div>
        <div class="d-none d-md-flex gap-2">
          <button class="btn btn-success action-btn" data-bs-toggle="modal" data-bs-target="#depositModal"><i class="bi bi-plus-circle me-2"></i>Deposit</button>
          <button class="btn btn-outline-secondary action-btn" data-bs-toggle="modal" data-bs-target="#withdrawModal"><i class="bi bi-box-arrow-up me-2"></i>Withdraw</button>
          <button class="btn btn-warning action-btn" data-bs-toggle="modal" data-bs-target="#lockModal"><i class="bi bi-lock-fill me-2"></i>Lock Funds</button>
        </div>
      </div>

      <div class="row g-3">
        <!-- Summary cards -->
        <div class="col-12 col-md-6 col-xl-3">
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
        <div class="col-12 col-md-6 col-xl-3">
    <article class="card h-100" aria-label="Available balance">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted">Available</span>
                <span class="badge text-bg-success">Liquid</span>
            </div>
            <div class="metric" id="availableBalance" data-available="{{ auth()->user()->available_balance }}">
                ${{ number_format(auth()->user()->available_balance, 2) }}
            </div>
            <div class="metric-sub">Ready to withdraw</div>
        </div>
    </article>
</div>

<div class="col-12 col-md-6 col-xl-3">
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
        <div class="col-12 col-md-6 col-xl-3">
          <article class="card h-100" aria-label="Yield">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="text-muted">Yield</span>
                <span class="badge badge-emerald">APY</span>
              </div>
              <div class="d-flex align-items-baseline gap-3">
                <div>
                  <div class="metric" id="dailyYield" data-daily-yield="0.034">+0.034%</div>
                  <div class="metric-sub">Daily</div>
                </div>
                <div>
                  <div class="metric" id="monthlyYield" data-monthly-yield="1.03">+1.03%</div>
                  <div class="metric-sub">Monthly</div>
                </div>
              </div>
            </div>
          </article>
        </div>

        <!-- Active plans -->
        <div class="col-12 col-xl-5">
          <article class="card h-100" aria-label="Active plans">
            <div class="card-header bg-transparent fw-semibold">Active Plans</div>
            <div class="card-body">
              <ul class="list-group list-group-flush" id="activePlans">
                <li class="list-group-item d-flex align-items-center justify-content-between" data-plan-id="p30" data-maturity="2025-09-09">
                  <div>
                    <div class="fw-semibold">30-day Lock</div>
                    <small class="text-muted">$3,000 • Matures <time datetime="2025-09-09">Sep 9, 2025</time> • <span class="text-success">+6.5% APY</span></small>
                    <div class="progress mt-2" style="height:6px;" role="progressbar" aria-label="30-day plan progress" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                      <div class="progress-bar bg-success" style="width: 65%"></div>
                    </div>
                  </div>
                  <span class="badge rounded-pill text-bg-secondary">20 days left</span>
                </li>
                <li class="list-group-item d-flex align-items-center justify-content-between" data-plan-id="p7" data-maturity="2025-08-17">
                  <div>
                    <div class="fw-semibold">7-day Lock</div>
                    <small class="text-muted">$2,000 • Matures <time datetime="2025-08-17">Aug 17, 2025</time> • <span class="text-success">+5.0% APY</span></small>
                    <div class="progress mt-2" style="height:6px;" role="progressbar" aria-label="7-day plan progress" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                      <div class="progress-bar bg-warning" style="width: 40%"></div>
                    </div>
                  </div>
                  <span class="badge rounded-pill text-bg-secondary">4 days left</span>
                </li>
              </ul>
            </div>
          </article>
        </div>

        <!-- Chart -->
        <div class="col-12 col-xl-7">
          <article class="card h-100" aria-label="Portfolio value chart">
            <div class="card-header bg-transparent fw-semibold d-flex align-items-center justify-content-between">
              <span>Portfolio Value</span>
              <div class="btn-group btn-group-sm" role="group" aria-label="Chart range">
                <button class="btn btn-outline-secondary active" data-range="1M">1M</button>
                <button class="btn btn-outline-secondary" data-range="3M">3M</button>
                <button class="btn btn-outline-secondary" data-range="1Y">1Y</button>
                <button class="btn btn-outline-secondary" data-range="ALL">ALL</button>
              </div>
            </div>
            <div class="card-body">
              <canvas id="portfolioChart" height="100" aria-label="Portfolio chart" role="img"></canvas>
              <!-- To wire Chart.js:
                1) Include Chart.js: <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                2) Initialize with data from your API after authentication.
                3) Update dataset when range buttons are clicked.
              -->
            </div>
          </article>
        </div>

        <!-- Recent transactions -->
        <div class="col-12">
          <article class="card" aria-label="Recent transactions">
            <div class="card-header bg-transparent fw-semibold d-flex flex-wrap align-items-center gap-2">
              <span>Recent Transactions</span>
              <div class="ms-auto d-flex flex-wrap gap-2">
                <input type="date" class="form-control form-control-sm" id="filterFrom" aria-label="Filter from date" />
                <input type="date" class="form-control form-control-sm" id="filterTo" aria-label="Filter to date" />
                <select id="filterType" class="form-select form-select-sm" aria-label="Filter by type">
                  <option value="">All types</option>
                  <option value="deposit">Deposit</option>
                  <option value="withdrawal">Withdrawal</option>
                  <option value="lock">Lock</option>
                  <option value="payout">Payout</option>
                </select>
                <input type="number" min="0" step="0.01" class="form-control form-control-sm" id="filterMinAmt" placeholder="Min $" aria-label="Minimum amount" />
                <button class="btn btn-sm btn-primary" id="applyFilters">Apply</button>
                <button class="btn btn-sm btn-outline-secondary" id="clearFilters">Clear</button>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-middle table-hover mb-0" id="recentTransactions">
                <thead>
                  <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Type</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                @php
                  
                $transactions = App\Models\Transaction::where('user_id', auth()->id())
            ->with('transactionable')
            ->latest()
            ->take(10)
            ->get();
                @endphp
                @forelse($transactions as $transaction)
                <tr data-date="{{ $transaction->created_at->format('Y-m-d') }}" 
                    data-type="{{ $transaction->type }}" 
                    data-amount="{{ $transaction->amount }}">
                    <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        @php
                            $badgeClass = match($transaction->type) {
                                'deposit' => 'success',
                                'withdrawal' => 'danger',
                                'lock' => 'warning',
                                default => 'primary'
                            };
                        @endphp
                        <span class="badge text-bg-{{ $badgeClass }}">
                            {{ ucfirst($transaction->type) }}
                        </span>
                    </td>
                    <td>{{ number_format($transaction->amount, 2) }} USDT</td>
                    <td>
                        @php
                            $statusClass = match($transaction->status) {
                                'completed', 'processed' => 'success',
                                'pending' => 'warning',
                                'failed' => 'danger',
                                default => 'secondary'
                            };
                        @endphp
                        <span class="badge text-bg-{{ $statusClass }}">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">No transactions found</td>
                </tr>
            @endforelse
                </tbody>
              </table>
            </div>
          </article>
        </div>
      </div>
    </section>

@endsection