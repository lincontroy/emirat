@extends('admin.layout')

@section('admin_content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Wallet Settings</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.wallets.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Currency</label>
                        <select name="currency" class="form-control" required>
                            <option value="USDT" selected>USDT</option>
                            <option value="BTC">BTC</option>
                            <option value="ETH">ETH</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Network</label>
                        <select name="network" class="form-control" required>
                            <option value="TRC20" selected>TRC20</option>
                            <option value="ERC20">ERC20</option>
                            <option value="BEP20">BEP20</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Wallet Address</label>
                        <input type="text" name="wallet_address" class="form-control" required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Deposit Instructions</label>
                        <textarea name="instructions" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Save Wallet</button>
                </div>
            </div>
        </form>

        <hr>

        <h4 class="mt-4">Current Wallets</h4>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Currency</th>
                        <th>Network</th>
                        <th>Wallet Address</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wallets as $wallet)
                    <tr>
                        <td>{{ $wallet->currency }}</td>
                        <td>{{ $wallet->network }}</td>
                        <td class="text-truncate" style="max-width: 200px;">{{ $wallet->wallet_address }}</td>
                        <td>
                            <span class="badge {{ $wallet->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $wallet->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('admin.wallets.toggle', $wallet->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $wallet->is_active ? 'btn-warning' : 'btn-success' }}">
                                    {{ $wallet->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection