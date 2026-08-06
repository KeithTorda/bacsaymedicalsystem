@extends('print.layout')

@section('title', 'Prescription (Rx) — Barangay Bacsay Health Center')

@section('print-content')
    <div class="doc-title">Official Prescription (Rx) Form</div>

    <div class="section-title">I. Patient Information</div>
    <div class="info-grid">
        <div class="item"><span class="lbl">Patient ID:</span><span class="val">BAC-2026-001</span></div>
        <div class="item"><span class="lbl">Date Issued:</span><span class="val">February 05, 2026</span></div>
        <div class="item"><span class="lbl">Full Name:</span><span class="val">Maria Clara Santos</span></div>
        <div class="item"><span class="lbl">Age / Sex:</span><span class="val">34 yrs / Female</span></div>
        <div class="item"><span class="lbl">Address:</span><span class="val">Purok 1, Barangay Bacsay</span></div>
        <div class="item"><span class="lbl">Known Allergies:</span><span class="val" style="color: red; font-weight: 700;">Penicillin, Sulfa Drugs</span></div>
    </div>

    <div class="section-title">II. Diagnosis</div>
    <div style="border: 1px solid #aaa; padding: 8px; margin-bottom: 14px; font-size: 11pt; font-weight: 600;">
        Essential Hypertension, Stage 1
    </div>

    <div class="section-title">III. Prescribed Medicines</div>
    <div style="font-size: 20pt; font-weight: 700; text-align: center; margin: 10px 0; color: #333;">℞</div>
    <table class="print-table">
        <thead>
            <tr>
                <th style="width:5%;">#</th>
                <th style="width:22%;">Medicine Name</th>
                <th style="width:12%;">Dosage</th>
                <th style="width:22%;">Frequency</th>
                <th style="width:12%;">Duration</th>
                <th style="width:27%;">Instructions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td style="font-weight:600;">Amlodipine</td>
                <td>5mg</td>
                <td>Once daily in the morning</td>
                <td>30 days</td>
                <td>Take after breakfast with water</td>
            </tr>
            <tr>
                <td>2</td>
                <td style="font-weight:600;">Paracetamol</td>
                <td>500mg</td>
                <td>Every 6 hours as needed for pain</td>
                <td>5 days</td>
                <td>For headache or fever only</td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">IV. Important Notes</div>
    <div style="border: 1px solid #aaa; padding: 8px; margin-bottom: 14px; font-size: 10pt;">
        • Do NOT take any Penicillin-based or Sulfa Drug medications due to documented allergy.<br>
        • Follow low-sodium diet as advised. Reduce salt and processed food intake.<br>
        • Return for follow-up visit on <strong>February 19, 2026</strong> for BP reassessment.
    </div>

    <div class="sig-block">
        <div class="sig-col">
            <div class="sig-line">Patient Signature</div>
        </div>
        <div class="sig-col">
            <div class="sig-line">Nurse Teresa Alonzo, RN</div>
            <div class="sig-sub">Prescribing Health Officer</div>
        </div>
    </div>
@endsection
