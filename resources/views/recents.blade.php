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
                    data-type="{{ $transaction->transactionable_type }}" 
                    data-amount="{{ $transaction->amount }}">
                    <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                    <td>
    @php
        // Determine badge class based on transaction type
        $badgeClass = match(true) {
            $transaction->transactionable_type === 'App\Models\Deposit' => 'success',
            $transaction->transactionable_type === 'App\Models\Withdrawal' => 'danger',
            str_contains($transaction->transactionable_type, 'Lock') => 'warning',
            default => 'primary'
        };
        
        // Determine display text
        $typeText = match(true) {
            $transaction->transactionable_type === 'App\Models\Deposit' => 'Deposit',
            $transaction->transactionable_type === 'App\Models\Withdrawal' => 'Withdrawal',
            str_contains($transaction->transactionable_type, 'Lock') => 'Lock',
            default => $transaction->transactionable_type
        };
    @endphp
    <span class="badge text-bg-{{ $badgeClass }}">
        {{ $typeText }}
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