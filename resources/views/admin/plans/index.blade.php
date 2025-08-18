@extends('admin.layout')

@section('admin_content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Investment Plans</h3>
        <div class="card-tools">
            <a href="{{ route('admin.plans.create') }}" class="btn btn-primary">Create New Plan</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Min Amount</th>
                    <th>Yield %</th>
                    <th>Penalty %</th>
                    <th>Duration</th>
                    <th>APY</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plans as $plan)
                <tr>
                    <td>{{ $plan->id }}</td>
                    <td>{{ $plan->name }}</td>
                    <td>${{ number_format($plan->min_amount, 2) }}</td>
                    <td>{{ $plan->yield_percentage }}%</td>
                    <td>{{ $plan->penalty_percentage }}%</td>
                    <td>{{ $plan->duration_days }} days</td>
                    <td>{{ $plan->apy }}%</td>
                    <td>
                        <span class="badge {{ $plan->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $plan->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.plans.edit', $plan) }}" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $plans->links() }}
    </div>
</div>
@endsection