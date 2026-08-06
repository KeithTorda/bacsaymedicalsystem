@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Patient List</h4>
                <h6>Manage Registered Patients</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('patients.create') }}" class="btn btn-added">
                    <img src="{{ asset('assets/img/icons/plus.svg') }}" alt="img" class="me-1">Register New Patient
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
                                <th>Patient ID</th>
                                <th>Full Name</th>
                                <th>Age</th>
                                <th>Sex</th>
                                <th>Contact Number</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $patient)
                            <tr>
                                <td>{{ $patient['id'] }}</td>
                                <td>{{ $patient['name'] }}</td>
                                <td>{{ $patient['age'] }} yrs</td>
                                <td>{{ $patient['sex'] }}</td>
                                <td>{{ $patient['contact'] }}</td>
                                <td>{{ $patient['address'] }}</td>
                                <td>
                                    <a class="me-3" href="{{ route('patients.show', ['patient' => $patient['id']]) }}">
                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="View">
                                    </a>
                                    <a class="me-3" href="{{ route('patients.edit', ['patient' => $patient['id']]) }}">
                                        <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="Edit">
                                    </a>
                                    <a class="me-3" href="{{ route('print.patient', ['id' => $patient['id']]) }}" target="_blank">
                                        <img src="{{ asset('assets/img/icons/printer.svg') }}" alt="Print">
                                    </a>
                                    <a class="confirm-text" href="javascript:void(0);">
                                        <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="Delete">
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
