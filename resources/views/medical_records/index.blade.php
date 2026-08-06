@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Consultation Records</h4>
                <h6>View all patient consultation records</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('consultations.create') }}" class="btn btn-added">
                    <img src="{{ asset('assets/img/icons/plus.svg') }}" alt="img" class="me-1">New Consultation
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            <a class="btn btn-filter" id="filter_search">
                                <img src="{{ asset('assets/img/icons/filter.svg') }}" alt="img">
                                <span><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img"></span>
                            </a>
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset"><img src="{{ asset('assets/img/icons/search-white.svg') }}" alt="img"></a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li><a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="{{ asset('assets/img/icons/pdf.svg') }}" alt="img"></a></li>
                            <li><a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="{{ asset('assets/img/icons/excel.svg') }}" alt="img"></a></li>
                            <li><a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="{{ asset('assets/img/icons/printer.svg') }}" alt="img"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th>Record ID</th>
                                <th>Patient Name</th>
                                <th>Date</th>
                                <th>Chief Complaint</th>
                                <th>Vital Signs</th>
                                <th>Diagnosis</th>
                                <th>Nurse</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $rec)
                            <tr>
                                <td>{{ $rec['id'] }}</td>
                                <td>{{ $rec['patient_name'] }}</td>
                                <td>{{ $rec['date'] }}</td>
                                <td>{{ $rec['complaint'] }}</td>
                                <td>{{ $rec['vitals'] }}</td>
                                <td>{{ $rec['diagnosis'] }}</td>
                                <td>{{ $rec['attending_nurse'] }}</td>
                                <td>
                                    <a class="me-3" href="{{ route('patients.show', ['patient' => $rec['patient_id']]) }}">
                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="View">
                                    </a>
                                    <a class="me-3" href="{{ route('print.consultation', ['id' => $rec['id']]) }}" target="_blank">
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
