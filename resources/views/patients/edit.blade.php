@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Edit Patient Record</h4>
                <h6>Update patient information</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('patients.update', ['patient' => $patient['id']]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Patient ID</label>
                                <input type="text" value="{{ $patient['id'] }}" readonly class="form-control bg-light">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="name" value="{{ $patient['name'] }}" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Birthdate</label>
                                <input type="date" name="birthdate" value="{{ $patient['birthdate_raw'] ?? '1992-03-15' }}" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Sex</label>
                                <select name="sex" class="select" required>
                                    <option {{ $patient['sex'] === 'Female' ? 'selected' : '' }}>Female</option>
                                    <option {{ $patient['sex'] === 'Male' ? 'selected' : '' }}>Male</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Civil Status</label>
                                <select name="civil_status" class="select">
                                    @foreach(['Single','Married','Widowed','Separated'] as $cs)
                                    <option {{ $patient['civil_status'] === $cs ? 'selected' : '' }}>{{ $cs }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Blood Type</label>
                                <select name="blood_type" class="select">
                                    @foreach(['O+','A+','B+','AB+','O-','A-','B-','AB-'] as $bt)
                                    <option {{ $patient['blood_type'] === $bt ? 'selected' : '' }}>{{ $bt }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" name="contact" value="{{ $patient['contact'] }}" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" value="{{ $patient['address'] }}" required class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Known Allergies</label>
                                <textarea name="allergies" rows="3" class="form-control">{{ $patient['allergies'] }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Existing Conditions</label>
                                <textarea name="diseases" rows="3" class="form-control">{{ $patient['diseases'] }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Vaccination History</label>
                                <textarea name="vaccination" rows="3" class="form-control">{{ $patient['vaccination'] }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <a href="{{ route('patients.show', ['patient' => $patient['id']]) }}" class="btn btn-cancel me-2">Cancel</a>
                            <button type="submit" class="btn btn-submit">Update Patient</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
