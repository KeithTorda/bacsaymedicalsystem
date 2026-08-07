@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Patient List</h4>
                <h6>Manage Registered Patients at Barangay Bacsay Health Center</h6>
            </div>
            <div class="page-btn">
                <button type="button" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addPatientModal">
                    <img src="{{ asset('assets/img/icons/plus.svg') }}" alt="img" class="me-1"> Register New Patient
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
                                <td><span class="badge bg-outline-primary fw-semibold">{{ $patient->patient_code }}</span></td>
                                <td class="fw-semibold text-dark">{{ $patient->name }}</td>
                                <td>{{ $patient->age }} yrs</td>
                                <td><span class="badge {{ $patient->sex == 'Female' ? 'bg-lightpink text-danger' : 'bg-lightgreen text-success' }}">{{ $patient->sex }}</span></td>
                                <td>{{ $patient->contact }}</td>
                                <td>{{ $patient->address }}</td>
                                <td>
                                    <a class="me-2" href="{{ route('patients.show', $patient->id) }}" data-bs-toggle="tooltip" title="View Medical Profile">
                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="View">
                                    </a>
                                    <a class="me-2 edit-patient-btn" href="javascript:void(0);" 
                                       data-bs-toggle="modal" data-bs-target="#editPatientModal{{ $patient->id }}" title="Edit Patient Info">
                                        <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="Edit">
                                    </a>
                                    <a class="me-2" href="{{ route('print.patient', $patient->id) }}" target="_blank" data-bs-toggle="tooltip" title="Print Slip">
                                        <img src="{{ asset('assets/img/icons/printer.svg') }}" alt="Print">
                                    </a>
                                    <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to remove this patient record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="border-0 bg-transparent p-0">
                                            <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="Delete">
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal for Editing Patient -->
                            <div class="modal fade" id="editPatientModal{{ $patient->id }}" tabindex="-1" aria-labelledby="editPatientModalLabel{{ $patient->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title fw-bold" id="editPatientModalLabel{{ $patient->id }}"><i class="fas fa-user-edit me-2 text-primary"></i>Edit Patient Information — {{ $patient->patient_code }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('patients.update', $patient->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body p-4">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-6 col-12 mb-3">
                                                        <label class="form-label fw-semibold">First Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="first_name" value="{{ $patient->first_name }}" required class="form-control">
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6 col-12 mb-3">
                                                        <label class="form-label fw-semibold">Last Name <span class="text-danger">*</span></label>
                                                        <input type="text" name="last_name" value="{{ $patient->last_name }}" required class="form-control">
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6 col-12 mb-3">
                                                        <label class="form-label fw-semibold">Middle Name</label>
                                                        <input type="text" name="middle_name" value="{{ $patient->middle_name }}" class="form-control">
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6 col-12 mb-3">
                                                        <label class="form-label fw-semibold">Birthdate <span class="text-danger">*</span></label>
                                                        <input type="date" name="birthdate" value="{{ $patient->birthdate }}" required class="form-control">
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6 col-12 mb-3">
                                                        <label class="form-label fw-semibold">Sex <span class="text-danger">*</span></label>
                                                        <select name="sex" class="form-select" required>
                                                            <option value="Female" {{ $patient->sex == 'Female' ? 'selected' : '' }}>Female</option>
                                                            <option value="Male" {{ $patient->sex == 'Male' ? 'selected' : '' }}>Male</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6 col-12 mb-3">
                                                        <label class="form-label fw-semibold">Civil Status</label>
                                                        <select name="civil_status" class="form-select">
                                                            <option value="Single" {{ $patient->civil_status == 'Single' ? 'selected' : '' }}>Single</option>
                                                            <option value="Married" {{ $patient->civil_status == 'Married' ? 'selected' : '' }}>Married</option>
                                                            <option value="Widowed" {{ $patient->civil_status == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                                            <option value="Separated" {{ $patient->civil_status == 'Separated' ? 'selected' : '' }}>Separated</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6 col-12 mb-3">
                                                        <label class="form-label fw-semibold">Blood Type</label>
                                                        <select name="blood_type" class="form-select">
                                                            @foreach(['O+', 'A+', 'B+', 'AB+', 'O-', 'A-', 'B-', 'AB-'] as $bt)
                                                                <option value="{{ $bt }}" {{ $patient->blood_type == $bt ? 'selected' : '' }}>{{ $bt }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6 col-12 mb-3">
                                                        <label class="form-label fw-semibold">Contact Number <span class="text-danger">*</span></label>
                                                        <input type="text" name="contact" value="{{ $patient->contact }}" required class="form-control">
                                                    </div>
                                                    <div class="col-lg-4 col-sm-6 col-12 mb-3">
                                                        <label class="form-label fw-semibold">Address / Purok <span class="text-danger">*</span></label>
                                                        <input type="text" name="address" value="{{ $patient->address }}" required class="form-control">
                                                    </div>
                                                    <div class="col-lg-4 col-12 mb-3">
                                                        <label class="form-label fw-semibold">Known Allergies</label>
                                                        <textarea name="allergies" rows="2" class="form-control">{{ $patient->allergies }}</textarea>
                                                    </div>
                                                    <div class="col-lg-4 col-12 mb-3">
                                                        <label class="form-label fw-semibold">Existing Conditions</label>
                                                        <textarea name="diseases" rows="2" class="form-control">{{ $patient->diseases }}</textarea>
                                                    </div>
                                                    <div class="col-lg-4 col-12 mb-3">
                                                        <label class="form-label fw-semibold">Vaccination History</label>
                                                        <textarea name="vaccination" rows="2" class="form-control">{{ $patient->vaccination }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update Patient Info</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Registering New Patient -->
<div class="modal fade" id="addPatientModal" tabindex="-1" aria-labelledby="addPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white fw-bold" id="addPatientModalLabel"><i class="fas fa-user-plus me-2"></i>Register New Patient</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('patients.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <label class="form-label fw-semibold">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" placeholder="Enter First Name" required class="form-control">
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" placeholder="Enter Last Name" required class="form-control">
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Middle Name</label>
                            <input type="text" name="middle_name" placeholder="Enter Middle Name" class="form-control">
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Birthdate <span class="text-danger">*</span></label>
                            <input type="date" name="birthdate" required class="form-control">
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Sex <span class="text-danger">*</span></label>
                            <select name="sex" class="form-select" required>
                                <option value="Female">Female</option>
                                <option value="Male">Male</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Civil Status</label>
                            <select name="civil_status" class="form-select">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Separated">Separated</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Blood Type</label>
                            <select name="blood_type" class="form-select">
                                <option value="O+">O+</option>
                                <option value="A+">A+</option>
                                <option value="B+">B+</option>
                                <option value="AB+">AB+</option>
                                <option value="O-">O-</option>
                                <option value="A-">A-</option>
                                <option value="B-">B-</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Contact Number <span class="text-danger">*</span></label>
                            <input type="text" name="contact" placeholder="09XXXXXXXXX" required class="form-control">
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Address / Purok <span class="text-danger">*</span></label>
                            <input type="text" name="address" value="Purok 1, Barangay Bacsay" required class="form-control">
                        </div>
                        <div class="col-lg-4 col-12 mb-3">
                            <label class="form-label fw-semibold">Known Allergies</label>
                            <textarea name="allergies" rows="2" placeholder="e.g. Penicillin, Shrimp" class="form-control"></textarea>
                        </div>
                        <div class="col-lg-4 col-12 mb-3">
                            <label class="form-label fw-semibold">Existing Conditions / Diseases</label>
                            <textarea name="diseases" rows="2" placeholder="e.g. Hypertension, Diabetes" class="form-control"></textarea>
                        </div>
                        <div class="col-lg-4 col-12 mb-3">
                            <label class="form-label fw-semibold">Vaccination History</label>
                            <textarea name="vaccination" rows="2" placeholder="e.g. COVID-19, Tetanus Toxoid" class="form-control"></textarea>
                        </div>
                        <div class="col-lg-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Emergency Contact Person</label>
                            <input type="text" name="emergency_contact_name" placeholder="Full Name" class="form-control">
                        </div>
                        <div class="col-lg-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Emergency Contact Phone</label>
                            <input type="text" name="emergency_contact_phone" placeholder="09XXXXXXXXX" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Patient Record</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if(session('open_add_modal'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var addModal = new bootstrap.Modal(document.getElementById('addPatientModal'));
        addModal.show();
    });
</script>
@endif
@endsection
