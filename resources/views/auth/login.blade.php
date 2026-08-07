@extends('layouts.app')

@section('content')
<!-- Top Centered Brand Logo -->
<div class="d-flex align-items-center justify-content-center gap-2 mb-4">
    <img src="{{ asset('assets/img/bacsaymedsys-icon.svg') }}" alt="Logo" style="width: 38px; height: 38px;">
    <span class="fw-bold fs-4 text-dark">Bacsay<span style="color: #ea580c;">MedSys</span></span>
</div>

<!-- Header Titles -->
<div class="text-center mb-4">
    <h2 class="fw-extrabold text-dark mb-1" style="font-size: 26px; font-weight: 800; letter-spacing: -0.5px;">Welcome Back!</h2>
    <p class="text-muted mb-0" style="font-size: 13.5px;">Please enter login details below</p>
</div>

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
<button type="button" class="btn btn-pill-google">
    <img src="{{ asset('assets/img/icons/google.png') }}" alt="Google" style="width: 18px; height: 18px;">
    Log in with Google
</button>
@endsection
