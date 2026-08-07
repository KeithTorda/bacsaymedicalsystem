@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Vital Signs Monitoring Records</h4>
                <h6>Barangay Bacsay Health Center Patient Vital Signs Log</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datanew table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Patient Name</th>
                                <th>Blood Pressure</th>
                                <th>Vital Signs Summary</th>
                                <th>Diagnosis</th>
                                <th>Attending Nurse</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $rec)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($rec->date)->format('M d, Y') }}</td>
                                <td class="fw-semibold text-dark">{{ $rec->patient ? $rec->patient->name : 'N/A' }}</td>
                                <td><span class="badge bg-warning-subtle text-warning fw-bold">{{ $rec->vitals }}</span></td>
                                <td>{{ $rec->vitals }}</td>
                                <td><span class="badge bg-lightgreen text-success">{{ $rec->diagnosis }}</span></td>
                                <td>{{ $rec->attending_nurse }}</td>
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
