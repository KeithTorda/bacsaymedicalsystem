@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>New Consultation</h4>
                <h6>Encode patient consultation and vital signs</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('consultations.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Patient</label>
                                <select name="patient_id" class="select" required>
                                    <option value="BAC-2026-001">BAC-2026-001 - Maria Clara Santos (34/F)</option>
                                    <option value="BAC-2026-002">BAC-2026-002 - Juan Dela Cruz (40/M)</option>
                                    <option value="BAC-2026-003">BAC-2026-003 - Ana Marie Ramos (25/F)</option>
                                    <option value="BAC-2026-004">BAC-2026-004 - Roberto Garcia Jr. (67/M)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Visit Date</label>
                                <input type="date" name="visit_date" value="2026-02-06" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Attending Nurse</label>
                                <input type="text" name="attending_nurse" value="Nurse Teresa Alonzo, RN" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Chief Complaint</label>
                                <textarea name="chief_complaint" rows="2" placeholder="Describe main symptoms..." required class="form-control"></textarea>
                            </div>
                        </div>

                        <!-- Vital Signs -->
                        <div class="col-lg-12 mb-2"><h5 class="fw-semibold">Vital Signs</h5></div>
                        <div class="col-lg-2 col-sm-4 col-6">
                            <div class="form-group">
                                <label>Blood Pressure</label>
                                <input type="text" name="bp" placeholder="120/80" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-4 col-6">
                            <div class="form-group">
                                <label>Temperature (°C)</label>
                                <input type="text" name="temperature" placeholder="36.5" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-4 col-6">
                            <div class="form-group">
                                <label>Pulse Rate (bpm)</label>
                                <input type="text" name="pulse_rate" placeholder="75" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-4 col-6">
                            <div class="form-group">
                                <label>Resp. Rate (cpm)</label>
                                <input type="text" name="respiratory_rate" placeholder="18" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-4 col-6">
                            <div class="form-group">
                                <label>Height (cm)</label>
                                <input type="text" name="height" placeholder="160" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-4 col-6">
                            <div class="form-group">
                                <label>Weight (kg)</label>
                                <input type="text" name="weight" placeholder="58" class="form-control">
                            </div>
                        </div>

                        <!-- Diagnosis & Treatment -->
                        <div class="col-lg-12 mb-2"><h5 class="fw-semibold">Diagnosis & Treatment</h5></div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Clinical Diagnosis</label>
                                <textarea name="diagnosis" rows="3" placeholder="Enter diagnosis..." required class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Treatment Provided</label>
                                <textarea name="treatment" rows="3" placeholder="Describe treatment and advice..." class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-12">
                            <div class="form-group">
                                <label>Prescription (Rx)</label>
                                <textarea name="prescription" rows="2" placeholder="List medicines, dosage, frequency..." class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label>Next Visit / Follow-up</label>
                                <input type="date" name="next_visit" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <a href="{{ route('patients.index') }}" class="btn btn-cancel me-2">Cancel</a>
                            <button type="submit" class="btn btn-submit">Save Consultation</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
