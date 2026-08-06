@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Medical History</h4>
                <h6>Patient medical history archive</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th>Patient ID</th>
                                <th>Patient Name</th>
                                <th>Total Visits</th>
                                <th>Last Visit</th>
                                <th>Primary Condition</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>BAC-2026-001</td>
                                <td>Maria Clara Santos</td>
                                <td>5 visits</td>
                                <td>Feb 06, 2026</td>
                                <td>Essential Hypertension</td>
                                <td><span class="badges bg-lightgreen">Active</span></td>
                                <td>
                                    <a class="me-3" href="{{ route('patients.show', ['patient' => 'BAC-2026-001']) }}">
                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="View">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>BAC-2026-002</td>
                                <td>Juan Dela Cruz</td>
                                <td>8 visits</td>
                                <td>Feb 06, 2026</td>
                                <td>Type 2 Diabetes Mellitus</td>
                                <td><span class="badges bg-lightgreen">Active</span></td>
                                <td>
                                    <a class="me-3" href="{{ route('patients.show', ['patient' => 'BAC-2026-002']) }}">
                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="View">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>BAC-2026-004</td>
                                <td>Roberto Garcia Jr.</td>
                                <td>12 visits</td>
                                <td>Feb 04, 2026</td>
                                <td>Osteoarthritis, Hypertension</td>
                                <td><span class="badges bg-lightyellow">Referred</span></td>
                                <td>
                                    <a class="me-3" href="{{ route('patients.show', ['patient' => 'BAC-2026-004']) }}">
                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="View">
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
@endsection
