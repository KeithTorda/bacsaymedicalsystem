@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title">
                <h4>Patient Medical History Archive</h4>
                <h6>Comprehensive medical history, cumulative visit logs, and longitudinal patient health profiles</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('patients.create') }}" class="btn btn-added">
                    <i class="fas fa-user-plus me-1"></i> Register New Patient
                </a>
            </div>
        </div>

        <!-- Summary KPI Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das1 w-100 p-3 rounded text-white">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fs-4"><i class="fas fa-users"></i></span>
                        <span class="badge bg-white text-primary fw-bold">Active Records</span>
                    </div>
                    <h3 class="fw-bold mb-1">{{ count($patients) }}</h3>
                    <p class="mb-0 fs-7 text-white-50">Total Registered Patients</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das2 w-100 p-3 rounded text-white">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fs-4"><i class="fas fa-notes-medical"></i></span>
                        <span class="badge bg-white text-dark fw-bold">Consultations</span>
                    </div>
                    <h3 class="fw-bold mb-1">{{ $patients->sum('consultations_count') }}</h3>
                    <p class="mb-0 fs-7 text-white-50">Total Encounters Logged</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das3 w-100 p-3 rounded text-white">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fs-4"><i class="fas fa-heartbeat"></i></span>
                        <span class="badge bg-white text-success fw-bold">Monitored</span>
                    </div>
                    <h3 class="fw-bold mb-1">{{ $patients->where('consultations_count', '>', 1)->count() }}</h3>
                    <p class="mb-0 fs-7 text-white-50">Returning / Chronic Care</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count w-100 p-3 rounded text-white" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%) !important;">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fs-4"><i class="fas fa-print"></i></span>
                        <a href="{{ route('print.index') }}" class="badge bg-white text-primary text-decoration-none fw-bold">Print Hub</a>
                    </div>
                    <h3 class="fw-bold mb-1">DOH Aligned</h3>
                    <p class="mb-0 fs-7 text-white-50">Official Forms Available</p>
                </div>
            </div>
        </div>

        <!-- Medical History Data Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-semibold">
                    <i class="fas fa-archive text-primary me-2"></i> Patient Longitudinal Health Records
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datanew table-hover">
                        <thead>
                            <tr>
                                <th>Patient ID</th>
                                <th>Patient Full Name</th>
                                <th>Sex / Age</th>
                                <th>Address (Barangay Bacsay)</th>
                                <th>Total Visits</th>
                                <th>Last Consultation</th>
                                <th>Documented Diagnosis / Conditions</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $pt)
                            @php
                                $latestConsult = $pt->consultations->first();
                                $visitCount = $pt->consultations_count ?? $pt->consultations->count();
                                $lastVisitDate = $latestConsult ? \Carbon\Carbon::parse($latestConsult->visit_date)->format('M d, Y') : \Carbon\Carbon::parse($pt->created_at)->format('M d, Y');
                                $primaryDiagnosis = $latestConsult->diagnosis ?? $pt->diseases ?? 'Routine Checkup';
                            @endphp
                            <tr>
                                <td>
                                    <span class="badge bg-outline-primary fw-bold">{{ $pt->patient_code ?? ('BAC-' . sprintf('%03d', $pt->id)) }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-2 bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px;">
                                            {{ strtoupper(substr($pt->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <a href="{{ route('patients.show', $pt->id) }}" class="fw-bold text-dark text-decoration-none">
                                                {{ $pt->name }}
                                            </a>
                                            <div class="text-muted fs-8">{{ $pt->contact ?? 'No contact' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ ucfirst($pt->sex ?? 'Unspecified') }} • {{ $pt->age ?? (\Carbon\Carbon::parse($pt->birthdate)->age ?? 'N/A') }} yrs
                                </td>
                                <td>{{ $pt->address ?? 'Barangay Bacsay, Luna' }}</td>
                                <td>
                                    <span class="badge {{ $visitCount > 2 ? 'bg-primary-subtle text-primary' : 'bg-light text-dark' }} fw-bold">
                                        {{ $visitCount }} {{ Str::plural('visit', $visitCount) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-medium text-dark">{{ $lastVisitDate }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-lightgreen text-success" title="{{ $primaryDiagnosis }}">
                                        {{ Str::limit($primaryDiagnosis, 32) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('patients.show', $pt->id) }}" class="btn btn-sm btn-outline-primary" title="View Patient Full Profile">
                                            <i class="fas fa-eye"></i> Profile
                                        </a>
                                        <a href="{{ route('print.medical-record', $pt->id) }}" target="_blank" class="btn btn-sm btn-outline-success" title="Print Official Clinical Record">
                                            <i class="fas fa-print"></i> Record
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
