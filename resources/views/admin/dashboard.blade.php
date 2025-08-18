@extends('admin.layout')

@section('admin_content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Users</span>
                <span class="info-box-number">{{ $stats['users'] }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-money-bill-wave"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Deposits</span>
                <span class="info-box-number">${{ number_format($stats['total_deposits'], 2) }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fas fa-hand-holding-usd"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Withdrawals</span>
                <span class="info-box-number">${{ number_format($stats['total_withdrawals'], 2) }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fas fa-chart-line"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Active Plans</span>
                <span class="info-box-number">{{ $stats['active_plans'] }}</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pending Deposits</h3>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @forelse(App\Models\Deposit::where('status', 'pending')->latest()->limit(5)->get() as $deposit)
                    <a href="{{ route('admin.deposits') }}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">${{ number_format($deposit->amount, 2) }}</h5>
                            <small>{{ $deposit->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-1">{{ $deposit->user->name }}</p>
                        <small>{{ $deposit->wallet_address }}</small>
                    </a>
                    @empty
                    <div class="list-group-item">No pending deposits</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pending Withdrawals</h3>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @forelse(App\Models\Transaction::where('type', 'withdrawal')->where('status', 'pending')->latest()->limit(5)->get() as $withdrawal)
                    <a href="{{ route('admin.withdrawals') }}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">${{ number_format($withdrawal->amount, 2) }}</h5>
                            <small>{{ $withdrawal->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-1">{{ $withdrawal->user->name }}</p>
                        <small>{{ $withdrawal->method }} - {{ $withdrawal->reference }}</small>
                    </a>
                    @empty
                    <div class="list-group-item">No pending withdrawals</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection