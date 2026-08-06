@extends('layouts.master')

@section('content')
<div class="content">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-title">
            <h4>Prescription (Rx) Directory</h4>
            <h6>Barangay Bacsay Health Center Prescribed Medications</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('prescriptions.create') }}" class="btn btn-added">
                <i class="fas fa-pills me-1"></i> Issue New Prescription
            </a>
        </div>
    </div>

    <!-- Prescriptions Card -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datanew table-hover">
                    <thead>
                        <tr>
                            <th>Rx ID</th>
                            <th>Patient Name</th>
                            <th>Date Issued</th>
                            <th>Items Count</th>
                            <th>Medicines Summary</th>
                            <th>Attending Nurse</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prescriptions as $rx)
                        <tr>
                            <td><span class="badge bg-danger-subtle text-danger fw-bold">{{ $rx['id'] }}</span></td>
                            <td class="fw-semibold">{{ $rx['patient_name'] }}</td>
                            <td>{{ $rx['date'] }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $rx['medicines_count'] }} meds</span></td>
                            <td>{{ $rx['medicines_summary'] }}</td>
                            <td>{{ $rx['attending_nurse'] }}</td>
                            <td class="text-center">
                                <a href="{{ route('print.prescription', ['id' => $rx['id']]) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-print me-1"></i> Print Rx Form
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
@endsection
