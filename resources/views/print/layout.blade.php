<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Patient Medical Record — Barangay Bacsay Health Center')</title>
    <style>
        /* ─── A4 Official Print Reset ─── */
        @page {
            size: A4 portrait;
            margin: 10mm 12mm;
        }
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
            color: #0f172a;
            background: #ffffff;
            line-height: 1.4;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .print-container {
            width: 100%;
            max-width: 210mm;
            margin: 0 auto;
            background: #ffffff;
            padding: 8px;
            border: 2px solid #0369a1;
        }

        /* ─── Official Header Grid (Matches Image 2) ─── */
        .official-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #0284c7;
            padding-bottom: 10px;
            margin-bottom: 12px;
        }
        .header-seal-left {
            width: 72px;
            height: 72px;
            flex-shrink: 0;
        }
        .header-seal-left img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .header-center-details {
            text-align: center;
            flex: 1;
            padding: 0 12px;
        }
        .header-gov-sub {
            font-size: 8pt;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: #334155;
            font-weight: 500;
        }
        .header-prov {
            font-size: 9pt;
            font-weight: 700;
            color: #0f172a;
        }
        .header-facility {
            font-size: 15pt;
            font-weight: 900;
            color: #0369a1;
            letter-spacing: 0.5px;
            margin: 2px 0;
            text-transform: uppercase;
        }
        .header-address {
            font-size: 8.5pt;
            color: #475569;
        }
        .header-brand-line {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 4px;
            font-size: 9pt;
            font-weight: 700;
            color: #0284c7;
        }
        .header-brand-line img {
            width: 16px;
            height: 16px;
        }

        .header-seal-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }
        .header-seal-right .bacsay-seal {
            width: 64px;
            height: 64px;
            object-fit: contain;
        }
        .header-qr-box {
            text-align: center;
            border: 1px solid #cbd5e1;
            padding: 4px;
            border-radius: 4px;
            background: #f8fafc;
        }
        .header-qr-box img {
            width: 48px;
            height: 48px;
            display: block;
        }
        .header-qr-code-text {
            font-size: 7.5pt;
            font-weight: 700;
            color: #0f172a;
            margin-top: 2px;
        }

        /* ─── Document Main Title Bar ─── */
        .doc-title-bar {
            text-align: center;
            margin-bottom: 12px;
        }
        .doc-title-main {
            font-size: 13pt;
            font-weight: 900;
            color: #0369a1;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        .doc-title-main::before, .doc-title-main::after {
            content: "";
            flex: 1;
            height: 1.5px;
            background: linear-gradient(90deg, transparent, #0284c7, transparent);
        }
        .doc-title-sub {
            font-size: 9pt;
            color: #475569;
            font-style: italic;
        }

        /* ─── Numbered Blue Section Headers ─── */
        .section-box {
            margin-bottom: 12px;
            border: 1px solid #0284c7;
            border-radius: 6px;
            overflow: hidden;
        }
        .section-header-strip {
            background: #0284c7;
            color: #ffffff;
            padding: 6px 12px;
            font-size: 9.5pt;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .section-num-badge {
            background: #0369a1;
            color: #ffffff;
            padding: 2px 8px;
            border-radius: 3px;
            font-size: 9pt;
            font-weight: 900;
        }

        .section-content {
            padding: 10px 14px;
            background: #ffffff;
        }

        /* ─── Field Grid System ─── */
        .field-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 6px 20px;
            font-size: 9.5pt;
        }
        .field-row {
            display: flex;
            align-items: baseline;
        }
        .field-label {
            font-weight: 700;
            width: 140px;
            color: #1e293b;
            flex-shrink: 0;
        }
        .field-colon {
            margin-right: 8px;
            font-weight: 700;
            color: #64748b;
        }
        .field-value {
            color: #0f172a;
            font-weight: 600;
            flex: 1;
            border-bottom: 1px dotted #cbd5e1;
            padding-bottom: 2px;
        }

        /* ─── Tables ─── */
        table.official-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
        }
        table.official-table th, table.official-table td {
            border: 1px solid #cbd5e1;
            padding: 6px 10px;
            text-align: left;
        }
        table.official-table th {
            background: #e0f2fe;
            color: #0369a1;
            font-weight: 800;
            text-transform: uppercase;
            font-size: 8.5pt;
        }

        /* ─── Medical Background 3-Column Box ─── */
        .med-bg-grid {
            display: grid;
            grid-template-columns: 1.2fr 1.4fr 1.4fr;
            gap: 12px;
        }
        .med-bg-box {
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 8px;
            background: #f8fafc;
        }
        .med-bg-title {
            font-size: 8.5pt;
            font-weight: 800;
            color: #0369a1;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
            text-transform: uppercase;
        }

        /* ─── Consultation Summary Rows ─── */
        .summary-line-item {
            margin-bottom: 8px;
        }
        .summary-line-item .label {
            font-weight: 800;
            font-size: 9pt;
            color: #0369a1;
            text-transform: uppercase;
            margin-bottom: 2px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .summary-line-item .line-fill {
            border-bottom: 1px solid #cbd5e1;
            min-height: 22px;
            padding: 2px 4px;
            font-size: 9.5pt;
            color: #0f172a;
        }

        /* ─── Signature Block ─── */
        .signatures-grid {
            display: flex;
            justify-content: space-between;
            padding: 20px 40px 10px;
        }
        .signature-col {
            text-align: center;
            width: 220px;
        }
        .signature-line {
            border-top: 1.5px solid #0f172a;
            margin-top: 35px;
            padding-top: 4px;
            font-weight: 800;
            font-size: 9.5pt;
            color: #0f172a;
        }
        .signature-sub {
            font-size: 8.5pt;
            color: #475569;
        }

        /* ─── Footer ─── */
        .official-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #0284c7;
            padding-top: 8px;
            margin-top: 12px;
            font-size: 8pt;
            color: #475569;
        }
        .footer-brand {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 700;
            color: #0369a1;
        }

        /* Screen Print Helper Bar */
        .no-print {
            background: #0f172a;
            color: #ffffff;
            padding: 12px 20px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        @media print {
            .no-print { display: none !important; }
            .print-container { border: none !important; padding: 0 !important; }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <div class="d-flex align-items-center gap-2">
            <img src="{{ asset('assets/img/bacsaymedsys-icon.svg') }}" style="width: 28px; height: 28px;">
            <span style="font-weight: 700; font-size: 15px;">BacsayMedSys — Official Patient Medical Record Print</span>
        </div>
        <div>
            <button onclick="window.print()" style="background: #0284c7; color: #fff; border: none; padding: 8px 18px; font-weight: 700; border-radius: 6px; cursor: pointer;">
                🖨️ Print Document
            </button>
            <button onclick="window.close()" style="background: #334155; color: #fff; border: none; padding: 8px 14px; font-weight: 600; border-radius: 6px; cursor: pointer; margin-left: 8px;">
                ✖ Close
            </button>
        </div>
    </div>

    <div class="print-container">
        @yield('content')
    </div>

</body>
</html>
