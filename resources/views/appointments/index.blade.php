@extends('layouts.master')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Patient Appointments Schedule</h4>
            <h6>Barangay Bacsay Health Center Follow-Up & Appointment Calendar</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datanew table-hover">
                    <thead>
                        <tr>
                            <th>Patient ID</th>
                            <th>Patient Name</th>
                            <th>Follow-Up Date</th>
                            <th>Purpose</th>
                            <th>Attending Nurse</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="badge bg-primary-subtle text-primary fw-bold">BAC-2026-001</span></td>
                            <td class="fw-semibold">Maria Clara Santos</td>
                            <td>Feb 19, 2026</td>
                            <td>BP Re-assessment & Medication Review</td>
                            <td>Nurse Teresa Alonzo, RN</td>
                            <td><span class="badge bg-warning-subtle text-warning fw-bold">Upcoming</span></td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-primary-subtle text-primary fw-bold">BAC-2026-002</span></td>
                            <td class="fw-semibold">Juan Dela Cruz</td>
                            <td>Feb 12, 2026</td>
                            <td>Fasting Blood Sugar Monitoring</td>
                            <td>Nurse Teresa Alonzo, RN</td>
                            <td><span class="badge bg-warning-subtle text-warning fw-bold">Upcoming</span></td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-primary-subtle text-primary fw-bold">BAC-2026-004</span></td>
                            <td class="fw-semibold">Roberto Garcia Jr.</td>
                            <td>Feb 08, 2026</td>
                            <td>Joint Pain Check-Up</td>
                            <td>Nurse Teresa Alonzo, RN</td>
                            <td><span class="badge bg-success-subtle text-success fw-bold">Completed</span></td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-primary-subtle text-primary fw-bold">BAC-2026-003</span></td>
                            <td class="fw-semibold">Ana Marie Ramos</td>
                            <td>Feb 06, 2026</td>
                            <td>Asthma Follow-Up & Inhaler Review</td>
                            <td>Nurse Teresa Alonzo, RN</td>
                            <td><span class="badge bg-success-subtle text-success fw-bold">Completed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
