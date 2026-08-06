@extends('print.layout')

@section('title', 'Patient Information Sheet — Barangay Bacsay Health Center')

@section('print-content')
    <div class="doc-title">Patient Information Sheet</div>

    <div class="section-title">I. Personal Information</div>
    <div class="info-grid">
        <div class="item"><span class="lbl">Patient ID:</span><span class="val">BAC-2026-001</span></div>
        <div class="item"><span class="lbl">Date Registered:</span><span class="val">January 10, 2026</span></div>
        <div class="item"><span class="lbl">Full Name:</span><span class="val">Maria Clara Santos</span></div>
        <div class="item"><span class="lbl">Sex:</span><span class="val">Female</span></div>
        <div class="item"><span class="lbl">Birthdate:</span><span class="val">March 15, 1992</span></div>
        <div class="item"><span class="lbl">Age:</span><span class="val">34 years old</span></div>
        <div class="item"><span class="lbl">Civil Status:</span><span class="val">Married</span></div>
        <div class="item"><span class="lbl">Blood Type:</span><span class="val">O+</span></div>
        <div class="item"><span class="lbl">Contact Number:</span><span class="val">0917-123-4567</span></div>
        <div class="item"><span class="lbl">Barangay Address:</span><span class="val">Purok 1, Barangay Bacsay, San Esteban, Ilocos Sur</span></div>
    </div>

    <div class="section-title">II. Medical Background</div>
    <div class="info-grid">
        <div class="item"><span class="lbl">Known Allergies:</span><span class="val">Penicillin, Sulfa Drugs</span></div>
        <div class="item"><span class="lbl">Existing Conditions:</span><span class="val">Essential Hypertension Stage 1</span></div>
    </div>

    <div class="section-title">III. Vaccination History</div>
    <table class="print-table">
        <thead>
            <tr>
                <th>Vaccine</th>
                <th>Dose</th>
                <th>Date Administered</th>
                <th>Administered By</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>COVID-19 (Sinovac)</td>
                <td>1st Dose</td>
                <td>June 15, 2021</td>
                <td>Nurse Teresa Alonzo, RN</td>
            </tr>
            <tr>
                <td>COVID-19 (Sinovac)</td>
                <td>2nd Dose</td>
                <td>July 13, 2021</td>
                <td>Nurse Teresa Alonzo, RN</td>
            </tr>
            <tr>
                <td>Tetanus Toxoid</td>
                <td>Booster</td>
                <td>February 20, 2025</td>
                <td>Nurse Teresa Alonzo, RN</td>
            </tr>
        </tbody>
    </table>

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
