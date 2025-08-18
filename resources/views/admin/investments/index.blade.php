@extends('admin.layout')

@section('admin_content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Active Investments</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Plan</th>
                    <th>Amount</th>
                    <th>Expected Yield</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Days Left</th>
                </tr>
            </thead>
            <tbody>
                @foreach($investments as $investment)
                <tr>
                    <td>{{ $investment->id }}</td>
                    <td>{{ $investment->user->name }}</td>
                    <td>{{ $investment->plan->name }}</td>
                    <td>${{ number_format($investment->amount, 2) }}</td>
                    <td>${{ number_format($investment->expected_yield, 2) }}</td>
                    <td>{{ $investment->start_date->format('M d, Y') }}</td>
                    <td>{{ $investment->end_date->format('M d, Y') }}</td>
                    <td>
                        <span class="badge 
                            @if($investment->status == 'active') bg-success
                            @elseif($investment->status == 'completed') bg-primary
                            @else bg-warning @endif">
                            {{ ucfirst(str_replace('_', ' ', $investment->status)) }}
                        </span>
                    </td>
                    <td>
                        @if($investment->status == 'active')
                            {{ $investment->end_date->diffInDays(now()) }} days
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $investments->links() }}
    </div>
</div>
@endsection