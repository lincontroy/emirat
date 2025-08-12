@extends('layouts.auth')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px; border-radius: 12px;">
        <h4 class="text-center mb-4">Login</h4>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>
            <button class="btn btn-primary w-100">Login</button>
            <div class="mt-3 text-center">
                <a href="{{ route('register') }}">Don’t have an account? Register</a>
            </div>
        </form>
    </div>
</div>
@endsection
