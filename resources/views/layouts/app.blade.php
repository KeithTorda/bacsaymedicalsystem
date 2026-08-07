<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="BacsayMedSys — Barangay Bacsay Medical Record Management System">
    <meta name="keywords" content="bacsaymedsys, medical records, barangay bacsay, health center">
    <meta name="author" content="BacsayMedSys">
    <title>{{ ucwords(str_replace('.', ' - ', Route::currentRouteName())) }} — BacsayMedSys</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        /* ─── Warm Beige & Orange Centered Card Theme ─── */
        :root {
            --bg-page: #faf6f0;
            --bg-card: #ffffff;
            --primary-orange: #ea580c;
            --primary-orange-hover: #c2410c;
            --primary-orange-light: #fff7ed;
            --primary-orange-border: #fed7aa;
            --text-heading: #0f172a;
            --text-body: #475569;
            --text-muted: #94a3b8;
            --border-color: #cbd5e1;
        }

        body.account-page {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background-color: var(--bg-page);
            background-image: 
                radial-gradient(at 10% 10%, rgba(254, 215, 170, 0.4) 0px, transparent 50%),
                radial-gradient(at 90% 90%, rgba(253, 186, 116, 0.3) 0px, transparent 50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            position: relative;
        }

        .account-container {
            width: 100%;
            max-width: 440px;
            margin: 20px auto 10px;
            background: var(--bg-card);
            border-radius: 20px;
            box-shadow: 0 20px 40px -15px rgba(234, 88, 12, 0.12), 0 0 2px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid rgba(254, 215, 170, 0.6);
            padding: 40px 36px;
        }

        /* ─── Floating Inset Label Inputs ─── */
        .input-floating-group {
            position: relative;
            margin-bottom: 22px;
        }

        .input-floating-group label {
            position: absolute;
            top: -10px;
            left: 16px;
            background: #ffffff;
            padding: 0 6px;
            font-size: 12px;
            font-weight: 700;
            color: var(--primary-orange);
            letter-spacing: 0.3px;
            z-index: 2;
            border-radius: 4px;
        }

        .input-floating-group .form-control {
            height: 52px;
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            padding: 12px 18px;
            font-size: 14px;
            color: var(--text-heading);
            background: #ffffff;
            transition: all 0.2s ease;
        }

        .input-floating-group .form-control:focus {
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 4px rgba(234, 88, 12, 0.12);
            outline: none;
        }

        /* Buttons & Accent Elements */
        .btn-pill-orange {
            background: var(--primary-orange);
            color: #ffffff !important;
            font-weight: 700;
            font-size: 15px;
            height: 50px;
            border-radius: 25px;
            border: none;
            width: 100%;
            transition: all 0.2s ease;
            box-shadow: 0 6px 18px rgba(234, 88, 12, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-pill-orange:hover {
            background: var(--primary-orange-hover);
            transform: translateY(-1px);
            box-shadow: 0 8px 22px rgba(234, 88, 12, 0.4);
        }

        .btn-pill-google {
            background: #ffffff;
            color: var(--text-heading) !important;
            font-weight: 600;
            font-size: 14px;
            height: 50px;
            border-radius: 25px;
            border: 1.5px solid var(--border-color);
            width: 100%;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .btn-pill-google:hover {
            border-color: var(--primary-orange);
            background: var(--primary-orange-light);
        }

        .divider-line {
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--text-muted);
            font-size: 12px;
            font-weight: 600;
            margin: 20px 0;
        }
        .divider-line::before, .divider-line::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }
        .divider-line span {
            padding: 0 12px;
        }

        .text-orange-link {
            color: var(--primary-orange) !important;
            font-weight: 700;
            text-decoration: none;
        }
        .text-orange-link:hover {
            text-decoration: underline;
        }

        /* Footer Credits Styling */
        .account-footer-credits {
            margin-top: 15px;
            margin-bottom: 20px;
            text-align: center;
        }
        .btn-credits-trigger {
            background: rgba(234, 88, 12, 0.08);
            border: 1px solid rgba(234, 88, 12, 0.25);
            color: #c2410c;
            font-size: 13px;
            font-weight: 700;
            padding: 8px 18px;
            border-radius: 20px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        .btn-credits-trigger:hover {
            background: #ea580c;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(234, 88, 12, 0.3);
        }

        /* ─── Premium Credits Modal Styling ─── */
        .credits-modal-content {
            border-radius: 20px;
            border: none;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .credits-modal-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            padding: 24px 28px;
            border: none;
        }
        .dev-member-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px 16px;
            text-align: center;
            transition: all 0.25s ease;
            height: 100%;
        }
        .dev-member-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -6px rgba(234, 88, 12, 0.15);
            border-color: #fdba74;
            background: #ffffff;
        }
        .dev-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ea580c;
            box-shadow: 0 4px 12px rgba(234, 88, 12, 0.25);
            margin: 0 auto 12px;
            display: block;
        }
    </style>
