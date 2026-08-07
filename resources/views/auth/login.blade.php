@extends('layouts.app')

@section('content')
<div class="account-wrapper">
    <!-- Left Column: Login Form (~50% width) -->
    <div class="auth-form-column">
        <div>
            <!-- Top Left Brand Logo -->
            <div class="d-flex align-items-center gap-2 mb-4">
                <img src="{{ asset('assets/img/bacsaymedsys-icon.svg') }}" alt="Logo" style="width: 34px; height: 34px;">
                <span class="fw-bold fs-5 text-dark">Bacsay<span style="color: #ea580c;">MedSys</span></span>
            </div>

            <!-- Header Titles (Matches Reference) -->
            <h2 class="fw-extrabold text-dark mb-1" style="font-size: 28px; font-weight: 800; letter-spacing: -0.5px;">Welcome Back!</h2>
            <p class="text-muted mb-4" style="font-size: 14px;">Please enter login details below</p>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Email Input with Inset Floating Label -->
                <div class="input-floating-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email address" required autofocus>
                </div>

                <!-- Password Input with Inset Floating Label -->
                <div class="input-floating-group mb-2">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>

                <!-- Forgot Password Link Right-Aligned -->
                <div class="d-flex justify-content-end mb-4">
                    <a href="javascript:void(0);" class="text-orange-link small">Forgot password?</a>
                </div>

                <!-- Main Sign In Button (Vibrant Orange Pill) -->
                <button type="submit" class="btn btn-pill-orange mb-3">
                    Sign in
                </button>
            </form>

            <!-- Divider Line -->
            <div class="divider-line">
                <span>Or continue</span>
            </div>

            <!-- Google Social Login Button -->
            <button type="button" class="btn btn-pill-google mb-3">
                <img src="{{ asset('assets/img/icons/google.png') }}" alt="Google" style="width: 18px; height: 18px;">
                Log in with Google
            </button>
        </div>

        <!-- Footer Signup Link -->
        <div class="text-center mt-3">
            <span class="text-muted small">Don't have an account?</span>
            <a href="{{ route('register') }}" class="text-orange-link small ms-1">Sign Up</a>
        </div>
    </div>

    <!-- Right Column: Hero Panel with System Logo Illustration (~50% width) -->
    <div class="auth-hero-column justify-content-center">
        <!-- Center System Logo & Medical Illustration -->
        <div class="my-auto py-2">
            <img src="{{ asset('assets/img/login-hero-illustration.svg') }}" alt="BacsayMedSys System Illustration" style="max-width: 380px; width: 100%; height: auto;">
        </div>

        <!-- Bottom System Description & Carousel Dots (No Duplicate Title) -->
        <div class="mt-auto pt-2">
            <p class="fst-italic small text-secondary mb-3" style="max-width: 320px; font-size: 13.5px; line-height: 1.5;">
                Manage Barangay Bacsay medical records in an easy, secure, and efficient way...
            </p>
            <div class="d-flex justify-content-center align-items-center gap-2">
                <span style="width: 22px; height: 6px; background: #ea580c; border-radius: 4px;"></span>
                <span style="width: 6px; height: 6px; background: #fdba74; border-radius: 50%;"></span>
                <span style="width: 6px; height: 6px; background: #fdba74; border-radius: 50%;"></span>
            </div>
        </div>
    </div>
</div>
@endsection
