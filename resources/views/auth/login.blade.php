@extends('layouts.app')
@section('content')
    <div class="auth-card">
        <div class="auth-brand-header">
            <img src="{{ asset('assets/img/bacsaymedsys-icon.svg') }}" alt="BacsayMedSys Logo" class="auth-brand-logo">
            <h2 class="auth-brand-title">Bacsay<span style="color: #38bdf8;">MedSys</span></h2>
            <p class="auth-brand-subtitle">Barangay Bacsay Medical Record System</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-secondary text-slate-300" style="border-color: rgba(255,255,255,0.15) !important;">
                        <i class="fas fa-envelope text-info"></i>
                    </span>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label mb-0">Password</label>
                    <a href="javascript:void(0);" class="small">Forgot Password?</a>
                </div>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-secondary text-slate-300" style="border-color: rgba(255,255,255,0.15) !important;">
                        <i class="fas fa-lock text-info"></i>
                    </span>
                    <input type="password" name="password" id="login_password" class="form-control" placeholder="Enter your password" required>
                </div>
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label small text-slate-300" for="remember" style="color: #cbd5e1;">Remember this device</label>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="fas fa-sign-in-alt me-2"></i> Sign In to System
            </button>
        </form>

        <div class="auth-footer-text">
            Don’t have an account? <a href="{{ route('register') }}">Register New Account</a>
        </div>
    </div>
@endsection
