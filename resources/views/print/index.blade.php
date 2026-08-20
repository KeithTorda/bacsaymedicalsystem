@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <!-- Page Header -->
        <div class="page-header d-flex flex-wrap justify-content-between align-items-center mb-4">
            <div class="page-title mb-2 mb-md-0">
                <h4>Print Records Center & Official Document Hub</h4>
                <h6>Generate, preview, and print official Barangay Bacsay Health Center clinical records, prescriptions, and referral slips</h6>
            </div>
            <div>
                <a href="{{ route('patients.create') }}" class="btn btn-added">
                    <i class="fas fa-user-plus me-1"></i> Register New Patient
                </a>
            </div>
        </div>

        <!-- Document Shortcuts Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-sm-6 col-12 d-flex mb-3 mb-lg-0">
                <div class="dash-count das1 w-100 p-3 rounded text-white">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fs-4"><i class="fas fa-id-card"></i></span>
                        <a href="{{ route('print.patient') }}" target="_blank" class="badge bg-white text-primary text-decoration-none fw-bold">
                            <i class="fas fa-print me-1"></i> Sample
                        </a>
                    </div>
                    <h5 class="fw-bold mb-1">Patient Info Sheet</h5>
                    <p class="mb-0 fs-7 text-white-50">Demographics, Allergies & Emergency Contact</p>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12 d-flex mb-3 mb-lg-0">
                <div class="dash-count das3 w-100 p-3 rounded text-white">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fs-4"><i class="fas fa-file-medical-alt"></i></span>
                        <a href="{{ route('print.medical-record') }}" target="_blank" class="badge bg-white text-success text-decoration-none fw-bold">
                            <i class="fas fa-print me-1"></i> Sample
                        </a>
                    </div>
                    <h5 class="fw-bold mb-1">Clinical Record</h5>
                    <p class="mb-0 fs-7 text-white-50">Consultations, Diagnosis & Vitals</p>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12 d-flex mb-3 mb-lg-0">
                <div class="dash-count das2 w-100 p-3 rounded text-white">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fs-4"><i class="fas fa-prescription"></i></span>
                        <a href="{{ route('print.prescription') }}" target="_blank" class="badge bg-white text-dark text-decoration-none fw-bold">
                            <i class="fas fa-print me-1"></i> Sample
                        </a>
                    </div>
                    <h5 class="fw-bold mb-1">Prescription (Rx)</h5>
                    <p class="mb-0 fs-7 text-white-50">Official Medication Orders & Notes</p>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12 d-flex mb-3 mb-lg-0">
                <div class="dash-count w-100 p-3 rounded text-white" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fs-4"><i class="fas fa-notes-medical"></i></span>
                        <a href="{{ route('print.referral') }}" target="_blank" class="badge bg-white text-warning text-decoration-none fw-bold" style="color: #b45309 !important;">
                            <i class="fas fa-print me-1"></i> Sample
                        </a>
                    </div>
                    <h5 class="fw-bold mb-1">Referral Slip</h5>
                    <p class="mb-0 fs-7 text-white-50">Hospital & Specialist Transfer Slip</p>
                </div>
            </div>
        </div>

        <!-- Patient Selection Table for Instant Document Printing -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-semibold">
                    <i class="fas fa-print text-primary me-2"></i> Select Patient to Generate Official Document
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datanew table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient ID</th>
                                <th>Full Name</th>
                                <th>Sex / Age</th>
                                <th>Contact Number</th>
                                <th class="text-center">Official Printable Documents</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $key => $patient)
                            @php
                                $ptCode = $patient->patient_code ?? $patient->patient_id ?? ('BAC-2026-' . sprintf('%03d', $patient->id));
                                $ptName = $patient->name ?? $patient->full_name ?? ($patient->first_name . ' ' . $patient->last_name);
                                $dob = $patient->birthdate ?? $patient->date_of_birth;
                                $age = $patient->age ?? ($dob ? \Carbon\Carbon::parse($dob)->age : 'N/A');
                                $contact = $patient->contact ?? $patient->contact_number ?? 'N/A';
                            @endphp
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><span class="badge bg-outline-primary fw-bold">{{ $ptCode }}</span></td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $ptName }}</div>
                                    <small class="text-muted">{{ $patient->address ?? 'Barangay Bacsay' }}</small>
                                </td>
                                <td>{{ ucfirst($patient->sex ?? 'Unspecified') }} ({{ $age }} yrs)</td>
                                <td>{{ $contact }}</td>
                                <td class="text-center">
                                    <div class="d-flex flex-wrap justify-content-center gap-1">
                                        <a href="{{ route('print.patient', $patient->id) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Print Patient Information Sheet">
                                            <i class="fas fa-id-card me-1"></i> Patient Sheet
                                        </a>
                                        <a href="{{ route('print.medical-record', $patient->id) }}" target="_blank" class="btn btn-sm btn-outline-success" title="Print Clinical Medical Record">
                                            <i class="fas fa-file-medical me-1"></i> Record
                                        </a>
                                        <a href="{{ route('print.prescription', $patient->id) }}" target="_blank" class="btn btn-sm btn-outline-info" title="Print Official Prescription (Rx)">
                                            <i class="fas fa-pills me-1"></i> Rx Form
                                        </a>
                                        <a href="{{ route('print.referral', $patient->id) }}" target="_blank" class="btn btn-sm btn-outline-warning" title="Print Inter-Facility Referral Slip">
                                            <i class="fas fa-file-export me-1"></i> Referral
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
