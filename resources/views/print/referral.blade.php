@extends('print.layout')

@section('title', 'Referral Form — Barangay Bacsay Health Center')

@section('print-content')
    <div class="doc-title">Patient Referral Form</div>

    <div class="section-title">I. Referring Facility</div>
    <div class="info-grid">
        <div class="item"><span class="lbl">Facility Name:</span><span class="val">Barangay Bacsay Health Center</span></div>
        <div class="item"><span class="lbl">Date of Referral:</span><span class="val">February 06, 2026</span></div>
        <div class="item"><span class="lbl">Address:</span><span class="val">Brgy. Bacsay, San Esteban, Ilocos Sur</span></div>
        <div class="item"><span class="lbl">Contact Number:</span><span class="val">(077) 000-0000</span></div>
        <div class="item"><span class="lbl">Referring Officer:</span><span class="val">Nurse Teresa Alonzo, RN</span></div>
        <div class="item"><span class="lbl">Position:</span><span class="val">Barangay Health Officer</span></div>
    </div>

    <div class="section-title">II. Patient Information</div>
    <div class="info-grid">
        <div class="item"><span class="lbl">Patient ID:</span><span class="val">BAC-2026-004</span></div>
        <div class="item"><span class="lbl">Full Name:</span><span class="val">Roberto Garcia Jr.</span></div>
        <div class="item"><span class="lbl">Age / Sex:</span><span class="val">67 yrs / Male</span></div>
        <div class="item"><span class="lbl">Blood Type:</span><span class="val">A+</span></div>
        <div class="item"><span class="lbl">Address:</span><span class="val">Purok 4, Barangay Bacsay</span></div>
        <div class="item"><span class="lbl">Contact:</span><span class="val">0928-321-9876</span></div>
        <div class="item"><span class="lbl">Known Allergies:</span><span class="val" style="color: red; font-weight: 700;">NSAIDs (Mefenamic Acid)</span></div>
        <div class="item"><span class="lbl">Pre-conditions:</span><span class="val">Osteoarthritis, Hypertension Stage 2</span></div>
    </div>

    <div class="section-title">III. Reason for Referral</div>
    <div style="border: 1px solid #aaa; padding: 8px; margin-bottom: 14px; font-size: 10pt;">
        Patient presents with persistent bilateral knee pain, limited mobility, and swelling not controlled by current oral medications.
        Blood pressure remains elevated at 160/100 mmHg despite adherence to Amlodipine 10mg OD.
        Requires specialist orthopedic evaluation for possible intra-articular injection and cardiology review for resistant hypertension.
    </div>

    <div class="section-title">IV. Current Vital Signs at Time of Referral</div>
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
                <td style="font-weight:700; color: red;">160/100 mmHg</td>
                <td>36.6 °C</td>
                <td>88 bpm</td>
                <td>20 cpm</td>
                <td>168 cm</td>
                <td>75 kg</td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">V. Current Medications</div>
    <div style="border: 1px solid #aaa; padding: 8px; margin-bottom: 14px; font-size: 10pt;">
        1. Amlodipine 10mg — 1 tablet once daily<br>
        2. Paracetamol 500mg — 1 tablet every 8 hours for pain management<br>
        3. Glucosamine Sulfate 500mg — 1 capsule twice daily
    </div>

    <div class="section-title">VI. Referred To</div>
    <div class="info-grid">
        <div class="item"><span class="lbl">Hospital / Clinic:</span><span class="val">Gabriela Silang General Hospital</span></div>
        <div class="item"><span class="lbl">Department:</span><span class="val">Orthopedics / Internal Medicine — Cardiology</span></div>
        <div class="item"><span class="lbl">Address:</span><span class="val">San Fernando, La Union</span></div>
    </div>

    <div class="sig-block">
        <div class="sig-col">
            <div class="sig-line">Patient / Guardian Signature</div>
        </div>
        <div class="sig-col">
            <div class="sig-line">Nurse Teresa Alonzo, RN</div>
            <div class="sig-sub">Referring Barangay Health Officer</div>
        </div>
    </div>
@endsection
