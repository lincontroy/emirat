@extends('admin.layout')

@section('admin_content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Deposits Management</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Wallet Address</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deposits as $deposit)
                <tr>
                    <td>{{ $deposit->id }}</td>
                    <td>{{ $deposit->user->name }}</td>
                    <td>${{ number_format($deposit->amount, 2) }}</td>
                    <td>{{ $deposit->wallet_address }}</td>
                    <td>
                        <span class="badge 
                            @if($deposit->status == 'pending') bg-warning
                            @elseif($deposit->status == 'completed') bg-success
                            @else bg-danger @endif">
                            {{ ucfirst($deposit->status) }}
                        </span>
                    </td>
                    <td>{{ $deposit->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.deposits.update', $deposit) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                        </form>
                        <form action="{{ route('admin.deposits.update', $deposit) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $deposits->links() }}
    </div>
</div>
@endsection