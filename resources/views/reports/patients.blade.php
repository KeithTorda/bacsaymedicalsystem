@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <!-- Page Header & Actions -->
        <div class="page-header d-flex flex-wrap justify-content-between align-items-center mb-4">
            <div class="page-title mb-2 mb-md-0">
                <h4>Barangay Bacsay Patient Demographics & Census Report</h4>
                <h6>Longitudinal resident health census, epidemiological demographics, and community vital statistics</h6>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button type="button" onclick="window.print();" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-print me-1"></i> Print Demographics Report
                </button>
                <a href="{{ route('patients.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-user-plus me-1"></i> Register Resident
                </a>
            </div>
        </div>

        <!-- Census Demographic Overview Cards (Standardized Clean Dashboard Widgets) -->
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-users" style="font-size: 22px; color: #f96e6f;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="{{ $totalPatients }}">{{ $totalPatients }}</span></h5>
                        <h6>Registered Bacsay Residents</h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-venus-mars" style="font-size: 22px; color: #28c76f;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span>{{ $maleCount }}M / {{ $femaleCount }}F</span></h5>
                        <h6>Gender Ratio ({{ $totalPatients > 0 ? round(($maleCount / $totalPatients) * 100) : 0 }}% M)</h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash2">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-blind" style="font-size: 22px; color: #00cfe8;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="{{ ($ageGroups['60-74 yrs (Senior)'] ?? 0) + ($ageGroups['75+ yrs (Geriatric)'] ?? 0) }}">{{ ($ageGroups['60-74 yrs (Senior)'] ?? 0) + ($ageGroups['75+ yrs (Geriatric)'] ?? 0) }}</span></h5>
                        <h6>Senior Citizens (60+ yrs)</h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash3">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-baby" style="font-size: 22px; color: #ea5455;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="{{ $ageGroups['0-12 yrs (Pediatric)'] ?? 0 }}">{{ $ageGroups['0-12 yrs (Pediatric)'] ?? 0 }}</span></h5>
                        <h6>Children (0-12 yrs)</h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Demographic Visual Charts Row -->
        <div class="row mb-4">
            <!-- Age Group Horizontal Bar Chart -->
            <div class="col-lg-7 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title fw-bold m-0">
                            <i class="fas fa-chart-bar text-primary me-2"></i>Age Group & Life Stage Demographic Distribution
                        </h5>
                    </div>
                    <div class="card-body">
                        <div id="patient_age_pyramid_chart" style="min-height: 290px;"></div>
                    </div>
                </div>
            </div>

            <!-- Gender Distribution Donut Chart -->
            <div class="col-lg-5 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title fw-bold m-0">
                            <i class="fas fa-pie-chart text-info me-2"></i>Gender Demographics Breakdown
                        </h5>
                    </div>
                    <div class="card-body">
                        <div id="patient_gender_chart" style="min-height: 290px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Demographics Breakdown Chips Card (Blood Types & Civil Status) -->
        <div class="row mb-4">
            <!-- Blood Type Distribution -->
            <div class="col-lg-6 col-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title fw-bold m-0">
                            <i class="fas fa-tint text-danger me-2"></i>Community Blood Type Distribution
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            @forelse($bloodTypes as $type => $count)
                                <div class="p-2 px-3 border rounded d-flex align-items-center gap-2 bg-light">
                                    <span class="badge bg-danger text-white rounded-circle p-2 fs-7 fw-bold">{{ $type ?: 'N/A' }}</span>
                                    <div>
                                        <div class="fw-bold text-dark fs-6">{{ $count }} {{ Str::plural('patient', $count) }}</div>
                                        <small class="text-muted">{{ $totalPatients > 0 ? round(($count / $totalPatients) * 100, 1) : 0 }}% of total</small>
                                    </div>
                                </div>
                            @empty
                                <span class="text-muted">No blood type data recorded yet.</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Purok / Zone Distribution -->
            <div class="col-lg-6 col-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title fw-bold m-0">
                            <i class="fas fa-map-marker-alt text-success me-2"></i>Barangay Bacsay Zone & Purok Census
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            @forelse($purokDistribution as $address => $count)
                                <div class="p-2 px-3 border rounded d-flex align-items-center gap-2 bg-light">
                                    <span class="badge bg-primary text-white rounded-pill px-2 py-1 fs-7 fw-bold">{{ $count }}</span>
                                    <div>
                                        <div class="fw-bold text-dark fs-7">{{ $address ?: 'Bacsay Proper' }}</div>
                                        <small class="text-muted">{{ $totalPatients > 0 ? round(($count / $totalPatients) * 100, 1) : 0 }}% of census</small>
                                    </div>
                                </div>
                            @empty
                                <span class="text-muted">No address data recorded yet.</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Master Patient Census Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-semibold">
                    <i class="fas fa-id-card text-primary me-2"></i> Resident Demographic Directory
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datanew table-hover">
                        <thead>
                            <tr>
                                <th>Patient ID</th>
                                <th>Resident Full Name</th>
                                <th>Sex</th>
                                <th>Age</th>
                                <th>Civil Status</th>
                                <th>Blood Type</th>
                                <th>Contact Number</th>
                                <th>Barangay Bacsay Address</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $pt)
                            <tr>
                                <td><span class="badge bg-outline-primary fw-bold">{{ $pt->patient_code }}</span></td>
                                <td><a href="{{ route('patients.show', $pt->id) }}" class="fw-bold text-dark text-decoration-none">{{ $pt->name }}</a></td>
                                <td>{{ ucfirst($pt->sex ?? 'Unspecified') }}</td>
                                <td>{{ $pt->age ?? (\Carbon\Carbon::parse($pt->birthdate)->age ?? 'N/A') }} yrs</td>
                                <td>{{ $pt->civil_status ?? 'Single' }}</td>
                                <td><span class="badge bg-danger-subtle text-danger fw-bold">{{ $pt->blood_type ?? 'N/A' }}</span></td>
                                <td>{{ $pt->contact ?? 'N/A' }}</td>
                                <td>{{ $pt->address ?? 'Barangay Bacsay, Luna' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('patients.show', $pt->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye me-1"></i> Profile
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

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Age Group Horizontal Bar Chart
        if (document.querySelector("#patient_age_pyramid_chart")) {
            var ageCategories = @json(array_keys($ageGroups));
            var ageValues = @json(array_values($ageGroups));

            var optionsAge = {
                series: [{
                    name: 'Residents',
                    data: ageValues
                }],
                chart: {
                    type: 'bar',
                    height: 290,
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        horizontal: true,
                        distributed: true
                    }
                },
                colors: ['#06b6d4', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899'],
                xaxis: {
                    categories: ageCategories,
                    labels: { style: { fontSize: '11px' } }
                },
                legend: { show: false }
            };
            var chartAge = new ApexCharts(document.querySelector("#patient_age_pyramid_chart"), optionsAge);
            chartAge.render();
        }

        // 2. Gender Donut Chart
        if (document.querySelector("#patient_gender_chart")) {
            var maleCount = {{ $maleCount }};
            var femaleCount = {{ $femaleCount }};
            var otherCount = {{ $unspecifiedGender }};

            var seriesGender = [maleCount, femaleCount];
            var labelsGender = ['Male', 'Female'];
            var colorsGender = ['#0284c7', '#ec4899'];

            if (otherCount > 0) {
                seriesGender.push(otherCount);
                labelsGender.push('Unspecified');
                colorsGender.push('#94a3b8');
            }

            var optionsGender = {
                series: seriesGender,
                chart: {
                    type: 'donut',
                    height: 290
                },
                labels: labelsGender,
                colors: colorsGender,
                legend: { position: 'bottom', fontSize: '12px' },
                dataLabels: { enabled: true }
            };
            var chartGender = new ApexCharts(document.querySelector("#patient_gender_chart"), optionsGender);
            chartGender.render();
        }
    });
</script>
@endsection
