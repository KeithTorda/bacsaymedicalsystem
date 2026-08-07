@extends('print.layout')

@section('title', 'Patient Referral Form — Barangay Bacsay Health Center')

@section('content')
    <!-- ─── Official Header Grid (Matches Image 2) ─── -->
    <div class="official-header">
        <div class="header-seal-left">
            <img src="{{ asset('assets/img/doh-seal.svg') }}" alt="DOH Seal">
        </div>

        <div class="header-center-details">
            <div class="header-gov-sub">REPUBLIC OF THE PHILIPPINES</div>
            <div class="header-prov">Province of Apayao • Municipality of Luna</div>
            <div class="header-facility">BARANGAY BACSAY HEALTH CENTER</div>
            <div class="header-address">Barangay Bacsay, Luna, Apayao</div>
            <div class="header-brand-line">
                <img src="{{ asset('assets/img/bacsaymedsys-icon.svg') }}" alt="Icon">
                <span>BacsayMedSys</span>
                <span style="font-weight: 500; font-size: 8pt; color: #475569;">| MEDICAL RECORD MANAGEMENT SYSTEM</span>
            </div>
        </div>

        <div class="header-seal-right">
            <img src="{{ asset('assets/img/bacsay-seal.svg') }}" class="bacsay-seal" alt="Barangay Bacsay Seal">
            <div class="header-qr-box">
                <svg width="46" height="46" viewBox="0 0 100 100" fill="#0f172a">
                    <rect x="0" y="0" width="30" height="30" />
                    <rect x="5" y="5" width="20" height="20" fill="#fff" />
                    <rect x="10" y="10" width="10" height="10" />
                    <rect x="70" y="0" width="30" height="30" />
                    <rect x="75" y="5" width="20" height="20" fill="#fff" />
                    <rect x="80" y="10" width="10" height="10" />
                    <rect x="0" y="70" width="30" height="30" />
                    <rect x="5" y="75" width="20" height="20" fill="#fff" />
                    <rect x="10" y="80" width="10" height="10" />
                    <rect x="40" y="10" width="15" height="15" />
                    <rect x="40" y="40" width="20" height="20" />
                    <rect x="70" y="40" width="15" height="15" />
                    <rect x="40" y="70" width="15" height="15" />
                    <rect x="70" y="70" width="20" height="20" />
                </svg>
                <div class="header-qr-code-text">REF-2026-001</div>
            </div>
        </div>
    </div>

    <!-- ─── Document Title Bar ─── -->
    <div class="doc-title-bar">
        <div class="doc-title-main">PATIENT REFERRAL FORM</div>
        <div class="doc-title-sub">(Inter-Facility Transfer & Specialist Referral Slip)</div>
    </div>

    <!-- ─── Section 1: Referring Facility & Patient Information ─── -->
    <div class="section-box">
        <div class="section-header-strip">
            <span class="section-num-badge">1</span>
            <span>PATIENT & REFERRING FACILITY DETAILS</span>
        </div>
        <div class="section-content">
            <div class="field-grid">
                <div class="field-row">
                    <div class="field-label">Referring Facility</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">Barangay Bacsay Health Center</div>
                </div>
                <div class="field-row">
                    <div class="field-label">Date of Referral</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ now()->format('F d, Y') }}</div>
                </div>

                <div class="field-row">
                    <div class="field-label">Patient ID</div>
                    <div class="field-colon">:</div>
                    <div class="field-value" style="font-weight: 800; color: #0369a1;">{{ $patient->patient_id ?? 'BAC-2026-001' }}</div>
                </div>
                <div class="field-row">
                    <div class="field-label">Patient Name</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ $patient->full_name ?? 'Roberto Garcia Jr.' }}</div>
                </div>

                <div class="field-row">
                    <div class="field-label">Sex / Age</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ ucfirst($patient->sex ?? 'male') }} / {{ \Carbon\Carbon::parse($patient->date_of_birth ?? '1959-05-10')->age }} yrs</div>
                </div>
                <div class="field-row">
                    <div class="field-label">Known Allergies</div>
                    <div class="field-colon">:</div>
                    <div class="field-value" style="color: #dc2626; font-weight: 800;">{{ $patient->allergies ?? 'NSAIDs (Mefenamic Acid)' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ─── Section 2: Clinical Reason for Referral ─── -->
    <div class="section-box">
        <div class="section-header-strip">
            <span class="section-num-badge">2</span>
            <span>REASON FOR REFERRAL & CLINICAL FINDINGS</span>
        </div>
        <div class="section-content">
            <div style="font-size: 9.5pt; color: #1e293b; line-height: 1.6;">
                Patient presents with persistent elevated Blood Pressure (160/100 mmHg) and severe joint discomfort requiring specialist tertiary evaluation. Initial primary care management provided at health center; referred for further diagnostic workup and specialized cardiology/orthopedic review.
            </div>
        </div>
    </div>

    <!-- ─── Section 3: Vital Signs at Transfer ─── -->
    <div class="section-box">
        <div class="section-header-strip">
            <span class="section-num-badge">3</span>
            <span>VITAL SIGNS AT TIME OF REFERRAL</span>
        </div>
        <div class="section-content" style="padding: 0;">
            <table class="official-table">
                <thead>
                    <tr>
                        <th>Blood Pressure</th>
                        <th>Body Temp</th>
                        <th>Pulse Rate</th>
                        <th>Resp. Rate</th>
                        <th>Height</th>
                        <th>Weight</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-weight: 800; color: #dc2626;">160/100 mmHg</td>
                        <td>36.6 °C</td>
                        <td>88 bpm</td>
                        <td>20 cpm</td>
                        <td>168 cm</td>
                        <td>75 kg</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ─── Section 4: Receiving Facility & Signatures ─── -->
    <div class="section-box">
        <div class="section-header-strip">
            <span class="section-num-badge">4</span>
            <span>REFERRED TO & SIGNATURES</span>
        </div>
        <div class="section-content">
            <div class="field-grid mb-3">
                <div class="field-row">
                    <div class="field-label">Receiving Hospital</div>
                    <div class="field-colon">:</div>
                    <div class="field-value" style="font-weight: 800; color: #0369a1;">Apayao Provincial Hospital / District Hospital</div>
                </div>
                <div class="field-row">
                    <div class="field-label">Specialty Dept</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">Internal Medicine / Orthopedics</div>
                </div>
            </div>

            <div class="signatures-grid">
                <div class="signature-col">
                    <div class="signature-line">
                        {{ $patient->full_name ?? 'Patient / Guardian' }}
                    </div>
                    <div class="signature-sub">Patient / Representative Signature</div>
                </div>

                <div class="signature-col">
                    <div class="signature-line">
                        Nurse Teresa Alonzo, RN
                    </div>
                    <div class="signature-sub">Referring Health Officer</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ─── Official Footer ─── -->
    <div class="official-footer">
        <div class="footer-brand">
            <img src="{{ asset('assets/img/bacsaymedsys-icon.svg') }}" style="width: 14px; height: 14px;">
            <span>Generated by BacsayMedSys | Barangay Bacsay Health Center Medical Record Management System</span>
        </div>
        <div>
            📅 Printed on {{ now()->format('F d, Y h:i A') }}
        </div>
    </div>
@endsection
