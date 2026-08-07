@extends('print.layout')

@section('title', 'Prescription (Rx) — ' . ($patient->name ?? $patient->full_name ?? 'Prescription'))

@section('content')
    @php
        $patient = $prescription->patient ?? $patient;
        $patientName = $patient->name ?? $patient->full_name ?? ($patient->first_name . ' ' . $patient->last_name ?? 'N/A');
        $patientCode = $patient->patient_code ?? $patient->patient_id ?? 'BAC-2026-001';
        $rxCode = $prescription->prescription_code ?? ('RX-2026-' . sprintf('%03d', $prescription->id ?? 1));
        $rxDate = $prescription->date ?? $prescription->created_at ?? now();
        $formattedRxDate = \Carbon\Carbon::parse($rxDate)->format('F d, Y');
        $allergies = $patient->allergies ?? 'None Reported';
        $items = $prescription->items ?? collect([]);
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
                <div class="header-qr-code-text">{{ $rxCode }}</div>
            </div>
        </div>
    </div>

    <!-- ─── Document Title Bar ─── -->
    <div class="doc-title-bar">
        <div class="doc-title-main">OFFICIAL PRESCRIPTION (Rx) FORM</div>
        <div class="doc-title-sub">(Barangay Bacsay Health Center Medical Rx)</div>
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
                    <div class="field-label">Date Issued</div>
                    <div class="field-colon">:</div>
                    <div class="field-value">{{ $formattedRxDate }}</div>
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

                <div class="field-row" style="grid-column: span 2;">
                    <div class="field-label">Known Allergies</div>
                    <div class="field-colon">:</div>
                    <div class="field-value" style="color: #dc2626; font-weight: 800;">
                        {{ $allergies }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ─── Section 2: Prescribed Medications (Rx) ─── -->
    <div class="section-box">
        <div class="section-header-strip">
            <span class="section-num-badge">2</span>
            <span>PRESCRIBED MEDICINES (Rx)</span>
        </div>
        <div class="section-content" style="padding: 0;">
            <div style="font-size: 24pt; font-weight: 900; text-align: center; color: #0369a1; padding: 4px 0 0;">℞</div>
            <table class="official-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 25%;">Medicine Name</th>
                        <th style="width: 15%;">Dosage</th>
                        <th style="width: 25%;">Frequency</th>
                        <th style="width: 15%;">Duration</th>
                        <th style="width: 15%;">Instructions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td style="font-weight: 700; color: #0369a1;">{{ $item->medicine_name }}</td>
                        <td>{{ $item->dosage }}</td>
                        <td>{{ $item->frequency }}</td>
                        <td>{{ $item->duration }}</td>
                        <td>{{ $item->instructions ?? 'Take as directed' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td>1</td>
                        <td style="font-weight: 700; color: #0369a1;">Amlodipine</td>
                        <td>5mg</td>
                        <td>Once daily (OD) in morning</td>
                        <td>30 Days</td>
                        <td>Take after meal</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td style="font-weight: 700; color: #0369a1;">Paracetamol</td>
                        <td>500mg</td>
                        <td>Every 6 hours as needed</td>
                        <td>5 Days</td>
                        <td>For pain / fever</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ─── Section 3: Important Health Officer Advice ─── -->
    <div class="section-box">
        <div class="section-header-strip">
            <span class="section-num-badge">3</span>
            <span>SPECIAL INSTRUCTIONS & PRECAUTIONS</span>
        </div>
        <div class="section-content">
            <div style="font-size: 9pt; color: #1e293b; line-height: 1.6;">
                • Do <strong>NOT</strong> take any medication listed under documented allergies ({{ $allergies }}).<br>
                • Follow prescribed dosage strictly. Complete full course of prescribed antibiotics if applicable.<br>
                • Return for follow-up evaluation upon finishing prescribed medications or as advised by health officer.
            </div>
        </div>
    </div>

    <!-- ─── Section 4: Signatures ─── -->
    <div class="section-box">
        <div class="section-header-strip">
            <span class="section-num-badge">4</span>
            <span>PRESCRIBING OFFICER SIGNATURE</span>
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
                        {{ auth()->user()->name ?? $prescription->attending_nurse ?? 'Health Center Officer' }}
                    </div>
                    <div class="signature-sub">{{ auth()->user()->role_name ?? 'Prescribing Health Officer' }}</div>
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
