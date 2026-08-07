@extends('layouts.app')

@section('content')
<div class="account-wrapper">
    <!-- Left Column: Registration Form (~50% width) -->
    <div class="auth-form-column">
        <div>
            <!-- Top Left Brand Logo -->
            <div class="d-flex align-items-center gap-2 mb-3">
                <img src="{{ asset('assets/img/bacsaymedsys-icon.svg') }}" alt="Logo" style="width: 34px; height: 34px;">
                <span class="fw-bold fs-5 text-dark">Bacsay<span style="color: #ea580c;">MedSys</span></span>
            </div>

            <!-- Header Titles -->
            <h2 class="fw-extrabold text-dark mb-1" style="font-size: 26px; font-weight: 800; letter-spacing: -0.5px;">Create Account</h2>
            <p class="text-muted mb-4" style="font-size: 13px;">Register staff account for Barangay Bacsay Health Center</p>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <!-- Full Name Input -->
                <div class="input-floating-group mb-3">
                    <label>Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter your full name" required autofocus>
                </div>

                <!-- Email Input -->
                <div class="input-floating-group mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email address" required>
                </div>

                <!-- Password Input -->
                <div class="input-floating-group mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Create a password" required minlength="6">
                </div>

                <!-- Confirm Password Input -->
                <div class="input-floating-group mb-4">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required minlength="6">
                </div>

                <!-- Main Register Button -->
                <button type="submit" class="btn btn-pill-orange mb-3">
                    Sign Up
                </button>
            </form>
        </div>

        <!-- Footer Signin Link -->
        <div class="text-center mt-3">
            <span class="text-muted small">Already have an account?</span>
            <a href="{{ route('login') }}" class="text-orange-link small ms-1">Sign In</a>
        </div>
    </div>

    <!-- Right Column: Hero Panel with System Logo Illustration (~50% width) -->
    <div class="auth-hero-column">
        <!-- Floating Top Checkmark Badges -->
        <div class="d-flex justify-content-between w-100 px-2">
            <span class="badge rounded-circle bg-white text-orange shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px; color: #ea580c;">
                <i class="fas fa-check"></i>
            </span>
            <span class="badge rounded-circle bg-white text-orange shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px; color: #ea580c;">
                <i class="fas fa-check"></i>
            </span>
        </div>

        <!-- Center System Logo & Medical Illustration -->
        <div class="my-auto py-3">
            <img src="{{ asset('assets/img/login-hero-illustration.svg') }}" alt="BacsayMedSys System Illustration" style="max-width: 320px; width: 100%; height: auto;">
        </div>

        <!-- Bottom System Description & Carousel Dots -->
        <div>
            <h5 class="fw-bold text-dark mb-1">Bacsay<span style="color: #ea580c;">MedSys</span></h5>
            <p class="fst-italic small text-secondary mb-3" style="max-width: 300px; font-size: 13px; line-height: 1.5;">
                Authorized Staff Registration & Health Record System Management...
            </p>
            <div class="d-flex justify-content-center align-items-center gap-2">
                <span style="width: 20px; height: 6px; background: #ea580c; border-radius: 4px;"></span>
                <span style="width: 6px; height: 6px; background: #fdba74; border-radius: 50%;"></span>
                <span style="width: 6px; height: 6px; background: #fdba74; border-radius: 50%;"></span>
            </div>
        </div>
    </div>
</div>
@endsection
