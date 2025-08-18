@extends('admin.layout')

@section('admin_content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Withdrawals Management</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th>Reference</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($withdrawals as $withdrawal)
                <tr>
                    <td>{{ $withdrawal->id }}</td>
                    <td>{{ $withdrawal->user->name }}</td>
                    <td>${{ number_format($withdrawal->amount, 2) }}</td>
                    <td>{{ ucfirst($withdrawal->method) }}</td>
                    <td>
                        <span class="badge 
                            @if($withdrawal->status == 'pending') bg-warning
                            @elseif($withdrawal->status == 'processing') bg-info
                            @elseif($withdrawal->status == 'completed') bg-success
                            @else bg-danger @endif">
                            {{ ucfirst($withdrawal->status) }}
                        </span>
                    </td>
                    <td>{{ $withdrawal->reference }}</td>
                    <td>{{ $withdrawal->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        <div class="btn-group">
                            <form action="{{ route('admin.withdrawals.update', $withdrawal) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="processing">
                                <button type="submit" class="btn btn-sm btn-info">Processing</button>
                            </form>
                            <form action="{{ route('admin.withdrawals.update', $withdrawal) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="completed">
                                <button type="submit" class="btn btn-sm btn-success">Complete</button>
                            </form>
                            <form action="{{ route('admin.withdrawals.update', $withdrawal) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $withdrawals->links() }}
    </div>
</div>
@endsection