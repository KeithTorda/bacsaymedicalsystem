@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Print Records Center & Official Document Hub</h4>
                <h6>Generate and print official Barangay Bacsay Health Center medical forms, prescriptions, and patient records</h6>
            </div>
        </div>

        <!-- Document Shortcuts Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-sm-6 d-flex">
                <div class="dash-count w-100 p-3 rounded bg-primary-subtle border border-primary">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fs-4 text-primary"><i class="fas fa-id-card"></i></span>
                        <a href="{{ route('print.patient') }}" target="_blank" class="btn btn-sm btn-primary">Print Sample</a>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Patient Information Sheet</h6>
                    <small class="text-muted">Demographics, Allergies & Background</small>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 d-flex">
                <div class="dash-count w-100 p-3 rounded bg-success-subtle border border-success">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fs-4 text-success"><i class="fas fa-file-medical-alt"></i></span>
                        <a href="{{ route('print.medical-record') }}" target="_blank" class="btn btn-sm btn-success">Print Sample</a>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Clinical Medical Record</h6>
                    <small class="text-muted">Consultation, Diagnosis & Treatment</small>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 d-flex">
                <div class="dash-count w-100 p-3 rounded bg-info-subtle border border-info">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fs-4 text-info"><i class="fas fa-prescription"></i></span>
                        <a href="{{ route('print.prescription') }}" target="_blank" class="btn btn-sm btn-info text-white">Print Sample</a>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Prescription Form (Rx)</h6>
                    <small class="text-muted">Official Prescribed Medicines & Notes</small>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 d-flex">
                <div class="dash-count w-100 p-3 rounded bg-warning-subtle border border-warning">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fs-4 text-warning"><i class="fas fa-notes-medical"></i></span>
                        <a href="{{ route('print.referral') }}" target="_blank" class="btn btn-sm btn-warning text-dark fw-bold">Print Sample</a>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Patient Referral Slip</h6>
                    <small class="text-muted">Hospital / Specialist Transfer Form</small>
                </div>
            </div>
        </div>

        <!-- Patient Selection Table for Instant Document Printing -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0"><i class="fas fa-print text-primary me-2"></i> Select Patient to Generate Official Document</h5>
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
                                <th class="text-center">Available Printable Documents</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $key => $patient)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><span class="badge bg-outline-info fw-bold">{{ $patient->patient_id }}</span></td>
                                <td class="fw-bold text-dark">{{ $patient->full_name }}</td>
                                <td>{{ ucfirst($patient->sex) }} ({{ \Carbon\Carbon::parse($patient->date_of_birth)->age }} yrs)</td>
                                <td>{{ $patient->contact_number }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('print.patient', $patient->id) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Print Patient Info Sheet">
                                            <i class="fas fa-id-card me-1"></i> Patient Sheet
                                        </a>
                                        <a href="{{ route('print.medical-record', $patient->id) }}" target="_blank" class="btn btn-sm btn-outline-success" title="Print Medical Record">
                                            <i class="fas fa-file-medical me-1"></i> Record
                                        </a>
                                        <a href="{{ route('print.prescription', $patient->id) }}" target="_blank" class="btn btn-sm btn-outline-info" title="Print Prescription Rx">
                                            <i class="fas fa-pills me-1"></i> Prescription (Rx)
                                        </a>
                                        <a href="{{ route('print.referral', $patient->id) }}" target="_blank" class="btn btn-sm btn-outline-warning" title="Print Referral Form">
                                            <i class="fas fa-file-export me-1"></i> Referral Form
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
