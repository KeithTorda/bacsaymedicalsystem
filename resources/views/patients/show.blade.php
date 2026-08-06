@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Patient Profile</h4>
                <h6>Full details of {{ $patient['name'] }}</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('patients.edit', ['patient' => $patient['id']]) }}" class="btn btn-added">
                    <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" class="me-1">Edit Patient
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Personal Information -->
            <div class="col-lg-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="productdetails">
                            <ul class="product-bar">
                                <li>
                                    <h4>Patient ID</h4>
                                    <h6>{{ $patient['id'] }}</h6>
                                </li>
                                <li>
                                    <h4>Full Name</h4>
                                    <h6>{{ $patient['name'] }}</h6>
                                </li>
                                <li>
                                    <h4>Birthdate</h4>
                                    <h6>{{ $patient['birthdate'] }}</h6>
                                </li>
                                <li>
                                    <h4>Age / Sex</h4>
                                    <h6>{{ $patient['age'] }} yrs / {{ $patient['sex'] }}</h6>
                                </li>
                                <li>
                                    <h4>Civil Status</h4>
                                    <h6>{{ $patient['civil_status'] }}</h6>
                                </li>
                                <li>
                                    <h4>Blood Type</h4>
                                    <h6>{{ $patient['blood_type'] }}</h6>
                                </li>
                                <li>
                                    <h4>Contact Number</h4>
                                    <h6>{{ $patient['contact'] }}</h6>
                                </li>
                                <li>
                                    <h4>Address</h4>
                                    <h6>{{ $patient['address'] }}</h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Medical Background -->
            <div class="col-lg-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="productdetails">
                            <ul class="product-bar">
                                <li>
                                    <h4>Known Allergies</h4>
                                    <h6 class="text-danger">{{ $patient['allergies'] }}</h6>
                                </li>
                                <li>
                                    <h4>Existing Conditions</h4>
                                    <h6>{{ $patient['diseases'] }}</h6>
                                </li>
                                <li>
                                    <h4>Vaccination History</h4>
                                    <h6>{{ $patient['vaccination'] }}</h6>
                                </li>
                            </ul>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <a href="{{ route('consultations.create') }}" class="btn btn-submit w-100">
                                    <i class="fas fa-stethoscope me-1"></i> Add Consultation
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('print.medical-record', ['id' => $patient['id']]) }}" target="_blank" class="btn btn-cancel w-100">
                                    <i class="fas fa-print me-1"></i> Print Record
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Consultation History -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0">Consultation History</h4>
                    <a href="{{ route('consultations.create') }}" class="btn btn-added btn-sm">
                        <img src="{{ asset('assets/img/icons/plus.svg') }}" alt="img" class="me-1">New Consultation
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Chief Complaint</th>
                                <th>Vital Signs</th>
                                <th>Diagnosis</th>
                                <th>Treatment / Rx</th>
                                <th>Nurse</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patient['consultations'] as $consult)
                            <tr>
                                <td>{{ $consult['date'] }}</td>
                                <td>{{ $consult['complaint'] }}</td>
                                <td>BP: {{ $consult['bp'] }}, Temp: {{ $consult['temp'] }}, P: {{ $consult['pulse'] }}, RR: {{ $consult['resp'] }}</td>
                                <td>{{ $consult['diagnosis'] }}</td>
                                <td>{{ $consult['treatment'] }}<br><small>Rx: {{ $consult['prescription'] }}</small></td>
                                <td>{{ $consult['attending_nurse'] }}</td>
                                <td>
                                    <a class="me-3" href="{{ route('print.consultation', ['id' => $consult['id']]) }}" target="_blank">
                                        <img src="{{ asset('assets/img/icons/printer.svg') }}" alt="Print">
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
