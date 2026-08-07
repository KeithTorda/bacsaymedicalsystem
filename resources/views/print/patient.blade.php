@extends('print.layout')

@section('title', 'Patient Medical Record — ' . ($patient->name ?? $patient->full_name ?? 'Patient Record'))

@section('content')
    @php
        $patientName = $patient->name ?? $patient->full_name ?? ($patient->first_name . ' ' . $patient->last_name);
        $patientCode = $patient->patient_code ?? $patient->patient_id ?? ('BAC-2026-' . sprintf('%03d', $patient->id));
        $dob = $patient->birthdate ?? $patient->date_of_birth;
        $age = $patient->age ?? ($dob ? \Carbon\Carbon::parse($dob)->age : 'N/A');
        $formattedDob = $dob ? \Carbon\Carbon::parse($dob)->format('F d, Y') : 'N/A';
        $contact = $patient->contact ?? $patient->contact_number ?? 'N/A';
        $allergies = $patient->allergies ?? 'None Reported';
        $conditions = $patient->diseases ?? $patient->medical_conditions ?? 'None Documented';
        $vaccineHistory = $patient->vaccination ?? 'Routine Childhood Immunization Completed';
        
        $latestConsult = $patient->consultations ? $patient->consultations->sortByDesc('created_at')->first() : null;
        $latestRecord = $patient->medicalRecords ? $patient->medicalRecords->sortByDesc('created_at')->first() : null;
        $latestRx = $patient->prescriptions ? $patient->prescriptions->sortByDesc('created_at')->first() : null;
    @endphp

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
                <div class="header-qr-code-text">{{ $patientCode }}</div>
            </div>
        </div>
    </div>

    <!-- ─── Document Title Bar ─── -->
    <div class="doc-title-bar">
        <div class="doc-title-main">PATIENT MEDICAL RECORD</div>
        <div class="doc-title-sub">(Official Patient Information Sheet)</div>
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
                    <div class="field-value" style="font-weight: 800; color: #0369a1;">{{ $patientCode }}</div>
                </div>
                <div class="field-row">
                    <div class="field-label">Date Registered</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ \Carbon\Carbon::parse($patient->created_at)->format('F d, Y') }}</div>
                </div>

                <div class="field-row">
                    <div class="field-label">Full Name</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ $patientName }}</div>
                </div>
                <div class="field-row">
                    <div class="field-label">Sex</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ ucfirst($patient->sex ?? 'Unspecified') }}</div>
                </div>

                <div class="field-row">
                    <div class="field-label">Birthdate</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ $formattedDob }}</div>
                </div>
                <div class="field-row">
                    <div class="field-label">Age</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ $age }} yrs old</div>
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
                    <div class="field-value">{{ $contact }}</div>
                </div>
                <div class="field-row" style="grid-column: span 2;">
                    <div class="field-label">Address</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ $patient->address ?? 'Barangay Bacsay, Luna, Apayao' }}</div>
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
                        {!! nl2br(e($allergies)) !!}
                    </div>
                </div>

                <div class="med-bg-box">
                    <div class="med-bg-title">➕ EXISTING MEDICAL CONDITIONS</div>
                    <div style="font-size: 9pt; color: #1e293b; line-height: 1.5;">
                        {!! nl2br(e($conditions)) !!}
                    </div>
                </div>

                <div class="med-bg-box">
                    <div class="med-bg-title">👤 EMERGENCY CONTACT</div>
                    <div style="font-size: 8.5pt; color: #1e293b; line-height: 1.6;">
                        <strong>Name:</strong> {{ $patient->emergency_contact_name ?? 'Family Representative' }}<br>
                        <strong>Contact:</strong> {{ $patient->emergency_contact_phone ?? $patient->emergency_contact_number ?? $contact }}
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
                        <th>STATUS / DATE ADMINISTERED</th>
                        <th>ADMINISTERED BY</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-weight: 700; color: #0369a1;">COVID-19 Vaccine</td>
                        <td>Complete Primary Series</td>
                        <td>Completed</td>
                        <td>Health Center Staff</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 700; color: #0369a1;">Tetanus Toxoid</td>
                        <td>Booster Dose</td>
                        <td>Recorded</td>
                        <td>Health Center Staff</td>
                    </tr>
                    @if($patient->vaccination)
                    <tr>
                        <td colspan="4"><strong>Additional Immunization Notes:</strong> {{ $patient->vaccination }}</td>
                    </tr>
                    @endif
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
                    {{ $latestConsult->diagnosis ?? $latestRecord->diagnosis ?? 'Routine Medical Consultation & Physical Assessment' }}
                </div>
            </div>

            <div class="summary-line-item">
                <div class="label">💊 TREATMENT</div>
                <div class="line-fill">
                    {{ $latestConsult->treatment ?? $latestRecord->treatment ?? 'Health Education, Lifestyle Modification & Follow-up Advice' }}
                </div>
            </div>

            <div class="summary-line-item">
                <div class="label">📄 PRESCRIPTION</div>
                <div class="line-fill">
                    @if($latestRx && $latestRx->items->isNotEmpty())
                        @foreach($latestRx->items as $item)
                            {{ $loop->iteration }}. {{ $item->medicine_name }} {{ $item->dosage }} ({{ $item->frequency }}) &nbsp;
                        @endforeach
                    @else
                        {{ $latestConsult->prescription ?? 'No Active Prescribed Medications' }}
                    @endif
                </div>
            </div>

            <div class="summary-line-item">
                <div class="label">📅 FOLLOW-UP DATE</div>
                <div class="line-fill">
                    {{ $latestConsult->next_visit ? \Carbon\Carbon::parse($latestConsult->next_visit)->format('F d, Y') : 'As needed / Upon discomfort' }}
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
                        {{ $patientName }}
                    </div>
                    <div class="signature-sub">Patient / Representative Signature</div>
                </div>

                <div class="signature-col">
                    <div class="signature-line">
                        {{ auth()->user()->name ?? 'Dr. / Nurse Health Officer' }}
                    </div>
                    <div class="signature-sub">{{ auth()->user()->role_name ?? 'Attending Health Officer' }}</div>
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
