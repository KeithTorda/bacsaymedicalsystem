@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Consultation & Medical Records</h4>
                <h6>View and log patient consultation records at Barangay Bacsay Health Center</h6>
            </div>
            <div class="page-btn">
                <button type="button" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addConsultationModal">
                    <img src="{{ asset('assets/img/icons/plus.svg') }}" alt="img" class="me-1"> New Consultation
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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
                                <th>Attending Nurse</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $rec)
                            <tr>
                                <td><span class="badge bg-outline-info fw-semibold">{{ $rec->record_code }}</span></td>
                                <td class="fw-semibold text-dark">{{ $rec->patient ? $rec->patient->name : 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($rec->date)->format('M d, Y') }}</td>
                                <td>{{ Str::limit($rec->complaint, 35) }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $rec->vitals }}</span></td>
                                <td><span class="badge bg-lightgreen text-success">{{ $rec->diagnosis }}</span></td>
                                <td>{{ $rec->attending_nurse }}</td>
                                <td>
                                    @if($rec->patient)
                                        <a class="me-2" href="{{ route('patients.show', $rec->patient->id) }}" data-bs-toggle="tooltip" title="View Patient Profile">
                                            <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="View">
                                        </a>
                                    @endif
                                    <a class="me-2" href="{{ route('print.medical-record', $rec->id) }}" target="_blank" data-bs-toggle="tooltip" title="Print Consultation Slip">
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

<!-- Modal for Logging New Consultation -->
<div class="modal fade" id="addConsultationModal" tabindex="-1" aria-labelledby="addConsultationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white fw-bold" id="addConsultationModalLabel"><i class="fas fa-stethoscope me-2"></i>Log Patient Consultation & Vitals</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('consultations.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Select Patient <span class="text-danger">*</span></label>
                            <select name="patient_id" class="form-select" required>
                                <option value="">-- Choose Patient --</option>
                                @foreach($patients as $pt)
                                    <option value="{{ $pt->id }}">{{ $pt->patient_code }} - {{ $pt->name }} ({{ $pt->age }}/{{ substr($pt->sex, 0, 1) }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Visit Date <span class="text-danger">*</span></label>
                            <input type="date" name="visit_date" value="{{ date('Y-m-d') }}" required class="form-control">
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Attending Nurse / Officer <span class="text-danger">*</span></label>
                            <input type="text" name="attending_nurse" value="Nurse Teresa Alonzo, RN" required class="form-control">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label fw-semibold">Chief Complaint / Symptoms <span class="text-danger">*</span></label>
                            <textarea name="chief_complaint" rows="2" placeholder="Describe main complaints or symptoms reported by patient..." required class="form-control"></textarea>
                        </div>

                        <!-- Vital Signs Section -->
                        <div class="col-lg-12 mt-2 mb-2">
                            <h6 class="fw-bold text-primary border-bottom pb-2"><i class="fas fa-heartbeat me-2"></i>Vital Signs Recording</h6>
                        </div>
                        <div class="col-lg-2 col-sm-4 col-6 mb-3">
                            <label class="form-label fw-semibold">Blood Pressure <span class="text-danger">*</span></label>
                            <input type="text" name="bp" placeholder="e.g. 120/80" required class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-4 col-6 mb-3">
                            <label class="form-label fw-semibold">Temp (°C) <span class="text-danger">*</span></label>
                            <input type="text" name="temperature" placeholder="36.5" required class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-4 col-6 mb-3">
                            <label class="form-label fw-semibold">Pulse Rate (bpm)</label>
                            <input type="text" name="pulse_rate" placeholder="75" class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-4 col-6 mb-3">
                            <label class="form-label fw-semibold">Resp. Rate (cpm)</label>
                            <input type="text" name="respiratory_rate" placeholder="18" class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-4 col-6 mb-3">
                            <label class="form-label fw-semibold">Height (cm)</label>
                            <input type="text" name="height" placeholder="160" class="form-control">
                        </div>
                        <div class="col-lg-2 col-sm-4 col-6 mb-3">
                            <label class="form-label fw-semibold">Weight (kg)</label>
                            <input type="text" name="weight" placeholder="58" class="form-control">
                        </div>

                        <!-- Diagnosis & Treatment -->
                        <div class="col-lg-12 mt-2 mb-2">
                            <h6 class="fw-bold text-primary border-bottom pb-2"><i class="fas fa-user-md me-2"></i>Clinical Assessment & Treatment</h6>
                        </div>
                        <div class="col-lg-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Clinical Diagnosis <span class="text-danger">*</span></label>
                            <textarea name="diagnosis" rows="2" placeholder="Enter clinical diagnosis..." required class="form-control"></textarea>
                        </div>
                        <div class="col-lg-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Treatment Provided / Medical Advice</label>
                            <textarea name="treatment" rows="2" placeholder="Describe medical treatment provided..." class="form-control"></textarea>
                        </div>
                        <div class="col-lg-8 col-12 mb-3">
                            <label class="form-label fw-semibold">Prescription Notes (Rx)</label>
                            <textarea name="prescription" rows="2" placeholder="List prescribed medicines, dosage, instructions..." class="form-control"></textarea>
                        </div>
                        <div class="col-lg-4 col-12 mb-3">
                            <label class="form-label fw-semibold">Next Visit / Follow-up Date</label>
                            <input type="date" name="next_visit" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Consultation Record</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
