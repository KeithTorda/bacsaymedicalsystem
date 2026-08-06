@extends('print.layout')

@section('title', 'Consultation Record — Barangay Bacsay Health Center')

@section('print-content')
    <div class="doc-title">Consultation Record</div>

    <div class="section-title">I. Patient & Visit Details</div>
    <div class="info-grid">
        <div class="item"><span class="lbl">Patient ID:</span><span class="val">BAC-2026-001</span></div>
        <div class="item"><span class="lbl">Visit Date:</span><span class="val">February 05, 2026</span></div>
        <div class="item"><span class="lbl">Full Name:</span><span class="val">Maria Clara Santos</span></div>
        <div class="item"><span class="lbl">Age / Sex:</span><span class="val">34 yrs / Female</span></div>
        <div class="item"><span class="lbl">Address:</span><span class="val">Purok 1, Barangay Bacsay</span></div>
        <div class="item"><span class="lbl">Attending Nurse:</span><span class="val">Nurse Teresa Alonzo, RN</span></div>
    </div>

    <div class="section-title">II. Chief Complaint</div>
    <div style="border: 1px solid #aaa; padding: 8px; margin-bottom: 14px; font-size: 10pt;">
        Patient complains of persistent headache for the past 3 days and elevated blood pressure readings at home.
    </div>

    <div class="section-title">III. Vital Signs</div>
    <table class="print-table">
        <thead>
            <tr>
                <th>Blood Pressure</th>
                <th>Temperature</th>
                <th>Pulse Rate</th>
                <th>Respiratory Rate</th>
                <th>Height</th>
                <th>Weight</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-weight:700;">140/90 mmHg</td>
                <td>36.5 °C</td>
                <td>80 bpm</td>
                <td>18 cpm</td>
                <td>160 cm</td>
                <td>58 kg</td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">IV. Diagnosis</div>
    <div style="border: 1px solid #aaa; padding: 8px; margin-bottom: 14px; font-size: 10pt; font-weight: 600;">
        Essential Hypertension, Stage 1 (ICD-10: I10)
    </div>

    <div class="section-title">V. Treatment & Prescriptions</div>
    <div style="border: 1px solid #aaa; padding: 8px; margin-bottom: 14px; font-size: 10pt;">
        <strong>Treatment:</strong> Lifestyle modification counseling — reduce sodium intake, increase physical activity, avoid stress.<br>
        <strong>Rx:</strong> Amlodipine 5mg — 1 tablet once daily in the morning after breakfast × 30 days<br>
        <strong>Rx:</strong> Paracetamol 500mg — 1 tablet every 6 hours as needed for headache × 5 days
    </div>

    <div class="section-title">VI. Follow-Up</div>
    <div class="info-grid">
        <div class="item"><span class="lbl">Next Visit Date:</span><span class="val">February 19, 2026</span></div>
        <div class="item"><span class="lbl">Purpose:</span><span class="val">Blood pressure re-assessment and medication review</span></div>
    </div>

    <div class="sig-block">
        <div class="sig-col">
            <div class="sig-line">Patient Signature</div>
        </div>
        <div class="sig-col">
            <div class="sig-line">Nurse Teresa Alonzo, RN</div>
            <div class="sig-sub">Attending Health Officer</div>
        </div>
    </div>
@endsection
