@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <!-- Page Header -->
        <div class="page-header mb-4">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title fw-bold">General Settings</h3>
                    <ul class="breadcrumb bg-transparent p-0 m-0 fs-7 text-muted">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Form Container -->
        <form id="settings_form" action="{{ route('settings.update') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Left Column: Site & Brand Details -->
                <div class="col-lg-8 col-sm-12">
                    <div class="card mb-4">
                        <div class="card-header bg-transparent border-bottom py-3">
                            <h5 class="card-title mb-0 fw-semibold">
                                <i class="fas fa-globe text-primary me-2"></i> System & Brand Details
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Application Name</label>
                                    <input type="text" name="app_name" class="form-control" value="BacsayMedSys" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Tagline / Description</label>
                                    <input type="text" name="app_tagline" class="form-control" value="Bacsay Medical Record Management System">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Support Contact Email</label>
                                    <input type="email" name="contact_email" class="form-control" value="healthcenter@bacsay.gov.ph" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Contact Phone Number</label>
                                    <input type="text" name="contact_phone" class="form-control" value="+63 917 123 4567">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Localization Card -->
                    <div class="card mb-4">
                        <div class="card-header bg-transparent border-bottom py-3">
                            <h5 class="card-title mb-0 fw-semibold">
                                <i class="fas fa-flag text-primary me-2"></i> Localization & Currency
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-medium">Currency Symbol</label>
                                    <input type="text" name="currency_symbol" class="form-control" value="₱" readonly>
                                    <small class="text-muted">Philippine Peso (PHP)</small>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-medium">Country Flag</label>
                                    <div class="d-flex align-items-center gap-2 p-2 border rounded">
                                        <img src="{{ asset('assets/img/flags/ph.svg') }}" alt="Philippine Flag" style="height: 20px; width: 28px; border-radius: 2px;">
                                        <span class="fs-7 fw-medium">Philippines (🇵🇭)</span>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-medium">System Timezone</label>
                                    <select name="timezone" class="form-select">
                                        <option value="Asia/Manila" selected>Asia/Manila (GMT+8)</option>
                                        <option value="UTC">UTC (GMT+0)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Brand Preview & Actions -->
                <div class="col-lg-4 col-sm-12">
                    <!-- Brand Avatar Card -->
                    <div class="card mb-4 text-center p-3">
                        <div class="card-body">
                            <div class="mb-3">
                                <img src="{{ asset('assets/img/profiles/avatar-02.jpg') }}" alt="Bacsay Logo" class="rounded-circle shadow-sm" style="width: 90px; height: 90px; object-fit: cover; border: 3px solid #38bdf8;">
                            </div>
                            <h5 class="fw-bold mb-1">KBOT System Logo</h5>
                            <p class="text-muted fs-7 mb-3">JPG or PNG format, max 2MB</p>
                            <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" onclick="triggerLogoUpload()">
                                <i class="fas fa-upload me-1"></i> Upload New Logo
                            </button>
                        </div>
                    </div>

                    <!-- Actions & Confirmation Modals -->
                    <div class="card mb-4">
                        <div class="card-header bg-transparent border-bottom py-3">
                            <h5 class="card-title mb-0 fw-semibold">
                                <i class="fas fa-sliders-h text-primary me-2"></i> Actions & Confirmation
                            </h5>
                        </div>
                        <div class="card-body d-grid gap-2">
                            <!-- Save Settings Button -->
                            <button type="button" class="btn btn-primary fw-medium" id="btn_save_settings">
                                <i class="fas fa-save me-1"></i> Save Changes
                            </button>

                            <!-- Reset Defaults Button -->
                            <button type="button" class="btn btn-outline-danger fw-medium" id="btn_reset_defaults">
                                <i class="fas fa-undo me-1"></i> Reset System Defaults
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // SweetAlert2 Confirmation Dialog for Save Settings
        const saveBtn = document.getElementById('btn_save_settings');
        if (saveBtn) {
            saveBtn.addEventListener('click', function() {
                confirmAction({
                    title: 'Save General Settings?',
                    text: 'Are you sure you want to save and apply these system settings?',
                    icon: 'question',
                    confirmButtonText: 'Yes, Save Settings',
                    confirmButtonColor: '#38bdf8'
                }, function() {
                    document.getElementById('settings_form').submit();
                });
            });
        }

        // SweetAlert2 Warning Confirmation Dialog for Reset Defaults
        const resetBtn = document.getElementById('btn_reset_defaults');
        if (resetBtn) {
            resetBtn.addEventListener('click', function() {
                confirmAction({
                    title: 'Reset All Settings?',
                    text: 'Warning! This will restore all system preferences back to factory defaults!',
                    icon: 'warning',
                    confirmButtonText: 'Yes, Reset Defaults',
                    confirmButtonColor: '#ef4444'
                }, function() {
                    Swal.fire({
                        icon: 'info',
                        title: 'Reset Complete',
                        text: 'System settings have been restored to defaults!',
                        timer: 2500,
                        showConfirmButton: false,
                        background: document.body.getAttribute('data-theme') === 'dark' ? '#121214' : '#ffffff',
                        color: document.body.getAttribute('data-theme') === 'dark' ? '#f8fafc' : '#0f172a',
                    });
                });
            });
        }
    });

    function triggerLogoUpload() {
        Swal.fire({
            title: 'Upload Brand Logo',
            text: 'Select a image file from your computer (PNG/JPG)',
            input: 'file',
            inputAttributes: {
                'accept': 'image/*',
                'aria-label': 'Upload your brand logo'
            },
            showCancelButton: true,
            confirmButtonText: 'Upload',
            confirmButtonColor: '#38bdf8',
            background: document.body.getAttribute('data-theme') === 'dark' ? '#121214' : '#ffffff',
            color: document.body.getAttribute('data-theme') === 'dark' ? '#f8fafc' : '#0f172a',
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    icon: 'success',
                    title: 'Logo Uploaded!',
                    text: 'Brand avatar updated successfully.',
                    timer: 2500,
                    showConfirmButton: false,
                    background: document.body.getAttribute('data-theme') === 'dark' ? '#121214' : '#ffffff',
                    color: document.body.getAttribute('data-theme') === 'dark' ? '#f8fafc' : '#0f172a',
                });
            }
        });
    }
</script>
@endsection
