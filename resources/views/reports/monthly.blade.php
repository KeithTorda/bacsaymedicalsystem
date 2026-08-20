@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <!-- Page Header & Controls -->
        <div class="page-header d-flex flex-wrap justify-content-between align-items-center mb-4">
            <div class="page-title mb-2 mb-md-0">
                <h4>Monthly Health Center Analytics & Report</h4>
                <h6>Barangay Bacsay Health Center — {{ \Carbon\Carbon::createFromDate($selectedYear, $selectedMonth, 1)->format('F Y') }} Clinical Summary</h6>
            </div>
            <div class="d-flex align-items-center gap-2">
                <!-- Month / Year Selector Form -->
                <form action="{{ route('reports.monthly') }}" method="GET" class="d-flex align-items-center gap-2">
                    <select name="month" class="form-select form-select-sm" style="width: 140px;">
                        @for($m = 1; $m <= 12; $m++)
                            @php $mStr = sprintf('%02d', $m); @endphp
                            <option value="{{ $mStr }}" {{ (int)$selectedMonth == $m ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $m, 10)) }}
                            </option>
                        @endfor
                    </select>
                    <select name="year" class="form-select form-select-sm" style="width: 100px;">
                        @for($y = 2025; $y <= 2027; $y++)
                            <option value="{{ $y }}" {{ (int)$selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                </form>

                <button type="button" onclick="window.print();" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-print me-1"></i> Print
                </button>
            </div>
        </div>

        <!-- Monthly KPI Stat Cards (Standardized Clean Dashboard Widgets) -->
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-calendar-check" style="font-size: 22px; color: #f96e6f;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="{{ $stats['total_consultations'] }}">{{ $stats['total_consultations'] }}</span></h5>
                        <h6>Total Consultations</h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-user-check" style="font-size: 22px; color: #28c76f;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="{{ $stats['unique_patients'] }}">{{ $stats['unique_patients'] }}</span></h5>
                        <h6>Unique Patients Served</h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash2">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-prescription-bottle-alt" style="font-size: 22px; color: #00cfe8;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="{{ $stats['prescriptions_issued'] }}">{{ $stats['prescriptions_issued'] }}</span></h5>
                        <h6>Medication Orders Issued</h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash3">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-user-plus" style="font-size: 22px; color: #ea5455;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="{{ $stats['new_patients'] }}">{{ $stats['new_patients'] }}</span></h5>
                        <h6>Newly Registered Residents</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Visual Analytics Grid -->
        <div class="row mb-4">
            <!-- Daily Trend Area Chart -->
            <div class="col-lg-8 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title fw-bold m-0">
                            <i class="fas fa-chart-area text-primary me-2"></i>Daily Consultation Trend for {{ \Carbon\Carbon::createFromDate($selectedYear, $selectedMonth, 1)->format('F Y') }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div id="monthly_trend_chart" style="min-height: 290px;"></div>
                    </div>
                </div>
            </div>

            <!-- Top Diseases Donut Chart -->
            <div class="col-lg-4 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title fw-bold m-0">
                            <i class="fas fa-pie-chart text-danger me-2"></i>Top Diagnoses Breakdown
                        </h5>
                    </div>
                    <div class="card-body">
                        <div id="monthly_disease_chart" style="min-height: 290px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Consultation Records Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-semibold">
                    <i class="fas fa-list-alt text-primary me-2"></i> Monthly Consultation Log ({{ count($consultations) }} Records)
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datanew table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Patient ID</th>
                                <th>Full Name</th>
                                <th>Sex / Age</th>
                                <th>Blood Pressure</th>
                                <th>Diagnosis</th>
                                <th>Attending Officer</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($consultations as $c)
                            @php $pt = $c->patient; @endphp
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($c->visit_date)->format('M d, Y') }}</td>
                                <td>
                                    <span class="badge bg-outline-primary fw-bold">{{ $pt ? $pt->patient_code : ('BAC-' . sprintf('%03d', $c->patient_id)) }}</span>
                                </td>
                                <td>
                                    <a href="{{ $pt ? route('patients.show', $pt->id) : '#' }}" class="fw-bold text-dark text-decoration-none">
                                        {{ $pt ? $pt->name : 'Walk-in Patient' }}
                                    </a>
                                </td>
                                <td>{{ $pt ? ($pt->sex . ' • ' . $pt->age . ' yrs') : 'N/A' }}</td>
                                <td><span class="badge bg-primary-subtle text-primary fw-bold">{{ $c->bp ?? '120/80' }}</span></td>
                                <td><span class="badge bg-lightgreen text-success">{{ $c->diagnosis }}</span></td>
                                <td>{{ $c->attending_nurse ?? 'Health Center Staff' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('print.consultation', $c->id) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-print"></i> Form
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    No consultations recorded for the selected month ({{ \Carbon\Carbon::createFromDate($selectedYear, $selectedMonth, 1)->format('F Y') }}).
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Monthly Daily Trend Spline Area Chart
        if (document.querySelector("#monthly_trend_chart")) {
            var categories = @json($trendCategories);
            var seriesData = @json($trendSeries);

            var optionsTrend = {
                series: [{
                    name: 'Consultations',
                    data: seriesData
                }],
                chart: {
                    type: 'area',
                    height: 290,
                    toolbar: { show: false }
                },
                colors: ['#0284c7'],
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 3 },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.45,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: categories,
                    labels: { style: { fontSize: '11px' } }
                },
                yaxis: {
                    min: 0,
                    forceNiceScale: true
                }
            };
            var chartTrend = new ApexCharts(document.querySelector("#monthly_trend_chart"), optionsTrend);
            chartTrend.render();
        }

        // 2. Monthly Diseases Donut Chart
        if (document.querySelector("#monthly_disease_chart")) {
            var diseaseLabels = @json($diseaseLabels);
            var diseaseData = @json($diseaseData);

            var optionsDisease = {
                series: diseaseData,
                chart: {
                    type: 'donut',
                    height: 290
                },
                labels: diseaseLabels,
                colors: ['#ef4444', '#f59e0b', '#0ea5e9', '#10b981', '#8b5cf6'],
                legend: { position: 'bottom', fontSize: '12px' },
                dataLabels: { enabled: true }
            };
            var chartDisease = new ApexCharts(document.querySelector("#monthly_disease_chart"), optionsDisease);
            chartDisease.render();
        }
    });
</script>
@endsection
