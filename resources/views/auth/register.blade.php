@extends('layouts.app')
@section('content')
    <div class="auth-card">
        <div class="auth-brand-header">
            <img src="{{ asset('assets/img/bacsaymedsys-icon.svg') }}" alt="BacsayMedSys Logo" class="auth-brand-logo">
            <h2 class="auth-brand-title">Bacsay<span style="color: #38bdf8;">MedSys</span></h2>
            <p class="auth-brand-subtitle">Create Staff / User Account</p>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Create a password" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="fas fa-user-plus me-2"></i> Register Account
            </button>
        </form>

        <div class="auth-footer-text">
            Already have an account? <a href="{{ route('login') }}">Sign In</a>
        </div>
    </div>
@endsection
