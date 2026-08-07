@extends('print.layout')

@section('title', 'Consultation Record — ' . ($patient->name ?? $patient->full_name ?? 'Consultation'))

@section('content')
    @php
        $patient = $consultation->patient ?? $patient;
        $patientName = $patient->name ?? $patient->full_name ?? ($patient->first_name . ' ' . $patient->last_name ?? 'N/A');
        $patientCode = $patient->patient_code ?? $patient->patient_id ?? 'BAC-2026-001';
        $consultCode = $consultation->consultation_code ?? ('CON-2026-' . sprintf('%03d', $consultation->id ?? 1));
        $visitDate = $consultation->visit_date ?? $consultation->created_at ?? now();
        $formattedVisitDate = \Carbon\Carbon::parse($visitDate)->format('F d, Y');
        
        $bp = $consultation->bp ?? '120/80 mmHg';
        $temp = $consultation->temperature ?? '36.5 °C';
        $pr = $consultation->pulse_rate ?? '75 bpm';
        $rr = $consultation->respiratory_rate ?? '18 cpm';
        $height = $consultation->height ?? '162 cm';
        $weight = $consultation->weight ?? '60 kg';
        $complaint = $consultation->chief_complaint ?? 'Routine Medical Assessment';
        $diagnosis = $consultation->diagnosis ?? 'Routine Medical Examination';
        $treatment = $consultation->treatment ?? 'Lifestyle Education & Health Monitoring';
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
                <div class="header-qr-code-text">{{ $consultCode }}</div>
            </div>
        </div>
    </div>

    <!-- ─── Document Title Bar ─── -->
    <div class="doc-title-bar">
        <div class="doc-title-main">PATIENT CONSULTATION FORM</div>
        <div class="doc-title-sub">(Health Center Clinical Encounter Sheet)</div>
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
                    <div class="field-label">Consultation Date</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ $formattedVisitDate }}</div>
                </div>

                <div class="field-row">
                    <div class="field-label">Full Name</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ $patientName }}</div>
                </div>
                <div class="field-row">
                    <div class="field-label">Sex / Age</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ ucfirst($patient->sex ?? 'Unspecified') }} / {{ $patient->age ?? 'N/A' }} yrs</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ─── Section 2: Clinical Vitals ─── -->
    <div class="section-box">
        <div class="section-header-strip">
            <span class="section-num-badge">2</span>
            <span>PATIENT VITAL SIGNS</span>
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
                        <td style="font-weight: 800; color: #0369a1;">{{ $bp }}</td>
                        <td>{{ $temp }}</td>
                        <td>{{ $pr }}</td>
                        <td>{{ $rr }}</td>
                        <td>{{ $height }}</td>
                        <td>{{ $weight }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ─── Section 3: Diagnosis & Clinical Notes ─── -->
    <div class="section-box">
        <div class="section-header-strip">
            <span class="section-num-badge">3</span>
            <span>CLINICAL SUMMARY & TREATMENT</span>
        </div>
        <div class="section-content">
            <div class="summary-line-item">
                <div class="label">📋 CHIEF COMPLAINT</div>
                <div class="line-fill">{{ $complaint }}</div>
            </div>
            <div class="summary-line-item">
                <div class="label">🩺 DIAGNOSIS</div>
                <div class="line-fill" style="font-weight: 800; color: #0369a1;">{{ $diagnosis }}</div>
            </div>
            <div class="summary-line-item">
                <div class="label">💊 TREATMENT PLAN</div>
                <div class="line-fill">{{ $treatment }}</div>
            </div>
        </div>
    </div>

    <!-- ─── Section 4: Signatures ─── -->
    <div class="section-box">
        <div class="section-header-strip">
            <span class="section-num-badge">4</span>
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
                        {{ auth()->user()->name ?? $consultation->attending_nurse ?? 'Health Center Officer' }}
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
