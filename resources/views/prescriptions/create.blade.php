@extends('layouts.master')

@section('content')
<div class="content">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-title">
            <h4>Issue Patient Prescription (Rx)</h4>
            <h6>Barangay Bacsay Health Center Multi-Medicine Issuer</h6>
        </div>
        <div class="page-btn">
            <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Prescriptions
            </a>
        </div>
    </div>

    <!-- Multi-Medicine Form Card -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('prescriptions.store') }}" method="POST">
                @csrf
                <div class="row">
                    <h5 class="fw-bold text-primary mb-3"><i class="fas fa-user-circle me-2"></i>Patient & Prescription Header</h5>

                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Patient <span class="text-danger">*</span></label>
                            <select name="patient_id" class="form-select" required>
                                <option value="BAC-2026-001">BAC-2026-001 - Maria Clara Santos</option>
                                <option value="BAC-2026-002">BAC-2026-002 - Juan Dela Cruz</option>
                                <option value="BAC-2026-003">BAC-2026-003 - Ana Marie Ramos</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Date Issued <span class="text-danger">*</span></label>
                            <input type="date" name="date" value="2026-02-06" required class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Attending Nurse / Officer <span class="text-danger">*</span></label>
                            <input type="text" name="nurse" value="Nurse Teresa Alonzo, RN" required class="form-control bg-light">
                        </div>
                    </div>

                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-primary m-0"><i class="fas fa-pills me-2"></i>Prescribed Medicines List</h5>
                        <button type="button" id="add_medicine_btn" class="btn btn-sm btn-success">
                            <i class="fas fa-plus-circle me-1"></i> Add Another Medicine
                        </button>
                    </div>

                    <!-- Dynamic Medicines Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered" id="medicine_table">
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
                            <tbody id="medicine_rows">
                                <tr>
                                    <td><input type="text" name="medicine[]" value="Amlodipine" placeholder="e.g. Amlodipine" required class="form-control"></td>
                                    <td><input type="text" name="dosage[]" value="5mg" placeholder="e.g. 5mg" required class="form-control"></td>
                                    <td><input type="text" name="frequency[]" value="Once daily in the morning" placeholder="e.g. 1 tab 3x a day" required class="form-control"></td>
                                    <td><input type="text" name="duration[]" value="30 days" placeholder="e.g. 7 days" required class="form-control"></td>
                                    <td><input type="text" name="instructions[]" value="Take after breakfast with water" placeholder="Special instructions..." class="form-control"></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-xs btn-outline-danger remove-row-btn"><i class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="medicine[]" value="Paracetamol" placeholder="e.g. Paracetamol" required class="form-control"></td>
                                    <td><input type="text" name="dosage[]" value="500mg" placeholder="e.g. 500mg" required class="form-control"></td>
                                    <td><input type="text" name="frequency[]" value="Every 6 hours as needed for pain" placeholder="e.g. 1 tab 3x a day" required class="form-control"></td>
                                    <td><input type="text" name="duration[]" value="5 days" placeholder="e.g. 7 days" required class="form-control"></td>
                                    <td><input type="text" name="instructions[]" value="For headache or fever only" placeholder="Special instructions..." class="form-control"></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-xs btn-outline-danger remove-row-btn"><i class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12 mt-4 text-end">
                        <a href="{{ route('prescriptions.index') }}" class="btn btn-cancel me-2">Cancel</a>
                        <button type="submit" class="btn btn-submit">
                            <i class="fas fa-save me-1"></i> Save & Issue Prescription
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var addBtn = document.getElementById("add_medicine_btn");
        var rowsContainer = document.getElementById("medicine_rows");

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
                        <button type="button" class="btn btn-xs btn-outline-danger remove-row-btn"><i class="fas fa-times"></i></button>
                    </td>
                `;
                rowsContainer.appendChild(newRow);
            });

            rowsContainer.addEventListener("click", function(e) {
                if (e.target.closest(".remove-row-btn")) {
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
