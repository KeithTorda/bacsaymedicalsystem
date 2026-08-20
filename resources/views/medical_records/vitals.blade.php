@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <!-- Page Header -->
        <div class="page-header d-flex flex-wrap justify-content-between align-items-center mb-4">
            <div class="page-title mb-2 mb-md-0">
                <h4>Patient Vital Signs Monitoring Center</h4>
                <h6>Real-time physiological measurements, triage monitoring, and biometric assessments</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('consultations.create') }}" class="btn btn-added">
                    <i class="fas fa-heartbeat me-1"></i> Record New Consultation & Vitals
                </a>
            </div>
        </div>

        <!-- Summary KPI Cards (Standardized Clean Dashboard Widgets) -->
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-clipboard-check" style="font-size: 22px; color: #f96e6f;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="{{ count($consultations) }}">{{ count($consultations) }}</span></h5>
                        <h6>Total Vital Sets Recorded</h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-heart" style="font-size: 22px; color: #28c76f;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="{{ $consultations->whereNotNull('bp')->count() }}">{{ $consultations->whereNotNull('bp')->count() }}</span></h5>
                        <h6>Blood Pressure Screenings</h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash2">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-thermometer-half" style="font-size: 22px; color: #00cfe8;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="{{ $consultations->whereNotNull('temperature')->count() }}">{{ $consultations->whereNotNull('temperature')->count() }}</span></h5>
                        <h6>Temperature Checks</h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash3">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-user-nurse" style="font-size: 22px; color: #ea5455;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span>Luna, Apayao</span></h5>
                        <h6>Barangay Health Center</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vital Signs DataTable -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-semibold">
                    <i class="fas fa-stethoscope text-primary me-2"></i> Clinical Vital Signs Log Sheet
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datanew table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Patient ID</th>
                                <th>Patient Name</th>
                                <th>Blood Pressure</th>
                                <th>Body Temp</th>
                                <th>Pulse Rate</th>
                                <th>Resp. Rate</th>
                                <th>Height / Weight (BMI)</th>
                                <th>Attending Officer</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($consultations as $c)
                            @php
                                $pt = $c->patient;
                                $bpVal = $c->bp ?? '120/80';
                                $isHighBP = false;
                                if (strpos($bpVal, '/') !== false) {
                                    $sys = (int) explode('/', $bpVal)[0];
                                    if ($sys >= 140) $isHighBP = true;
                                }

                                $tempVal = (float) filter_var($c->temperature ?? 36.5, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                $isFever = $tempVal >= 37.8;

                                // BMI calculation if height and weight available
                                $h = (float) filter_var($c->height ?? 0, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                $w = (float) filter_var($c->weight ?? 0, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                $bmiText = 'N/A';
                                if ($h > 0 && $w > 0) {
                                    $hMeter = $h > 3 ? ($h / 100) : $h; // convert cm to m
                                    $bmi = round($w / ($hMeter * $hMeter), 1);
                                    $bmiText = $bmi . ' kg/m²';
                                }
                            @endphp
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($c->visit_date)->format('M d, Y') }}</td>
                                <td>
                                    <span class="badge bg-outline-primary fw-bold">{{ $pt ? $pt->patient_code : ('BAC-' . sprintf('%03d', $c->patient_id)) }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $pt ? $pt->name : 'Walk-in Patient' }}</div>
                                    <small class="text-muted">{{ $pt ? ($pt->sex . ' • ' . $pt->age . ' yrs') : '' }}</small>
                                </td>
                                <td>
                                    <span class="badge {{ $isHighBP ? 'bg-danger-subtle text-danger border border-danger' : 'bg-primary-subtle text-primary' }} fw-bold" style="font-size: 12.5px;">
                                        <i class="fas fa-heartbeat me-1"></i> {{ $c->bp ?? '120/80 mmHg' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $isFever ? 'bg-warning-subtle text-warning border border-warning' : 'bg-light text-dark' }} fw-bold">
                                        {{ $c->temperature ?? '36.5' }} °C
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark">{{ $c->pulse_rate ?? '75' }} bpm</span>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark">{{ $c->respiratory_rate ?? '18' }} cpm</span>
                                </td>
                                <td>
                                    <div class="fw-medium text-dark">{{ $c->height ?? '160 cm' }} / {{ $c->weight ?? '55 kg' }}</div>
                                    @if($bmiText !== 'N/A')
                                        <span class="badge bg-lightgreen text-success fs-8">BMI: {{ $bmiText }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-secondary fw-medium">{{ $c->attending_nurse ?? 'Health Center Staff' }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('print.consultation', $c->id) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Print Consultation Sheet">
                                        <i class="fas fa-print me-1"></i> Print
                                    </a>
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
