@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Register New Patient</h4>
                <h6>Add patient to Barangay Bacsay Health Center records</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('patients.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Patient ID</label>
                                <input type="text" name="patient_id" value="BAC-2026-006" readonly class="form-control bg-light">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" placeholder="Enter Last Name" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" placeholder="Enter First Name" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input type="text" name="middle_name" placeholder="Enter Middle Name" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Birthdate</label>
                                <input type="date" name="birthdate" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Sex</label>
                                <select name="sex" class="select" required>
                                    <option>Female</option>
                                    <option>Male</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Civil Status</label>
                                <select name="civil_status" class="select">
                                    <option>Single</option>
                                    <option>Married</option>
                                    <option>Widowed</option>
                                    <option>Separated</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Blood Type</label>
                                <select name="blood_type" class="select">
                                    <option>O+</option>
                                    <option>A+</option>
                                    <option>B+</option>
                                    <option>AB+</option>
                                    <option>O-</option>
                                    <option>A-</option>
                                    <option>B-</option>
                                    <option>AB-</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" name="contact" placeholder="09XXXXXXXXX" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" value="Purok 1, Barangay Bacsay" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Known Allergies</label>
                                <textarea name="allergies" rows="3" placeholder="e.g. Penicillin, Shrimp" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Existing Conditions / Diseases</label>
                                <textarea name="diseases" rows="3" placeholder="e.g. Hypertension, Diabetes" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Vaccination History</label>
                                <textarea name="vaccination" rows="3" placeholder="e.g. COVID-19, Tetanus Toxoid" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <a href="{{ route('patients.index') }}" class="btn btn-cancel me-2">Cancel</a>
                            <button type="submit" class="btn btn-submit">Save Patient</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
