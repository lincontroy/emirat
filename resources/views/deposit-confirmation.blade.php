
@extends('layouts.main')

@section('content')
    <section class="container-xxl py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <div class="icon-lg bg-light-success rounded-circle text-success mb-3 mx-auto">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <h2 class="mb-2">Deposit Initiated</h2>
                            <p class="text-muted">We're waiting for your USDT deposit</p>
                        </div>
                        
                        <div class="mb-4 p-4 bg-light rounded">
                            <div class="row">
                                <div class="col-6 text-start">
                                    <p class="text-muted mb-1">Amount:</p>
                                    <h5 class="mb-0">{{ $deposit->amount }} USDT</h5>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="text-muted mb-1">Wallet Address:</p>
                                    <h5 class="mb-0 text-truncate">{{ $deposit->wallet_address }}</h5>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-info text-start">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Note:</strong> This page will automatically update when we detect your transaction.
                            Typically takes 2-5 minutes.
                        </div>
                        
                        <a href="{{ route('dashboard') }}" class="btn btn-primary px-4">
                            <i class="bi bi-house-door me-2"></i> Return to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection