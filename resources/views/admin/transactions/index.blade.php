@extends('admin.layout')

@section('admin_content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Transactions</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>{{ ucfirst($transaction->type) }}</td>
                    <td>${{ number_format($transaction->amount, 2) }}</td>
                    <td>
                        <span class="badge 
                            @if($transaction->status == 'pending') bg-warning
                            @elseif($transaction->status == 'completed') bg-success
                            @else bg-danger @endif">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </td>
                    <td>{{ $transaction->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        <button class="btn btn-sm btn-info" data-toggle="modal" 
                                data-target="#transactionModal-{{ $transaction->id }}">
                            View
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $transactions->links() }}
    </div>
</div>

@foreach($transactions as $transaction)
<!-- Modal for each transaction -->
<div class="modal fade" id="transactionModal-{{ $transaction->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Transaction #{{ $transaction->id }}</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <pre>{{ json_encode($transaction->details, JSON_PRETTY_PRINT) }}</pre>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection