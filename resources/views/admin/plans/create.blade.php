@extends('admin.layout')

@section('admin_content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create New Investment Plan</h3>
    </div>
    <form method="POST" action="{{ route('admin.plans.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Plan Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="slug">Slug (URL Identifier)</label>
                <input type="text" class="form-control" id="slug" name="slug" required>
            </div>
            <div class="form-group">
                <label for="min_amount">Minimum Amount (USD)</label>
                <input type="number" step="0.01" class="form-control" id="min_amount" name="min_amount" required>
            </div>
            <div class="form-group">
                <label for="yield_percentage">Yield Percentage</label>
                <input type="number" step="0.01" class="form-control" id="yield_percentage" name="yield_percentage" required>
            </div>
            <div class="form-group">
                <label for="penalty_percentage">Early Withdrawal Penalty (%)</label>
                <input type="number" step="0.01" class="form-control" id="penalty_percentage" name="penalty_percentage" required>
            </div>
            <div class="form-group">
                <label for="duration_days">Duration (Days)</label>
                <input type="number" class="form-control" id="duration_days" name="duration_days" required>
            </div>
            <div class="form-group">
                <label for="apy">APY (%)</label>
                <input type="number" step="0.01" class="form-control" id="apy" name="apy" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" checked>
                    <label class="custom-control-label" for="is_active">Active Plan</label>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create Plan</button>
            <a href="{{ route('admin.plans') }}" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>
@endsection