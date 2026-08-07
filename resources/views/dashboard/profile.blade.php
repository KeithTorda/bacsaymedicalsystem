@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header d-flex justify-content-between align-items-center mb-4">
                <div class="page-title">
                    <h4 class="fw-bold text-dark">User Profile</h4>
                    <h6 class="text-muted">View & Update Your Personal Details</h6>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                    <i class="fas fa-check-circle fs-5 me-2"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <ul class="mb-0 small">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @php
                $user = Auth::user();
                $nameParts = explode(' ', $user->name ?? 'User Account');
                $firstName = $nameParts[0] ?? '';
                $lastName = count($nameParts) > 1 ? implode(' ', array_slice($nameParts, 1)) : '';
            @endphp

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf

                        <!-- Profile Header Banner -->
                        <div class="profile-set mb-4">
                            <div class="profile-top d-flex flex-wrap align-items-center gap-3 p-3 rounded-3" style="background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%); border: 1px solid #fed7aa;">
                                <div class="profile-content d-flex align-items-center gap-3">
                                    <div class="profile-contentimg position-relative">
                                        <img src="{{ asset('assets/img/profiles/avatar-02.jpg') }}" alt="User Avatar" class="rounded-circle border border-3 border-warning shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
                                    </div>
                                    <div class="profile-contentname">
                                        <h3 class="fw-bold text-dark mb-0">{{ $user->name }}</h3>
                                        <span class="badge bg-warning text-dark fw-bold me-2">{{ $user->role_name ?? 'Health Officer' }}</span>
                                        <span class="text-muted small">ID: {{ $user->user_id ?? 'ID-001' }}</span>
                                    </div>
                                </div>
                                <div class="ms-auto d-flex gap-2">
                                    <button type="submit" class="btn btn-warning text-white fw-bold px-4">
                                        <i class="fas fa-save me-1"></i> Save Changes
                                    </button>
                                    <a href="{{ route('home') }}" class="btn btn-secondary px-3">Cancel</a>
                                </div>
                            </div>
                        </div>

                        <!-- Form Input Grid -->
                        <div class="row g-3">
                            <!-- First Name -->
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label fw-bold">First Name <span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $firstName) }}" required>
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label fw-bold">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $lastName) }}" required>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label fw-bold">Contact Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone_number ?? '+63 900 000 0000') }}" placeholder="+63 9XX XXX XXXX">
                                </div>
                            </div>

                            <!-- System User ID (Read-only) -->
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label fw-bold">System Staff ID</label>
                                    <input type="text" class="form-control bg-light" value="{{ $user->user_id ?? 'ID0001' }}" readonly>
                                </div>
                            </div>

                            <!-- User Role (Read-only) -->
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label fw-bold">Assigned Role</label>
                                    <input type="text" class="form-control bg-light" value="{{ $user->role_name ?? 'Health Staff' }}" readonly>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label fw-bold">New Password <small class="text-muted">(Leave blank to keep current password)</small></label>
                                    <input type="password" name="password" class="form-control" placeholder="••••••••" minlength="6">
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label class="form-label fw-bold">Confirm New Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" minlength="6">
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="col-12 mt-4 d-flex gap-2">
                                <button type="submit" class="btn btn-warning text-white fw-bold px-4 py-2">
                                    <i class="fas fa-check-circle me-1"></i> Update Profile
                                </button>
                                <a href="{{ route('home') }}" class="btn btn-secondary px-4 py-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection