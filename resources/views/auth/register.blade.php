@extends('layouts.app')

@section('content')
<!-- Top Centered Brand Logo -->
<div class="d-flex align-items-center justify-content-center gap-2 mb-3">
    <img src="{{ asset('assets/img/bacsaymedsys-icon.svg') }}" alt="Logo" style="width: 38px; height: 38px;">
    <span class="fw-bold fs-4 text-dark">Bacsay<span style="color: #ea580c;">MedSys</span></span>
</div>

<!-- Header Titles -->
<div class="text-center mb-4">
    <h2 class="fw-extrabold text-dark mb-1" style="font-size: 26px; font-weight: 800; letter-spacing: -0.5px;">Create Account</h2>
    <p class="text-muted mb-0" style="font-size: 13px;">Register staff account for Barangay Bacsay Health Center</p>
</div>

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

<!-- Footer Signin Link -->
<div class="text-center mt-3">
    <span class="text-muted small">Already have an account?</span>
    <a href="{{ route('login') }}" class="text-orange-link small ms-1">Sign In</a>
</div>
@endsection
