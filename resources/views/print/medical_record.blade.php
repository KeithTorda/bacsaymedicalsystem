@extends('print.layout')

@section('title', 'Medical Record — Record #' . ($record->id ?? 1))

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
                <div class="header-qr-code-text">{{ $record->record_code ?? 'MR-2026-001' }}</div>
            </div>
        </div>
    </div>

    <!-- ─── Document Title Bar ─── -->
    <div class="doc-title-bar">
        <div class="doc-title-main">CLINICAL MEDICAL RECORD</div>
        <div class="doc-title-sub">(Official Patient Consultation Report)</div>
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
                    <div class="field-label">Record Code</div>
                    <div class="field-colon">:</div>
                    <div class="field-value" style="font-weight: 800; color: #0369a1;">{{ $record->record_code ?? 'MR-2026-001' }}</div>
                </div>
                <div class="field-row">
                    <div class="field-label">Consultation Date</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ \Carbon\Carbon::parse($record->created_at)->format('F d, Y') }}</div>
                </div>

                <div class="field-row">
                    <div class="field-label">Patient Name</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ $record->patient->full_name ?? 'N/A' }}</div>
                </div>
                <div class="field-row">
                    <div class="field-label">Patient ID</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ $record->patient->patient_id ?? 'N/A' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ─── Section 2: Clinical Examination ─── -->
    <div class="section-box">
        <div class="section-header-strip">
            <span class="section-num-badge">2</span>
            <span>CLINICAL EXAMINATION & DIAGNOSIS</span>
        </div>
        <div class="section-content">
            <div class="summary-line-item">
                <div class="label">📋 CHIEF COMPLAINT & SYMPTOMS</div>
                <div class="line-fill">{{ $record->symptoms ?? 'Routine Health Checkup' }}</div>
            </div>
            <div class="summary-line-item">
                <div class="label">🩺 DIAGNOSIS</div>
                <div class="line-fill" style="font-weight: 700; color: #0369a1;">{{ $record->diagnosis }}</div>
            </div>
            <div class="summary-line-item">
                <div class="label">💊 TREATMENT PLAN & ADVICE</div>
                <div class="line-fill">{{ $record->treatment }}</div>
            </div>
        </div>
    </div>

    <!-- ─── Section 3: Signatures ─── -->
    <div class="section-box">
        <div class="section-header-strip">
            <span class="section-num-badge">3</span>
            <span>ATTENDING HEALTH OFFICER SIGNATURE</span>
        </div>
        <div class="section-content">
            <div class="signatures-grid">
                <div class="signature-col">
                    <div class="signature-line">
                        {{ $record->patient->full_name ?? 'Patient' }}
                    </div>
                    <div class="signature-sub">Patient / Representative</div>
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
