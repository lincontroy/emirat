@extends('layouts.main')

@section('content')
    <!-- DEPOSIT -->
    <section id="deposit" class="container-xxl pt-5">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <h2 class="section-title mb-0">Deposit USDT</h2>
                <p class="section-sub mb-0">Add funds to your account via TRC20 network</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8">
                <article class="card">
                    <div class="card-body">
                        <form action="{{ route('deposit.store') }}" method="POST" id="depositFormPage">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <label for="depAmount" class="form-label">Amount (USDT)</label>
                                    <input id="depAmount" name="amount" type="number" min="10" step="0.01" required 
                                           class="form-control" placeholder="e.g., 500" 
                                           aria-describedby="depAmountHelp">
                                    <div class="form-text" id="depAmountHelp">Minimum 10 USDT</div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="depSource" class="form-label">Source</label>
                                    <select id="depSource" name="source" class="form-select" required>
                                        <option value="" selected disabled>Select source</option>
                                        <option value="crypto_wallet">Crypto Wallet</option>
                                       
                                    </select>
                                </div>
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <h5 class="alert-heading">Send USDT to this address:</h5>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control font-monospace" 
                                                   value="{{ $walletAddress }}" id="walletAddress" name="wallet_address"readonly>
                                            <button class="btn btn-outline-secondary" type="button" 
                                                    onclick="copyWalletAddress()">
                                                <i class="bi bi-clipboard"></i> Copy
                                            </button>
                                        </div>
                                        <small class="text-muted">Network: TRC20 (Tron)</small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success btn-lg">
                                            <i class="bi bi-plus-circle me-2"></i>Confirm Deposit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </article>
            </div>
            
            <div class="col-lg-4">
                <article class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Deposit Instructions</h5>
                    </div>
                    <div class="card-body">
                        <ol class="list-group list-group-numbered list-group-flush">
                            <li class="list-group-item">Enter amount and select source</li>
                            <li class="list-group-item">Send exact USDT amount to the address shown</li>
                            <li class="list-group-item">Wait for blockchain confirmation (usually 2-5 minutes)</li>
                            <li class="list-group-item">Funds will be credited automatically</li>
                        </ol>
                        
                        <div class="mt-3 alert alert-warning">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>Important:</strong> Only send USDT via TRC20 network to this address.
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
    <script>
        function copyWalletAddress() {
            const address = document.getElementById('walletAddress');
            address.select();
            document.execCommand('copy');
            
            // Show tooltip or alert
            alert('Wallet address copied to clipboard!');
        }
        
        // Form submission handling
        document.getElementById('depositFormPage').addEventListener('submit', function(e) {
            const amount = parseFloat(document.getElementById('depAmount').value);
            if (amount < 10) {
                e.preventDefault();
                alert('Minimum deposit amount is 10 USDT');
            }
        });
    </script>
@endsection

@section('scripts')

@endsection