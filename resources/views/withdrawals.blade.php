@extends('layouts.main')

@section('content')
    <!-- CRYPTO WITHDRAWAL SECTION -->
    <section id="withdraw" class="container-xxl pt-5">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <h2 class="section-title mb-0">Crypto Withdrawal</h2>
                <p class="section-sub mb-0">Transfer funds to your external wallet</p>
            </div>
        </div>
        
        <article class="card">
            <div class="card-body">
                <form id="cryptoWithdrawForm" action="{{ route('withdraw.process') }}" method="POST" novalidate>
                    @csrf
                    
                    <div class="row g-3">
                        <!-- Amount Input -->
                        <div class="col-12 col-md-6">
                            <label for="cryptoAmount" class="form-label">Amount (USD)</label>
                            <input id="cryptoAmount" name="amount" type="number" min="0.01" step="0.00000001" required 
                                   class="form-control" placeholder="0.00"
                                   max="{{ auth()->user()->balance }}" 
                                   value="{{ old('amount') }}">
                            <div class="form-text">
                                Available: <span id="availableBalance">${{ number_format(auth()->user()->balance, 2) }}</span>
                                @if(auth()->user()->locked_balance > 0)
                                    (Locked: ${{ number_format(auth()->user()->locked_balance, 2) }})
                                @endif
                            </div>
                            @error('amount')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Network Selection -->
                        <div class="col-12 col-md-6">
                            <label for="cryptoNetwork" class="form-label">Network</label>
                            <select id="cryptoNetwork" name="network" class="form-select" required>
                                <option value="" disabled selected>Select network</option>
                               <option value="TRC20" {{ old('network') == 'TRC20' ? 'selected' : '' }}>Tron (TRC20)</option>
                                
                            </select>
                            @error('network')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" value="crypto" name="destination">
                        
                        <!-- Wallet Address -->
                        <div class="col-12">
                            <label for="walletAddress" class="form-label">Wallet Address</label>
                            <input type="text" class="form-control" id="walletAddress" name="wallet_address" 
                                   placeholder="0x..." required value="{{ old('wallet_address') }}">
                            @error('wallet_address')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Memo/Tag (for certain networks) -->
                        <div class="col-12" id="memoField" style="display: none;">
                            <label for="memoTag" class="form-label">Memo/Tag (if required by exchange)</label>
                            <input type="text" class="form-control" id="memoTag" name="memo" 
                                   value="{{ old('memo') }}">
                            @error('memo')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Current Conversion Rate -->
                        <div class="col-12">
                            <div class="alert alert-info py-2">
                                <div class="d-flex justify-content-between">
                                    <span>Estimated receiving amount:</span>
                                    <strong id="cryptoEstimate">0.00 <span id="cryptoCurrency">ETH</span></strong>
                                </div>
                                <div class="small text-muted">Rate: 1 ETH = $<span id="cryptoRate">0.00</span></div>
                            </div>
                        </div>
                        
                        <!-- Terms Confirmation -->
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="confirmTerms" name="confirm_terms" required>
                                <label class="form-check-label" for="confirmTerms">
                                    I confirm this wallet address is correct and belongs to me. Transactions cannot be reversed.
                                </label>
                                @error('confirm_terms')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="bi bi-send me-2"></i> Process Withdrawal
                            </button>
                        </div>
                        
                        <!-- Security Note -->
                        <div class="col-12">
                            <div class="alert alert-warning small mt-3">
                                <i class="bi bi-shield-exclamation me-2"></i>
                                For your security, withdrawals may take 1-3 business days to process and require manual verification for first-time addresses.
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </article>
    </section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cryptoNetwork = document.getElementById('cryptoNetwork');
    const memoField = document.getElementById('memoField');
    const cryptoAmount = document.getElementById('cryptoAmount');
    const cryptoEstimate = document.getElementById('cryptoEstimate');
    const cryptoCurrency = document.getElementById('cryptoCurrency');
    const cryptoRate = document.getElementById('cryptoRate');
    
    // Toggle memo field for networks that require it
    cryptoNetwork.addEventListener('change', function() {
        const network = this.value;
        // Show memo for XRP, XLM, EOS, etc.
        memoField.style.display = ['XRP', 'XLM', 'EOS', 'ATOM'].includes(network) ? 'block' : 'none';
        updateEstimate();
    });
    
    // Update crypto estimate when amount changes
    cryptoAmount.addEventListener('input', updateEstimate);
    
    // Fetch conversion rates and update estimate
    function updateEstimate() {
        const network = cryptoNetwork.value;
        const amount = parseFloat(cryptoAmount.value) || 0;
        
        if (network && amount > 0) {
            // In a real app, you would fetch this from your API
            const rates = {
                'ERC20': { rate: 1850, symbol: 'ETH' },
                'BEP20': { rate: 1850, symbol: 'BNB' },
                'TRC20': { rate: 0.07, symbol: 'USDT' },
                'BTC': { rate: 42000, symbol: 'BTC' },
                'SOL': { rate: 120, symbol: 'SOL' }
            };
            
            if (rates[network]) {
                const cryptoAmount = amount / rates[network].rate;
                cryptoEstimate.textContent = cryptoAmount.toFixed(8) + ' ' + rates[network].symbol;
                cryptoCurrency.textContent = rates[network].symbol;
                cryptoRate.textContent = rates[network].rate.toLocaleString();
            }
        } else {
            cryptoEstimate.textContent = '0.00';
            cryptoCurrency.textContent = network ? network : 'ETH';
            cryptoRate.textContent = '0.00';
        }
    }
    
    // Form validation
    document.getElementById('cryptoWithdrawForm').addEventListener('submit', function(e) {
        const amount = parseFloat(cryptoAmount.value);
        const availableBalance = parseFloat("{{ auth()->user()->balance }}");
        
        if (amount > availableBalance) {
            e.preventDefault();
            alert('Withdrawal amount exceeds your available balance');
            return;
        }
        
        if (amount < 10) { // Minimum withdrawal amount
            e.preventDefault();
            alert('Minimum withdrawal amount is $10');
            return;
        }
        
        const walletAddress = document.getElementById('walletAddress').value;
        if (!walletAddress || walletAddress.length < 10) {
            e.preventDefault();
            alert('Please enter a valid wallet address');
            return;
        }
        
        if (!document.getElementById('confirmTerms').checked) {
            e.preventDefault();
            alert('You must confirm the wallet address is correct');
            return;
        }
    });
    
    // Initialize estimate
    updateEstimate();
});
</script>
@endpush