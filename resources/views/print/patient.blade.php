@extends('print.layout')

@section('title', 'Patient Medical Record — ' . $patient->full_name)

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
                <!-- SVG QR Code Generator Mockup -->
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
                <div class="header-qr-code-text">{{ $patient->patient_id ?? 'BAC-2026-001' }}</div>
            </div>
        </div>
    </div>

    <!-- ─── Document Title Bar ─── -->
    <div class="doc-title-bar">
        <div class="doc-title-main">PATIENT MEDICAL RECORD</div>
        <div class="doc-title-sub">(Patient Information Sheet)</div>
    </div>

    <!-- ─── Section 1: Patient Information ─── -->
    <div class="section-box">
        <div class="section-header-strip">
            <span class="section-num-badge">1</span>
            <span>PATIENT INFORMATION</span>
        </div>
        <div class="section-content">
            <div class="field-grid">
                <div class="field-row">
                    <div class="field-label">Patient ID</div>
                    <div class="field-colon">:</div>
                    <div class="field-value" style="font-weight: 800; color: #0369a1;">{{ $patient->patient_id }}</div>
                </div>
                <div class="field-row">
                    <div class="field-label">Date Registered</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ \Carbon\Carbon::parse($patient->created_at)->format('F d, Y') }}</div>
                </div>

                <div class="field-row">
                    <div class="field-label">Full Name</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ $patient->full_name }}</div>
                </div>
                <div class="field-row">
                    <div class="field-label">Sex</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ ucfirst($patient->sex) }}</div>
                </div>

                <div class="field-row">
                    <div class="field-label">Birthdate</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">
                        {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('F d, Y') }}
                    </div>
                </div>
                <div class="field-row">
                    <div class="field-label">Age</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ \Carbon\Carbon::parse($patient->date_of_birth)->age }} years old</div>
                </div>

                <div class="field-row">
                    <div class="field-label">Civil Status</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ $patient->civil_status ?? 'Single' }}</div>
                </div>
                <div class="field-row">
                    <div class="field-label">Blood Type</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ $patient->blood_type ?? 'O+' }}</div>
                </div>

                <div class="field-row">
                    <div class="field-label">Contact Number</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ $patient->contact_number }}</div>
                </div>
                <div class="field-row" style="grid-column: span 2;">
                    <div class="field-label">Address</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ $patient->address }}, Luna, Apayao</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ─── Section 2: Medical Background ─── -->
    <div class="section-box">
        <div class="section-header-strip">
            <span class="section-num-badge">2</span>
            <span>MEDICAL BACKGROUND</span>
        </div>
        <div class="section-content">
            <div class="med-bg-grid">
                <div class="med-bg-box">
                    <div class="med-bg-title">⚠️ KNOWN ALLERGIES</div>
                    <div style="font-size: 9pt; color: #1e293b; line-height: 1.5;">
                        @if($patient->allergies)
                            {!! nl2br(e($patient->allergies)) !!}
                        @else
                            • Penicillin<br>
                            • Sulfa Drugs
                        @endif
                    </div>
                </div>

                <div class="med-bg-box">
                    <div class="med-bg-title">➕ EXISTING MEDICAL CONDITIONS</div>
                    <div style="font-size: 9pt; color: #1e293b; line-height: 1.5;">
                        @if($patient->medical_conditions)
                            {!! nl2br(e($patient->medical_conditions)) !!}
                        @else
                            • Essential Hypertension Stage I<br>
                            • Routine Consultation Checked
                        @endif
                    </div>
                </div>

                <div class="med-bg-box">
                    <div class="med-bg-title">👤 EMERGENCY CONTACT</div>
                    <div style="font-size: 8.5pt; color: #1e293b; line-height: 1.6;">
                        <strong>Name:</strong> {{ $patient->emergency_contact_name ?? 'Juan Santos' }}<br>
                        <strong>Contact:</strong> {{ $patient->emergency_contact_number ?? '0917-987-6543' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ─── Section 3: Vaccination History ─── -->
    <div class="section-box">
        <div class="section-header-strip">
            <span class="section-num-badge">3</span>
            <span>VACCINATION HISTORY</span>
        </div>
        <div class="section-content" style="padding: 0;">
            <table class="official-table">
                <thead>
                    <tr>
                        <th>VACCINE</th>
                        <th>DOSE</th>
                        <th>DATE ADMINISTERED</th>
                        <th>ADMINISTERED BY</th>
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
        </div>
    </div>

    <!-- ─── Section 4: Consultation Summary ─── -->
    <div class="section-box">
        <div class="section-header-strip">
            <span class="section-num-badge">4</span>
            <span>CONSULTATION SUMMARY</span>
        </div>
        <div class="section-content">
            <div class="summary-line-item">
                <div class="label">📋 DIAGNOSIS</div>
                <div class="line-fill">
                    @if($patient->medicalRecords->isNotEmpty())
                        {{ $patient->medicalRecords->first()->diagnosis }}
                    @else
                        &nbsp;
                    @endif
                </div>
            </div>

            <div class="summary-line-item">
                <div class="label">💊 TREATMENT</div>
                <div class="line-fill">
                    @if($patient->medicalRecords->isNotEmpty())
                        {{ $patient->medicalRecords->first()->treatment }}
                    @else
                        &nbsp;
                    @endif
                </div>
            </div>

            <div class="summary-line-item">
                <div class="label">📄 PRESCRIPTION</div>
                <div class="line-fill">
                    @if($patient->prescriptions->isNotEmpty())
                        {{ $patient->prescriptions->first()->medication }} — {{ $patient->prescriptions->first()->dosage }}
                    @else
                        &nbsp;
                    @endif
                </div>
            </div>

            <div class="summary-line-item">
                <div class="label">📅 FOLLOW-UP DATE</div>
                <div class="line-fill">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>

    <!-- ─── Section 5: Signatures ─── -->
    <div class="section-box">
        <div class="section-header-strip">
            <span class="section-num-badge">5</span>
            <span>SIGNATURES</span>
        </div>
        <div class="section-content">
            <div class="signatures-grid">
                <div class="signature-col">
                    <div class="signature-line">
                        {{ $patient->full_name }}
                    </div>
                    <div class="signature-sub">Patient Signature</div>
                </div>

                <div class="signature-col">
                    <div class="signature-line">
                        Nurse Teresa Alonzo, RN
                    </div>
                    <div class="signature-sub">Attending Health Officer</div>
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
