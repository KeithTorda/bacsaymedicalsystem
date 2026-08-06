@extends('print.layout')

@section('title', 'Medical Record — Barangay Bacsay Health Center')

@section('print-content')
    <div class="doc-title">Official Medical Record</div>

    <div class="section-title">I. Patient Identification</div>
    <div class="info-grid">
        <div class="item"><span class="lbl">Patient ID:</span><span class="val">BAC-2026-001</span></div>
        <div class="item"><span class="lbl">Full Name:</span><span class="val">Maria Clara Santos</span></div>
        <div class="item"><span class="lbl">Age / Sex:</span><span class="val">34 years old / Female</span></div>
        <div class="item"><span class="lbl">Blood Type:</span><span class="val">O+</span></div>
        <div class="item"><span class="lbl">Address:</span><span class="val">Purok 1, Barangay Bacsay</span></div>
        <div class="item"><span class="lbl">Contact:</span><span class="val">0917-123-4567</span></div>
        <div class="item"><span class="lbl">Known Allergies:</span><span class="val" style="color: red; font-weight: 700;">Penicillin, Sulfa Drugs</span></div>
        <div class="item"><span class="lbl">Pre-conditions:</span><span class="val">Hypertension Stage 1</span></div>
    </div>

    <div class="section-title">II. Consultation & Visit History</div>
    <table class="print-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Chief Complaint</th>
                <th>BP</th>
                <th>Temp</th>
                <th>Pulse</th>
                <th>RR</th>
                <th>Diagnosis</th>
                <th>Treatment / Rx</th>
                <th>Nurse</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Feb 05, 2026</td>
                <td>Elevated BP, Headache</td>
                <td>140/90</td>
                <td>36.5°C</td>
                <td>80</td>
                <td>18</td>
                <td>Hypertension Stage 1</td>
                <td>Amlodipine 5mg OD, Low-salt diet</td>
                <td>N. Alonzo, RN</td>
            </tr>
            <tr>
                <td>Jan 22, 2026</td>
                <td>Persistent Headache</td>
                <td>135/85</td>
                <td>36.8°C</td>
                <td>78</td>
                <td>19</td>
                <td>Tension-type Headache</td>
                <td>Paracetamol 500mg PRN, Advice rest</td>
                <td>N. Alonzo, RN</td>
            </tr>
            <tr>
                <td>Dec 10, 2025</td>
                <td>Routine Blood Pressure Check</td>
                <td>130/82</td>
                <td>36.4°C</td>
                <td>76</td>
                <td>18</td>
                <td>Controlled Hypertension</td>
                <td>Continue current medications</td>
                <td>N. Alonzo, RN</td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">III. Remarks</div>
    <div style="border: 1px solid #aaa; min-height: 60px; padding: 8px; margin-bottom: 16px; font-size: 10pt;">
        Patient is advised to maintain regular follow-up visits every 2 weeks for blood pressure monitoring. Current medication regimen is effective.
    </div>

    <div class="sig-block">
        <div class="sig-col">
            <div class="sig-line">Patient Signature</div>
        </div>
        <div class="sig-col">
            <div class="sig-line">Nurse Teresa Alonzo, RN</div>
            <div class="sig-sub">Barangay Health Officer</div>
        </div>
    </div>
@endsection
