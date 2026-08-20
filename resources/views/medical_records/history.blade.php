@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <!-- Page Header -->
        <div class="page-header d-flex flex-wrap justify-content-between align-items-center mb-4">
            <div class="page-title mb-2 mb-md-0">
                <h4>Patient Medical History Archive</h4>
                <h6>Comprehensive medical history, cumulative visit logs, and longitudinal patient health profiles</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('patients.create') }}" class="btn btn-added">
                    <i class="fas fa-user-plus me-1"></i> Register New Patient
                </a>
            </div>
        </div>

        <!-- Summary KPI Cards (Standardized Clean Dashboard Widgets) -->
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-users" style="font-size: 22px; color: #f96e6f;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="{{ count($patients) }}">{{ count($patients) }}</span></h5>
                        <h6>Total Registered Patients</h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-notes-medical" style="font-size: 22px; color: #28c76f;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="{{ $patients->sum('consultations_count') }}">{{ $patients->sum('consultations_count') }}</span></h5>
                        <h6>Total Encounters Logged</h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash2">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-heartbeat" style="font-size: 22px; color: #00cfe8;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="{{ $patients->where('consultations_count', '>', 1)->count() }}">{{ $patients->where('consultations_count', '>', 1)->count() }}</span></h5>
                        <h6>Returning / Chronic Care</h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash3">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-print" style="font-size: 22px; color: #ea5455;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span>DOH Aligned</span></h5>
                        <h6>Official Forms Available</h6>
                    </div>
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
                                            <i class="fas fa-eye me-1"></i> Profile
                                        </a>
                                        <a href="{{ route('print.medical-record', $pt->id) }}" target="_blank" class="btn btn-sm btn-outline-success" title="Print Official Clinical Record">
                                            <i class="fas fa-print me-1"></i> Record
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
