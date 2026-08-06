@extends('layouts.master')
@section('content')
<!-- Page-content -->
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-users" style="font-size: 22px; color: #f96e6f;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="1248">1,248</span></h5>
                        <h6>Total Registered Patients</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-calendar-day" style="font-size: 22px; color: #28c76f;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="18">18</span></h5>
                        <h6>Patients Today</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash2">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-stethoscope" style="font-size: 22px; color: #00cfe8;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="14">14</span></h5>
                        <h6>Today's Consultations</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash3">
                    <div class="dash-widgetimg">
                        <span><i class="fas fa-user-clock" style="font-size: 22px; color: #ea5455;"></i></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="6">6</span></h5>
                        <h6>Pending Follow-ups</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count">
                    <div class="dash-counts">
                        <h4>3,420</h4>
                        <h5>Total Medical Records</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="file-text"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das1">
                    <div class="dash-counts">
                        <h4>12</h4>
                        <h5>Prescriptions Today</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="clipboard"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das2">
                    <div class="dash-counts">
                        <h4>48</h4>
                        <h5>Referrals This Month</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="send"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das3">
                    <div class="dash-counts">
                        <h4>92</h4>
                        <h5>Appointments This Week</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="calendar"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row">
            <div class="col-lg-7 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Monthly Patient Registrations</h5>
                        <div class="graph-sets">
                            <ul>
                                <li>
                                    <span>Registrations</span>
                                </li>
                            </ul>
                            <div class="dropdown">
                                <button class="btn btn-white btn-sm dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    2026 <img src="{{ asset('assets/img/icons/dropdown.svg') }}" alt="img" class="ms-2">
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">2026</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">2025</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="patient_registration_chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Daily Consultations This Week</h4>
                        <div class="dropdown">
                            <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"
                                class="dropset">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a href="{{ route('reports.daily') }}" class="dropdown-item">View Daily Report</a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.monthly') }}" class="dropdown-item">View Monthly Report</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="daily_consultation_chart"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Patients Table -->
        <div class="card mb-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0">Recent Registered Patients</h4>
                    <a href="{{ route('patients.index') }}" class="btn btn-sm btn-outline-primary">View All Patients</a>
                </div>
                <div class="table-responsive dataview">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Patient ID</th>
                                <th>Full Name</th>
                                <th>Age / Sex</th>
                                <th>Contact Number</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="javascript:void(0);">BAC-2026-001</a></td>
                                <td class="productimgname">
                                    <a href="{{ route('patients.show', ['patient' => 'BAC-2026-001']) }}">Maria Clara Santos</a>
                                </td>
                                <td>34 / Female</td>
                                <td>09171234567</td>
                                <td>Purok 1, Brgy. Bacsay</td>
                                <td>
                                    <a href="{{ route('patients.show', ['patient' => 'BAC-2026-001']) }}" class="me-3">
                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="View">
                                    </a>
                                    <a href="{{ route('patients.edit', ['patient' => 'BAC-2026-001']) }}" class="me-3">
                                        <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="Edit">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="javascript:void(0);">BAC-2026-002</a></td>
                                <td class="productimgname">
                                    <a href="{{ route('patients.show', ['patient' => 'BAC-2026-002']) }}">Juan Dela Cruz</a>
                                </td>
                                <td>40 / Male</td>
                                <td>09289876543</td>
                                <td>Purok 3, Brgy. Bacsay</td>
                                <td>
                                    <a href="{{ route('patients.show', ['patient' => 'BAC-2026-002']) }}" class="me-3">
                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="View">
                                    </a>
                                    <a href="{{ route('patients.edit', ['patient' => 'BAC-2026-002']) }}" class="me-3">
                                        <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="Edit">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a href="javascript:void(0);">BAC-2026-003</a></td>
                                <td class="productimgname">
                                    <a href="{{ route('patients.show', ['patient' => 'BAC-2026-003']) }}">Ana Marie Ramos</a>
                                </td>
                                <td>25 / Female</td>
                                <td>09195554321</td>
                                <td>Purok 2, Brgy. Bacsay</td>
                                <td>
                                    <a href="{{ route('patients.show', ['patient' => 'BAC-2026-003']) }}" class="me-3">
                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="View">
                                    </a>
                                    <a href="{{ route('patients.edit', ['patient' => 'BAC-2026-003']) }}" class="me-3">
                                        <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="Edit">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><a href="javascript:void(0);">BAC-2026-004</a></td>
                                <td class="productimgname">
                                    <a href="{{ route('patients.show', ['patient' => 'BAC-2026-004']) }}">Roberto Garcia Jr.</a>
                                </td>
                                <td>67 / Male</td>
                                <td>09391112233</td>
                                <td>Purok 4, Brgy. Bacsay</td>
                                <td>
                                    <a href="{{ route('patients.show', ['patient' => 'BAC-2026-004']) }}" class="me-3">
                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="View">
                                    </a>
                                    <a href="{{ route('patients.edit', ['patient' => 'BAC-2026-004']) }}" class="me-3">
                                        <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="Edit">
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page-content -->
@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Monthly Patient Registrations ApexChart (same style as sales_charts)
        if (document.querySelector("#patient_registration_chart")) {
            var optionsReg = {
                series: [{
                    name: 'Registered Patients',
                    data: [65, 82, 95, 110, 125, 140, 155, 130, 145, 160, 150, 185]
                }],
                chart: {
                    type: 'area',
                    height: 280,
                    toolbar: { show: false },
                    zoom: { enabled: false }
                },
                colors: ['#38bdf8'],
                fill: {
                    type: 'gradient',
                    gradient: { opacityFrom: 0.4, opacityTo: 0.05 }
                },
                stroke: { curve: 'smooth', width: 3 },
                dataLabels: { enabled: true },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                }
            };
            var chartReg = new ApexCharts(document.querySelector("#patient_registration_chart"), optionsReg);
            chartReg.render();
        }

        // Daily Consultations ApexChart (same style as template bar charts)
        if (document.querySelector("#daily_consultation_chart")) {
            var optionsDaily = {
                series: [{
                    name: 'Consultations',
                    data: [12, 18, 15, 22, 19, 14, 8]
                }],
                chart: {
                    type: 'bar',
                    height: 280,
                    toolbar: { show: false }
                },
                colors: ['#28c76f'],
                plotOptions: {
                    bar: { borderRadius: 6, columnWidth: '45%' }
                },
                dataLabels: { enabled: true },
                xaxis: {
                    categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
                }
            };
            var chartDaily = new ApexCharts(document.querySelector("#daily_consultation_chart"), optionsDaily);
            chartDaily.render();
        }
    });
</script>
@endsection
@endsection
