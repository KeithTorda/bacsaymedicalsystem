<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Patient Medical Record — Barangay Bacsay Health Center')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
    <style>
        /* ─── A4 Official Print Reset ─── */
        @page {
            size: A4 portrait;
            margin: 8mm 10mm;
        }
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, Helvetica, sans-serif;
            font-size: 9.5pt;
            color: #0f172a;
            background: #f1f5f9;
            line-height: 1.45;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* Screen Preview Document Paper Container */
        .document-wrapper {
            max-width: 215mm;
            margin: 16px auto 32px;
            padding: 0 12px;
        }

        .print-container {
            width: 100%;
            background: #ffffff;
            padding: 16px 20px;
            border: 2px solid #0284c7;
            border-radius: 8px;
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.12), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* ─── Screen Print Helper Bar ─── */
        .no-print {
            background: #0f172a;
            color: #ffffff;
            padding: 12px 18px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .no-print-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .no-print-brand img {
            width: 32px;
            height: 32px;
            object-fit: cover;
            border-radius: 50%;
            border: 1.5px solid #38bdf8;
        }
        .no-print-title {
            font-weight: 700;
            font-size: 14.5px;
            color: #f8fafc;
            letter-spacing: -0.2px;
        }
        .no-print-sub {
            font-size: 11.5px;
            color: #94a3b8;
        }
        .no-print-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-print-action {
            background: #0284c7;
            color: #ffffff;
            border: none;
            padding: 8px 18px;
            font-weight: 700;
            font-size: 13px;
            border-radius: 6px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background 0.2s ease;
        }
        .btn-print-action:hover {
            background: #0369a1;
        }
        .btn-close-action {
            background: #334155;
            color: #f1f5f9;
            border: 1px solid #475569;
            padding: 8px 14px;
            font-weight: 600;
            font-size: 13px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s ease;
        }
        .btn-close-action:hover {
            background: #475569;
        }

        /* ─── Official DOH & Barangay Header ─── */
        .official-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2.5px solid #0284c7;
            padding-bottom: 10px;
            margin-bottom: 10px;
            gap: 12px;
        }
        .header-seal-left {
            width: 68px;
            height: 68px;
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
            padding: 0 8px;
        }
        .header-gov-sub {
            font-size: 8pt;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: #334155;
            font-weight: 700;
        }
        .header-prov {
            font-size: 9pt;
            font-weight: 800;
            color: #0f172a;
        }
        .header-facility {
            font-size: 14pt;
            font-weight: 900;
            color: #0369a1;
            letter-spacing: 0.4px;
            margin: 2px 0;
            text-transform: uppercase;
        }
        .header-address {
            font-size: 8.5pt;
            color: #334155;
            font-weight: 500;
        }
        .header-brand-line {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 3px;
            font-size: 8.5pt;
            font-weight: 800;
            color: #0284c7;
        }
        .header-brand-line img {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            object-fit: cover;
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
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0 1px 3px rgba(0,0,0,0.15);
        }
        .header-qr-box {
            text-align: center;
            border: 1.5px solid #cbd5e1;
            padding: 3px;
            border-radius: 6px;
            background: #f8fafc;
        }
        .header-qr-box svg, .header-qr-box img {
            width: 44px;
            height: 44px;
            display: block;
            margin: 0 auto;
        }
        .header-qr-code-text {
            font-size: 7pt;
            font-weight: 800;
            color: #0f172a;
            margin-top: 2px;
        }

        /* ─── Document Title Bar ─── */
        .doc-title-bar {
            text-align: center;
            margin-bottom: 10px;
        }
        .doc-title-main {
            font-size: 12.5pt;
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
            font-size: 8.5pt;
            color: #334155;
            font-weight: 600;
            font-style: italic;
        }

        /* ─── Numbered Blue Section Headers ─── */
        .section-box {
            margin-bottom: 10px;
            border: 1.5px solid #0284c7;
            border-radius: 6px;
            overflow: hidden;
            background: #ffffff;
        }
        .section-header-strip {
            background: #0284c7;
            color: #ffffff;
            padding: 5px 10px;
            font-size: 9pt;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .section-num-badge {
            background: #075985;
            color: #ffffff;
            padding: 2px 7px;
            border-radius: 3px;
            font-size: 8.5pt;
            font-weight: 900;
        }

        .section-content {
            padding: 8px 12px;
            background: #ffffff;
        }

        /* ─── High Contrast Field Grid System ─── */
        .field-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 5px 16px;
            font-size: 9pt;
        }
        .field-row {
            display: flex;
            align-items: baseline;
        }
        .field-label {
            font-weight: 800;
            width: 135px;
            color: #0f172a;
            flex-shrink: 0;
            font-size: 8.5pt;
            text-transform: uppercase;
        }
        .field-colon {
            margin-right: 6px;
            font-weight: 800;
            color: #64748b;
        }
        .field-value {
            color: #0f172a;
            font-weight: 700;
            flex: 1;
            border-bottom: 1px solid #cbd5e1;
            padding-bottom: 1px;
            min-height: 18px;
        }

        /* ─── High Contrast Tables ─── */
        table.official-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8.5pt;
        }
        table.official-table th, table.official-table td {
            border: 1px solid #94a3b8;
            padding: 5px 8px;
            text-align: left;
            vertical-align: middle;
        }
        table.official-table th {
            background: #e0f2fe;
            color: #0369a1;
            font-weight: 900;
            text-transform: uppercase;
            font-size: 8pt;
            letter-spacing: 0.3px;
        }
        table.official-table td {
            color: #0f172a;
            font-weight: 600;
        }

        /* ─── Medical Background 3-Column Box ─── */
        .med-bg-grid {
            display: grid;
            grid-template-columns: 1.2fr 1.4fr 1.4fr;
            gap: 8px;
        }
        .med-bg-box {
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            padding: 6px 8px;
            background: #f8fafc;
        }
        .med-bg-title {
            font-size: 8pt;
            font-weight: 900;
            color: #0369a1;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
            text-transform: uppercase;
            letter-spacing: 0.2px;
        }

        /* ─── Consultation Summary Rows ─── */
        .summary-line-item {
            margin-bottom: 6px;
        }
        .summary-line-item .label {
            font-weight: 900;
            font-size: 8.5pt;
            color: #0369a1;
            text-transform: uppercase;
            margin-bottom: 2px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .summary-line-item .line-fill {
            border-bottom: 1px solid #94a3b8;
            min-height: 20px;
            padding: 1px 4px;
            font-size: 9pt;
            font-weight: 600;
            color: #0f172a;
        }

        /* ─── Signatures Block ─── */
        .signatures-grid {
            display: flex;
            justify-content: space-between;
            padding: 15px 30px 6px;
            gap: 20px;
        }
        .signature-col {
            text-align: center;
            width: 220px;
        }
        .signature-line {
            border-top: 1.5px solid #0f172a;
            margin-top: 28px;
            padding-top: 3px;
            font-weight: 900;
            font-size: 9pt;
            color: #0f172a;
            text-transform: uppercase;
        }
        .signature-sub {
            font-size: 8pt;
            font-weight: 600;
            color: #475569;
        }

        /* ─── Official Footer ─── */
        .official-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1.5px solid #0284c7;
            padding-top: 6px;
            margin-top: 8px;
            font-size: 7.5pt;
            color: #475569;
            font-weight: 600;
        }
        .footer-brand {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 800;
            color: #0369a1;
        }

        /* ═══════════════════════════════════════════════════
           RESPONSIVE MOBILE & TABLET SCREEN TWEAKS
           ═══════════════════════════════════════════════════ */
        @media screen and (max-width: 768px) {
            body {
                padding: 6px;
            }
            .document-wrapper {
                margin: 6px auto 20px;
                padding: 0;
            }
            .no-print {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
            .no-print-brand {
                flex-direction: column;
                gap: 6px;
            }
            .no-print-actions {
                width: 100%;
                justify-content: center;
            }
            .print-container {
                padding: 12px 10px;
                border-radius: 6px;
            }
            .official-header {
                flex-direction: column;
                text-align: center;
                gap: 8px;
            }
            .header-facility {
                font-size: 12pt;
            }
            .header-seal-right {
                justify-content: center;
            }
            .field-grid {
                grid-template-columns: 1fr;
                gap: 6px;
            }
            .field-label {
                width: 110px;
                font-size: 8pt;
            }
            .med-bg-grid {
                grid-template-columns: 1fr;
                gap: 8px;
            }
            .signatures-grid {
                flex-direction: column;
                align-items: center;
                padding: 10px 0;
            }
            .signature-col {
                width: 100%;
                max-width: 240px;
            }
            .official-footer {
                flex-direction: column;
                text-align: center;
                gap: 4px;
            }
        }

        /* ═══════════════════════════════════════════════════
           STRICT PHYSICAL PRINT / PDF OUTPUT OVERRIDES
           ═══════════════════════════════════════════════════ */
        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .document-wrapper {
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .no-print {
                display: none !important;
            }
            .print-container {
                border: 2px solid #0369a1 !important;
                box-shadow: none !important;
                border-radius: 0 !important;
                padding: 8px 10px !important;
                margin: 0 !important;
            }
            .field-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
            .med-bg-grid {
                grid-template-columns: 1.2fr 1.4fr 1.4fr !important;
            }
            .official-header {
                flex-direction: row !important;
            }
            .signatures-grid {
                flex-direction: row !important;
            }
            .official-footer {
                flex-direction: row !important;
            }
        }
    </style>
</head>
<body>

    <div class="document-wrapper">
        <div class="no-print">
            <div class="no-print-brand">
                <img src="{{ asset('assets/img/bacsay-seal.jpg') }}" alt="Barangay Bacsay Seal">
                <div>
                    <div class="no-print-title">BacsayMedSys — Official Patient Medical Record Print</div>
                    <div class="no-print-sub">Barangay Bacsay Health Center, Luna, Apayao • Standard A4 Official Copy</div>
                </div>
            </div>
            <div class="no-print-actions">
                <button onclick="window.print()" class="btn-print-action">
                    🖨️ Print / Save as PDF
                </button>
                <button onclick="window.close()" class="btn-close-action">
                    ✖ Close Window
                </button>
            </div>
        </div>

        <div class="print-container">
            @yield('content')
        </div>
    </div>

</body>
</html>
