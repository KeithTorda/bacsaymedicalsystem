@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-title">
            <h4>Prescription (Rx) Directory</h4>
            <h6>Barangay Bacsay Health Center Prescribed Medications</h6>
        </div>
        <div class="page-btn">
            <button type="button" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addPrescriptionModal">
                <i class="fas fa-pills me-1"></i> Issue New Prescription
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Prescriptions Card -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datanew table-hover">
                    <thead>
                        <tr>
                            <th>Rx ID</th>
                            <th>Patient Name</th>
                            <th>Date Issued</th>
                            <th>Items Count</th>
                            <th>Medicines Summary</th>
                            <th>Attending Nurse</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prescriptions as $rx)
                        <tr>
                            <td><span class="badge bg-danger-subtle text-danger fw-bold">{{ $rx->prescription_code }}</span></td>
                            <td class="fw-semibold text-dark">{{ $rx->patient ? $rx->patient->name : 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($rx->date)->format('M d, Y') }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $rx->items->count() }} meds</span></td>
                            <td>{{ $rx->items->pluck('medicine_name')->join(', ') }}</td>
                            <td>{{ $rx->attending_nurse }}</td>
                            <td class="text-center">
                                <a href="{{ route('print.prescription', $rx->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-print me-1"></i> Print Rx Form
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

<!-- Modal for Issuing New Prescription -->
<div class="modal fade" id="addPrescriptionModal" tabindex="-1" aria-labelledby="addPrescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title text-white fw-bold" id="addPrescriptionModalLabel"><i class="fas fa-pills me-2"></i>Issue Patient Prescription (Rx)</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('prescriptions.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Patient <span class="text-danger">*</span></label>
                            <select name="patient_id" class="form-select" required>
                                <option value="">-- Choose Patient --</option>
                                @foreach($patients as $pt)
                                    <option value="{{ $pt->id }}">{{ $pt->patient_code }} - {{ $pt->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Date Issued <span class="text-danger">*</span></label>
                            <input type="date" name="date" value="{{ date('Y-m-d') }}" required class="form-control">
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12 mb-3">
                            <label class="form-label fw-semibold">Attending Nurse / Officer <span class="text-danger">*</span></label>
                            <input type="text" name="nurse" value="Nurse Teresa Alonzo, RN" required class="form-control">
                        </div>

                        <hr class="my-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold text-primary m-0"><i class="fas fa-list-ol me-2"></i>Prescribed Medicines List</h6>
                            <button type="button" id="modal_add_medicine_btn" class="btn btn-sm btn-success">
                                <i class="fas fa-plus-circle me-1"></i> Add Another Medicine
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Medicine Name</th>
                                        <th>Dosage</th>
                                        <th>Frequency</th>
                                        <th>Duration</th>
                                        <th>Instructions</th>
                                        <th style="width: 50px;">Remove</th>
                                    </tr>
                                </thead>
                                <tbody id="modal_medicine_rows">
                                    <tr>
                                        <td><input type="text" name="medicine[]" placeholder="e.g. Amlodipine" required class="form-control"></td>
                                        <td><input type="text" name="dosage[]" placeholder="e.g. 5mg" required class="form-control"></td>
                                        <td><input type="text" name="frequency[]" placeholder="e.g. Once daily" required class="form-control"></td>
                                        <td><input type="text" name="duration[]" placeholder="e.g. 30 days" required class="form-control"></td>
                                        <td><input type="text" name="instructions[]" placeholder="Special instructions..." class="form-control"></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-xs btn-outline-danger remove-modal-row-btn"><i class="fas fa-times"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-paper-plane me-1"></i> Save & Issue Prescription</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var addBtn = document.getElementById("modal_add_medicine_btn");
        var rowsContainer = document.getElementById("modal_medicine_rows");

        if (addBtn && rowsContainer) {
            addBtn.addEventListener("click", function() {
                var newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td><input type="text" name="medicine[]" placeholder="Medicine Name" required class="form-control"></td>
                    <td><input type="text" name="dosage[]" placeholder="Dosage" required class="form-control"></td>
                    <td><input type="text" name="frequency[]" placeholder="Frequency" required class="form-control"></td>
                    <td><input type="text" name="duration[]" placeholder="Duration" required class="form-control"></td>
                    <td><input type="text" name="instructions[]" placeholder="Instructions" class="form-control"></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-xs btn-outline-danger remove-modal-row-btn"><i class="fas fa-times"></i></button>
                    </td>
                `;
                rowsContainer.appendChild(newRow);
            });

            rowsContainer.addEventListener("click", function(e) {
                if (e.target.closest(".remove-modal-row-btn")) {
                    var row = e.target.closest("tr");
                    if (rowsContainer.rows.length > 1) {
                        row.remove();
                    } else {
                        alert("Prescription must contain at least one medicine!");
                    }
                }
            });
        }
    });
</script>
@endsection
