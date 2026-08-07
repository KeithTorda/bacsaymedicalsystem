@extends('layouts.master')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Patient Appointments Schedule</h4>
            <h6>Barangay Bacsay Health Center Follow-Up & Appointment Calendar</h6>
        </div>
        <div class="page-btn">
            <button type="button" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addAppointmentModal">
                <i class="fas fa-calendar-plus me-1"></i> Schedule New Appointment
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
            <div class="table-responsive">
                <table class="table datanew table-hover">
                    <thead>
                        <tr>
                            <th>Patient ID</th>
                            <th>Patient Name</th>
                            <th>Appointment Code</th>
                            <th>Follow-Up Date & Time</th>
                            <th>Purpose</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $apt)
                        <tr>
                            <td><span class="badge bg-primary-subtle text-primary fw-bold">{{ $apt->patient ? $apt->patient->patient_code : 'N/A' }}</span></td>
                            <td class="fw-semibold text-dark">{{ $apt->patient ? $apt->patient->name : 'N/A' }}</td>
                            <td><span class="badge bg-outline-secondary">{{ $apt->appointment_code }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($apt->date)->format('M d, Y') }} at {{ $apt->time }}</td>
                            <td>{{ $apt->purpose }}</td>
                            <td>
                                @if($apt->status == 'Completed')
                                    <span class="badge bg-success-subtle text-success fw-bold">Completed</span>
                                @elseif($apt->status == 'Cancelled')
                                    <span class="badge bg-danger-subtle text-danger fw-bold">Cancelled</span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning fw-bold">Scheduled</span>
                                @endif
                            </td>
                            <td>
                                @if($apt->status == 'Scheduled')
                                    <form action="{{ route('appointments.updateStatus', $apt->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="Completed">
                                        <button type="submit" class="btn btn-xs btn-outline-success">Mark Completed</button>
                                    </form>
                                @else
                                    <span class="text-muted fs-12">No Action</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Scheduling New Appointment -->
<div class="modal fade" id="addAppointmentModal" tabindex="-1" aria-labelledby="addAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white fw-bold" id="addAppointmentModalLabel"><i class="fas fa-calendar-plus me-2"></i>Schedule Patient Appointment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-lg-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Patient <span class="text-danger">*</span></label>
                            <select name="patient_id" class="form-select" required>
                                <option value="">-- Choose Patient --</option>
                                @foreach($patients as $pt)
                                    <option value="{{ $pt->id }}">{{ $pt->patient_code }} - {{ $pt->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Appointment Date <span class="text-danger">*</span></label>
                            <input type="date" name="date" value="{{ date('Y-m-d', strtotime('+3 days')) }}" required class="form-control">
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Time Slot</label>
                            <select name="time" class="form-select">
                                <option value="08:00 AM">08:00 AM</option>
                                <option value="09:00 AM" selected>09:00 AM</option>
                                <option value="10:00 AM">10:00 AM</option>
                                <option value="11:00 AM">11:00 AM</option>
                                <option value="01:00 PM">01:00 PM</option>
                                <option value="02:00 PM">02:00 PM</option>
                                <option value="03:00 PM">03:00 PM</option>
                            </select>
                        </div>
                        <div class="col-lg-12 col-12 mb-3">
                            <label class="form-label fw-semibold">Purpose / Reason for Visit <span class="text-danger">*</span></label>
                            <textarea name="purpose" rows="3" placeholder="e.g. Blood pressure monitoring, Fasting blood sugar re-assessment" required class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Save Appointment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
