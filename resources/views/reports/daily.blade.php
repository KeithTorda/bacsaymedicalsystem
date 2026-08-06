@extends('layouts.master')

@section('content')
<div class="content">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-title">
            <h4>Health Center Clinical Reports & Analytics</h4>
            <h6>Barangay Bacsay Health Center Summary Statistics</h6>
        </div>
        <div class="page-btn">
            <button type="button" onclick="window.print();" class="btn btn-outline-secondary">
                <i class="fas fa-print me-1"></i> Print / Export PDF
            </button>
        </div>
    </div>

    <!-- Analytics Charts Row -->
    <div class="row">
        <!-- Most Common Diseases Chart -->
        <div class="col-lg-6 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title fw-bold m-0"><i class="fas fa-virus-slash text-danger me-2"></i>Most Common Diagnosed Diseases</h5>
                </div>
                <div class="card-body">
                    <div id="common_diseases_chart" style="min-height: 280px;"></div>
                </div>
            </div>
        </div>

        <!-- Patients by Age Group Chart -->
        <div class="col-lg-6 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title fw-bold m-0"><i class="fas fa-users-cog text-info me-2"></i>Patient Demographic Distribution by Age</h5>
                </div>
                <div class="card-body">
                    <div id="age_group_chart" style="min-height: 280px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daily Consultation Report Table -->
    <div class="card mt-3">
        <div class="card-header">
            <h5 class="card-title fw-bold m-0"><i class="fas fa-table me-2"></i>Daily Consultation Log Sheet</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Patient ID</th>
                            <th>Patient Name</th>
                            <th>Age/Sex</th>
                            <th>Barangay Address</th>
                            <th>Diagnosis</th>
                            <th>Attending Officer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>BAC-2026-001</td>
                            <td class="fw-semibold">Maria Clara Santos</td>
                            <td>34 / Female</td>
                            <td>Purok 1</td>
                            <td>Essential Hypertension</td>
                            <td>Nurse Teresa Alonzo, RN</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>BAC-2026-002</td>
                            <td class="fw-semibold">Juan Dela Cruz</td>
                            <td>40 / Male</td>
                            <td>Purok 3</td>
                            <td>Type 2 Diabetes Mellitus</td>
                            <td>Nurse Teresa Alonzo, RN</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>BAC-2026-003</td>
                            <td class="fw-semibold">Ana Marie Ramos</td>
                            <td>25 / Female</td>
                            <td>Purok 2</td>
                            <td>Acute Asthma Exacerbation</td>
                            <td>Nurse Teresa Alonzo, RN</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>BAC-2026-004</td>
                            <td class="fw-semibold">Roberto Garcia Jr.</td>
                            <td>67 / Male</td>
                            <td>Purok 4</td>
                            <td>Osteoarthritis</td>
                            <td>Nurse Teresa Alonzo, RN</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Most Common Diseases Donut Chart
        if (document.querySelector("#common_diseases_chart")) {
            var optionsDiseases = {
                series: [42, 28, 18, 12, 10],
                chart: { type: 'donut', height: 280 },
                labels: ['Hypertension', 'Upper Respiratory Infection', 'Type 2 Diabetes', 'Asthma', 'Arthritis'],
                colors: ['#ef4444', '#f59e0b', '#3b82f6', '#10b981', '#8b5cf6'],
                legend: { position: 'bottom' }
            };
            var chartDiseases = new ApexCharts(document.querySelector("#common_diseases_chart"), optionsDiseases);
            chartDiseases.render();
        }

        // Patients by Age Group Column Chart
        if (document.querySelector("#age_group_chart")) {
            var optionsAge = {
                series: [{
                    name: 'Patients',
                    data: [145, 230, 310, 280, 190, 93]
                }],
                chart: { type: 'bar', height: 280, toolbar: { show: false } },
                colors: ['#0284c7'],
                plotOptions: { bar: { borderRadius: 6, horizontal: true } },
                xaxis: { categories: ['0-12 yrs (Pediatric)', '13-19 yrs (Teens)', '20-39 yrs (Adults)', '40-59 yrs (Middle Age)', '60-74 yrs (Senior)', '75+ yrs'] }
            };
            var chartAge = new ApexCharts(document.querySelector("#age_group_chart"), optionsAge);
            chartAge.render();
        }
    });
</script>
@endsection