</head>

<body class="account-page">
    <div class="account-container">
        @yield('content')
    </div>

    <!-- Development Team Credits Trigger Link -->
    <div class="account-footer-credits">
        <button type="button" class="btn-credits-trigger" data-bs-toggle="modal" data-bs-target="#devCreditsModal">
            <i class="fas fa-code"></i> Development Team Credits
        </button>
    </div>

    <!-- ─── Development Team Credits Modal ─── -->
    <div class="modal fade" id="devCreditsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content credits-modal-content">
                <div class="credits-modal-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="modal-title fw-bold text-white mb-1">
                            <i class="fas fa-code-branch text-warning me-2"></i> BacsayMedSys Development Team
                        </h4>
                        <p class="text-slate-300 small mb-0" style="color: #cbd5e1;">
                            Barangay Bacsay Health Center Medical Record System — Capstone Project
                        </p>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4" style="background: #faf6f0;">
                    <!-- Project Info Banner -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center bg-white p-3 rounded-3 border border-warning mb-4 shadow-sm">
                        <div class="d-flex align-items-center gap-2 mb-2 mb-md-0">
                            <span class="badge bg-warning-subtle text-warning-emphasis p-2 rounded-circle fs-5" style="color: #ea580c !important;">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                            <div>
                                <div class="fw-bold text-dark" style="font-size: 13px;">Development Started</div>
                                <div class="text-muted small">August 05, 2026 (08/05/2026)</div>
                            </div>
                        </div>

                        <!-- Tech Stack Badges -->
                        <div class="d-flex flex-wrap gap-1 align-items-center">
                            <span class="badge bg-dark text-white">PHP 8.2</span>
                            <span class="badge bg-danger">Laravel 11</span>
                            <span class="badge bg-primary">MySQL</span>
                            <span class="badge bg-info text-white">JavaScript</span>
                            <span class="badge bg-secondary">Bootstrap 4</span>
                        </div>
                    </div>

                    <!-- 3 Team Members Grid -->
                    <div class="row g-3">
                        <!-- Member 1: MARK CHRISTIAN GAON (Programmer / Lead Developer) -->
                        <div class="col-md-4">
                            <div class="dev-member-card">
                                <img src="{{ asset('assets/img/team/mark_gaon.png') }}" alt="MARK CHRISTIAN GAON" class="dev-avatar">
                                <h6 class="fw-bold text-dark mb-1">MARK CHRISTIAN GAON</h6>
                                <span class="badge bg-danger-subtle text-danger border border-danger fw-bold mb-2" style="font-size: 11px;">
                                    Lead Programmer
                                </span>
                                <p class="text-secondary small mb-0" style="font-size: 11.5px; line-height: 1.4;">
                                    Core System Logic, Laravel Backend Architecture, Database Schema & API Integration
                                </p>
                            </div>
                        </div>

                        <!-- Member 2: ARMIE VELASCO (Project Lead & UI/UX Designer) -->
                        <div class="col-md-4">
                            <div class="dev-member-card">
                                <img src="{{ asset('assets/img/team/armie_velasco.jpg') }}" alt="ARMIE VELASCO" class="dev-avatar">
                                <h6 class="fw-bold text-dark mb-1">ARMIE VELASCO</h6>
                                <span class="badge bg-primary-subtle text-primary border border-primary fw-bold mb-2" style="font-size: 11px;">
                                    Project Lead & UI/UX Designer
                                </span>
                                <p class="text-secondary small mb-0" style="font-size: 11.5px; line-height: 1.4;">
                                    System Interface Design, User Flow Optimization & Capstone Project Management
                                </p>
                            </div>
                        </div>

                        <!-- Member 3: JOCEL ROSE TORDA (QA & Technical Documentation) -->
                        <div class="col-md-4">
                            <div class="dev-member-card">
                                <img src="{{ asset('assets/img/team/jocel_torda.png') }}" alt="JOCEL ROSE TORDA" class="dev-avatar">
                                <h6 class="fw-bold text-dark mb-1">JOCEL ROSE TORDA</h6>
                                <span class="badge bg-success-subtle text-success border border-success fw-bold mb-2" style="font-size: 11px;">
                                    QA & Technical Documentation
                                </span>
                                <p class="text-secondary small mb-0" style="font-size: 11.5px; line-height: 1.4;">
                                    System Quality Assurance, Functional Testing & Capstone Technical Documentation
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-white border-top justify-content-between">
                    <span class="small text-muted">
                        © 2026 <strong>BacsayMedSys</strong> Capstone Project. All Rights Reserved.
                    </span>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    @yield('script')
</body>
</html>