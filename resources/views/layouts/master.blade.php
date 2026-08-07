<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="BacsayMedSys — Barangay Bacsay Medical Record Management System">
    <meta name="keywords" content="bacsaymedsys, medical records, barangay bacsay, health center, patient management">
    <meta name="author" content="BacsayMedSys">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ ucwords(str_replace('.', ' - ', Route::currentRouteName())) }}</title>

    <!-- Immediate Zero-Flash Dark Mode Script (Executes before DOM render to prevent white flash) -->
    <script>
        (function() {
            var savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
                document.documentElement.classList.add('dark-mode');
            }
        })();
    </script>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        /* Immediate Dark Background to Prevent White Flash (FOUC) */
        html[data-theme="dark"],
        html[data-theme="dark"] body,
        body[data-theme="dark"] {
            background-color: #000000 !important;
            color: #ffffff !important;
        }

        /* Minimalist Global Page Preloader (Glassmorphism Blur Overlay) */
        #global-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 999999;
            background: rgba(241, 245, 249, 0.65);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.25s ease, visibility 0.25s ease;
        }
        html[data-theme="dark"] #global-loader,
        body[data-theme="dark"] #global-loader {
            background: rgba(15, 23, 42, 0.65) !important;
        }
        .loader-glass-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            padding: 20px 28px;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 14px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        html[data-theme="dark"] .loader-glass-card,
        body[data-theme="dark"] .loader-glass-card {
            background: rgba(15, 23, 42, 0.85) !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.4) !important;
        }
        .minimal-ring-spinner {
            width: 36px;
            height: 36px;
            border: 3px solid rgba(2, 132, 199, 0.2);
            border-top: 3px solid #0284c7;
            border-radius: 50%;
            animation: ringSpin 0.75s linear infinite;
        }
        html[data-theme="dark"] .minimal-ring-spinner,
        body[data-theme="dark"] .minimal-ring-spinner {
            border-color: rgba(56, 189, 248, 0.2) !important;
            border-top-color: #38bdf8 !important;
        }
        @keyframes ringSpin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .loader-label-text {
            color: #334155;
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 0.5px;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            margin: 0;
        }
        html[data-theme="dark"] .loader-label-text,
        body[data-theme="dark"] .loader-label-text {
            color: #f1f5f9 !important;
        }
        /* Logo Aspect-Ratio & Proportions */
        .header .header-left .logo img,
        .header .header-left .logo-small img {
            max-height: 34px !important;
            width: auto !important;
            object-fit: contain !important;
        }
        .header-left .logo {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 700;
            font-size: 15px;
            color: #212b36;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 180px;
        }
        .brand-avatar-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
            box-shadow: 0 2px 6px rgba(2, 132, 199, 0.3);
        }

        /* Desktop Mini-Sidebar System (Matches Dreams Template Exactly) */
        @media (min-width: 992px) {
            body.mini-sidebar .sidebar {
                width: 80px !important;
                transition: all 0.2s ease !important;
                overflow: visible !important;
                z-index: 1001 !important;
            }
            body.mini-sidebar .sidebar:hover,
            body.mini-sidebar.expand-menu .sidebar {
                width: 260px !important;
                box-shadow: 4px 0 20px rgba(0, 0, 0, 0.2);
            }
            
            body.mini-sidebar:not(:hover) .sidebar .sidebar-menu ul li a span {
                opacity: 0 !important;
                visibility: hidden !important;
                display: none !important;
            }
            body.mini-sidebar:not(:hover) .sidebar .sidebar-menu ul li a .menu-arrow {
                display: none !important;
            }
            body.mini-sidebar:not(:hover) .sidebar .sidebar-menu ul li.submenu ul {
                display: none !important;
            }

            body.mini-sidebar .sidebar:hover .sidebar-menu ul li a span,
            body.mini-sidebar.expand-menu .sidebar .sidebar-menu ul li a span {
                opacity: 1 !important;
                visibility: visible !important;
                display: inline-block !important;
            }
            body.mini-sidebar .sidebar:hover .sidebar-menu ul li a .menu-arrow,
            body.mini-sidebar.expand-menu .sidebar .sidebar-menu ul li a .menu-arrow {
                display: block !important;
            }

            body.mini-sidebar:not(:hover) .header-left .logo {
                display: none !important;
            }
            body.mini-sidebar:not(:hover) .header-left .logo-small {
                display: block !important;
            }
            body.mini-sidebar:not(:hover) .header-left {
                width: 80px !important;
                justify-content: center !important;
            }
            body.mini-sidebar .page-wrapper {
                margin-left: 80px !important;
                transition: margin-left 0.2s ease !important;
            }
        }
        
        /* Active Sidebar Link Style */
        .sidebar .sidebar-menu > ul > li.active > a {
            background-color: #1b2850 !important;
            color: #ffffff !important;
            border-radius: 8px;
        }
        .sidebar .sidebar-menu > ul > li.active > a img {
            filter: brightness(0) invert(1);
        }

        /* ═══════════════════════════════════════════════════
           TRUE PITCH BLACK DARK MODE SYSTEM (#000000)
           ═══════════════════════════════════════════════════ */
        body[data-theme="dark"],
        body.dark-mode {
            background-color: #000000 !important;
            color: #ffffff !important;
        }
        body[data-theme="dark"] .main-wrapper,
        body[data-theme="dark"] .page-wrapper {
            background-color: #000000 !important;
        }
        body[data-theme="dark"] .header {
            background-color: #0d0d0d !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12) !important;
        }
        body[data-theme="dark"] .header .header-left {
            background-color: #0d0d0d !important;
            border-right: 1px solid rgba(255, 255, 255, 0.12) !important;
            color: #ffffff !important;
        }
        body[data-theme="dark"] .sidebar {
            background-color: #09090b !important;
            border-right: 1px solid rgba(255, 255, 255, 0.12) !important;
        }
        body[data-theme="dark"] .sidebar .slimScrollDiv {
            background-color: #09090b !important;
        }
        body[data-theme="dark"] .sidebar-menu ul li a span,
        body[data-theme="dark"] .sidebar-menu ul li.menu-title span {
            color: #cbd5e1 !important;
        }
        body[data-theme="dark"] .sidebar-menu ul li.submenu ul {
            background-color: #121214 !important;
            border-radius: 6px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        body[data-theme="dark"] .sidebar-menu ul li.submenu ul li a {
            color: #cbd5e1 !important;
        }
        body[data-theme="dark"] .sidebar-menu ul li.submenu ul li a:hover {
            color: #38bdf8 !important;
        }
        body[data-theme="dark"] .sidebar .sidebar-menu > ul > li.active > a {
            background-color: #18181b !important;
            color: #38bdf8 !important;
            border-left: 3px solid #38bdf8;
        }

        /* Pure Black Cards & Elevated Panels */
        body[data-theme="dark"] .card,
        body[data-theme="dark"] .dash-widget,
        body[data-theme="dark"] .dash-count {
            background-color: #121214 !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.6) !important;
        }
        body[data-theme="dark"] .dash-widgetcontent h5,
        body[data-theme="dark"] .dash-counts h4,
        body[data-theme="dark"] .card-title,
        body[data-theme="dark"] h1, body[data-theme="dark"] h2, body[data-theme="dark"] h3, 
        body[data-theme="dark"] h4, body[data-theme="dark"] h5, body[data-theme="dark"] h6 {
            color: #ffffff !important;
        }
        body[data-theme="dark"] .dash-widgetcontent h6,
        body[data-theme="dark"] .dash-counts h5,
        body[data-theme="dark"] .card-header span,
        body[data-theme="dark"] p {
            color: #cbd5e1 !important;
        }

        /* High Contrast Chart Text & Axis Labels */
        body[data-theme="dark"] .apexcharts-text tspan,
        body[data-theme="dark"] .apexcharts-xaxis-label,
        body[data-theme="dark"] .apexcharts-yaxis-label,
        body[data-theme="dark"] .apexcharts-xaxis text,
        body[data-theme="dark"] .apexcharts-yaxis text,
        body[data-theme="dark"] .apexcharts-legend-text,
        body[data-theme="dark"] text.apexcharts-yaxis-title-text,
        body[data-theme="dark"] text.apexcharts-xaxis-title-text {
            fill: #e2e8f0 !important;
            color: #e2e8f0 !important;
            font-weight: 600 !important;
        }
        body[data-theme="dark"] .apexcharts-gridline,
        body[data-theme="dark"] .apexcharts-xaxis-tick,
        body[data-theme="dark"] .apexcharts-ycrosshairs,
        body[data-theme="dark"] .apexcharts-xcrosshairs,
        body[data-theme="dark"] line {
            stroke: rgba(255, 255, 255, 0.15) !important;
        }

        /* ═══════════════════════════════════════════════════
           HIGH-CONTRAST GLOBAL TABLE HEADERS & TYPOGRAPHY
           ═══════════════════════════════════════════════════ */
        .table thead th,
        table.dataTable thead th,
        table.dataTable thead td,
        .table-responsive .table thead th,
        .table thead tr th {
            background-color: #f8fafc !important;
            color: #0f172a !important;
            font-size: 12px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            border-bottom: 2px solid #e2e8f0 !important;
            border-top: none !important;
            padding: 12px 16px !important;
            box-shadow: none !important;
        }
        .table tbody tr td,
        table.dataTable tbody tr td {
            color: #334155 !important;
            border-bottom: 1px solid #f1f5f9 !important;
            font-size: 13px !important;
            vertical-align: middle !important;
        }
        .table tbody tr:hover {
            background-color: #f8fafc !important;
        }

        /* High-Contrast Form Labels & Helper Text (Light Mode) */
        label,
        .form-label,
        .form-group label,
        .col-form-label,
        .card-header h4,
        .card-header h5,
        .card-title {
            color: #0f172a !important;
            font-weight: 600 !important;
        }
        label.form-label,
        .form-group label {
            font-size: 13px !important;
            margin-bottom: 6px !important;
            color: #1e293b !important;
        }
        .text-muted,
        small,
        .form-text,
        .page-title h6,
        .sub-title {
            color: #475569 !important;
            font-size: 12px !important;
        }
        .form-control,
        .form-select,
        .select2-container--default .select2-selection--single {
            color: #0f172a !important;
            background-color: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            font-size: 13px !important;
        }
        .form-control:focus,
        .form-select:focus {
            border-color: #0284c7 !important;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15) !important;
        }

        /* DataTables Controls & Pagination (Light Mode) */
        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #cbd5e1 !important;
            border-radius: 6px !important;
            padding: 6px 12px !important;
            font-size: 13px !important;
            color: #0f172a !important;
            background-color: #ffffff !important;
        }
        .dataTables_wrapper .dataTables_info {
            color: #475569 !important;
            font-weight: 500 !important;
            font-size: 12px !important;
        }
        table.dataTable thead .sorting:before,
        table.dataTable thead .sorting_asc:before,
        table.dataTable thead .sorting_desc:before,
        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_desc:after {
            color: #0284c7 !important;
            opacity: 0.8 !important;
        }

        /* High Contrast Badges & Status Chips (Light Mode) */
        .badge-soft-success, .bg-light-success, .badges.bg-lightgreen {
            background-color: rgba(16, 185, 129, 0.12) !important;
            color: #047857 !important;
            font-weight: 600 !important;
            border: 1px solid rgba(16, 185, 129, 0.25) !important;
        }
        .badge-soft-warning, .bg-light-warning, .badges.bg-lightyellow {
            background-color: rgba(245, 158, 11, 0.12) !important;
            color: #b45309 !important;
            font-weight: 600 !important;
            border: 1px solid rgba(245, 158, 11, 0.25) !important;
        }
        .badge-soft-danger, .bg-light-danger, .badges.bg-lightred {
            background-color: rgba(239, 68, 68, 0.12) !important;
            color: #b91c1c !important;
            font-weight: 600 !important;
            border: 1px solid rgba(239, 68, 68, 0.25) !important;
        }
        .badge-soft-info, .bg-light-info, .badges.bg-lightblue {
            background-color: rgba(14, 165, 233, 0.12) !important;
            color: #0369a1 !important;
            font-weight: 600 !important;
            border: 1px solid rgba(14, 165, 233, 0.25) !important;
        }

        /* Outline & Subtle Table ID Badges (Light Mode) */
        .badge.bg-outline-info, .bg-outline-info {
            background-color: rgba(2, 132, 199, 0.1) !important;
            color: #0284c7 !important;
            border: 1px solid rgba(2, 132, 199, 0.35) !important;
            font-weight: 700 !important;
            padding: 5px 10px !important;
        }
        .badge.bg-outline-primary, .bg-outline-primary {
            background-color: rgba(79, 70, 229, 0.1) !important;
            color: #4338ca !important;
            border: 1px solid rgba(79, 70, 229, 0.35) !important;
            font-weight: 700 !important;
            padding: 5px 10px !important;
        }
        .badge.bg-outline-secondary, .bg-outline-secondary {
            background-color: rgba(71, 85, 105, 0.1) !important;
            color: #334155 !important;
            border: 1px solid rgba(71, 85, 105, 0.35) !important;
            font-weight: 700 !important;
            padding: 5px 10px !important;
        }
        .bg-primary-subtle {
            background-color: rgba(79, 70, 229, 0.12) !important;
            color: #4338ca !important;
            font-weight: 700 !important;
            padding: 4px 8px !important;
        }
        .bg-success-subtle {
            background-color: rgba(16, 185, 129, 0.12) !important;
            color: #047857 !important;
            font-weight: 700 !important;
            padding: 4px 8px !important;
        }
        .bg-warning-subtle {
            background-color: rgba(245, 158, 11, 0.12) !important;
            color: #b45309 !important;
            font-weight: 700 !important;
            padding: 4px 8px !important;
        }
        .bg-danger-subtle {
            background-color: rgba(239, 68, 68, 0.12) !important;
            color: #b91c1c !important;
            font-weight: 700 !important;
            padding: 4px 8px !important;
        }
        .badge.bg-light, .bg-light {
            background-color: #f1f5f9 !important;
            color: #1e293b !important;
            border: 1px solid #cbd5e1 !important;
            font-weight: 600 !important;
        }

        /* ═══════════════════════════════════════════════════
           DARK MODE TABLE & FORM CONTRAST OVERRIDES
           ═══════════════════════════════════════════════════ */
        body[data-theme="dark"] .table {
            color: #ffffff !important;
        }
        body[data-theme="dark"] .table thead th,
        body[data-theme="dark"] table.dataTable thead th,
        body[data-theme="dark"] table.dataTable thead td,
        body[data-theme="dark"] .table-responsive .table thead th {
            background-color: #09090b !important;
            color: #f8fafc !important;
            border-bottom: 2px solid rgba(255, 255, 255, 0.15) !important;
        }
        body[data-theme="dark"] .table tbody tr td,
        body[data-theme="dark"] table.dataTable tbody tr td {
            color: #f1f5f9 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        }
        body[data-theme="dark"] .table tbody tr td a {
            color: #38bdf8 !important;
        }
        body[data-theme="dark"] .table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05) !important;
        }
        body[data-theme="dark"] label,
        body[data-theme="dark"] .form-label,
        body[data-theme="dark"] .form-group label,
        body[data-theme="dark"] .col-form-label,
        body[data-theme="dark"] th,
        body[data-theme="dark"] .card-header h4,
        body[data-theme="dark"] .card-header h5,
        body[data-theme="dark"] .card-title {
            color: #f8fafc !important;
        }
        body[data-theme="dark"] .text-muted,
        body[data-theme="dark"] small,
        body[data-theme="dark"] .form-text,
        body[data-theme="dark"] .page-title h6,
        body[data-theme="dark"] .sub-title {
            color: #94a3b8 !important;
        }
        body[data-theme="dark"] .form-group input,
        body[data-theme="dark"] .form-control,
        body[data-theme="dark"] .form-select,
        body[data-theme="dark"] .select2-container--default .select2-selection--single {
            background-color: #18181b !important;
            border: 1px solid rgba(255, 255, 255, 0.18) !important;
            color: #ffffff !important;
        }
        body[data-theme="dark"] .form-group input::placeholder,
        body[data-theme="dark"] .form-control::placeholder {
            color: #64748b !important;
        }
        body[data-theme="dark"] .form-control:focus,
        body[data-theme="dark"] .form-select:focus {
            border-color: #38bdf8 !important;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2) !important;
        }
        body[data-theme="dark"] .dataTables_wrapper .dataTables_filter input,
        body[data-theme="dark"] .dataTables_wrapper .dataTables_length select {
            background-color: #18181b !important;
            border: 1px solid rgba(255, 255, 255, 0.18) !important;
            color: #ffffff !important;
        }
        body[data-theme="dark"] .dataTables_wrapper .dataTables_info {
            color: #94a3b8 !important;
        }
        body[data-theme="dark"] table.dataTable thead .sorting:before,
        body[data-theme="dark"] table.dataTable thead .sorting_asc:before,
        body[data-theme="dark"] table.dataTable thead .sorting_desc:before,
        body[data-theme="dark"] table.dataTable thead .sorting:after,
        body[data-theme="dark"] table.dataTable thead .sorting_asc:after,
        body[data-theme="dark"] table.dataTable thead .sorting_desc:after {
            color: #38bdf8 !important;
            opacity: 0.9 !important;
        }
        body[data-theme="dark"] .badge-soft-success, body[data-theme="dark"] .bg-light-success, body[data-theme="dark"] .badges.bg-lightgreen {
            background-color: rgba(16, 185, 129, 0.2) !important;
            color: #34d399 !important;
        }
        body[data-theme="dark"] .badge-soft-warning, body[data-theme="dark"] .bg-light-warning, body[data-theme="dark"] .badges.bg-lightyellow {
            background-color: rgba(245, 158, 11, 0.2) !important;
            color: #fbbf24 !important;
        }
        body[data-theme="dark"] .badge-soft-danger, body[data-theme="dark"] .bg-light-danger, body[data-theme="dark"] .badges.bg-lightred {
            background-color: rgba(239, 68, 68, 0.2) !important;
            color: #f87171 !important;
        }
        body[data-theme="dark"] .badge-soft-info, body[data-theme="dark"] .bg-light-info, body[data-theme="dark"] .badges.bg-lightblue {
            background-color: rgba(14, 165, 233, 0.2) !important;
            color: #38bdf8 !important;
        }

        /* Dark Mode Outline & Subtle Badges */
        body[data-theme="dark"] .badge.bg-outline-info, body[data-theme="dark"] .bg-outline-info {
            background-color: rgba(56, 189, 248, 0.15) !important;
            color: #38bdf8 !important;
            border: 1px solid rgba(56, 189, 248, 0.35) !important;
            font-weight: 700 !important;
        }
        body[data-theme="dark"] .badge.bg-outline-primary, body[data-theme="dark"] .bg-outline-primary {
            background-color: rgba(129, 140, 248, 0.15) !important;
            color: #818cf8 !important;
            border: 1px solid rgba(129, 140, 248, 0.35) !important;
            font-weight: 700 !important;
        }
        body[data-theme="dark"] .badge.bg-outline-secondary, body[data-theme="dark"] .bg-outline-secondary {
            background-color: rgba(148, 163, 184, 0.15) !important;
            color: #e2e8f0 !important;
            border: 1px solid rgba(148, 163, 184, 0.35) !important;
            font-weight: 700 !important;
        }
        body[data-theme="dark"] .bg-primary-subtle {
            background-color: rgba(129, 140, 248, 0.2) !important;
            color: #a5b4fc !important;
            font-weight: 700 !important;
        }
        body[data-theme="dark"] .bg-success-subtle {
            background-color: rgba(16, 185, 129, 0.2) !important;
            color: #34d399 !important;
            font-weight: 700 !important;
        }
        body[data-theme="dark"] .bg-warning-subtle {
            background-color: rgba(245, 158, 11, 0.2) !important;
            color: #fbbf24 !important;
            font-weight: 700 !important;
        }
        body[data-theme="dark"] .bg-danger-subtle {
            background-color: rgba(239, 68, 68, 0.2) !important;
            color: #f87171 !important;
            font-weight: 700 !important;
        }
        body[data-theme="dark"] .badge.bg-light, body[data-theme="dark"] .bg-light {
            background-color: #18181b !important;
            color: #f1f5f9 !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            font-weight: 600 !important;
        }

        /* Pitch Black Notifications Dropdown */
        body[data-theme="dark"] .notifications {
            background-color: #121214 !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.9) !important;
        }
        body[data-theme="dark"] .topnav-dropdown-header {
            background-color: #18181b !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        body[data-theme="dark"] .topnav-dropdown-header .notification-title {
            color: #ffffff !important;
            font-weight: 600;
        }
        body[data-theme="dark"] .noti-title,
        body[data-theme="dark"] .noti-details {
            color: #f1f5f9 !important;
        }
        body[data-theme="dark"] .notification-time,
        body[data-theme="dark"] .noti-details span {
            color: #94a3b8 !important;
        }
        body[data-theme="dark"] .topnav-dropdown-footer {
            background-color: #18181b !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        body[data-theme="dark"] .topnav-dropdown-footer a {
            color: #38bdf8 !important;
        }

        /* Pitch Black Profile Headings & Set */
        body[data-theme="dark"] .profile-set .profile-content .profile-contentname h2 {
            color: #ffffff !important;
        }
        body[data-theme="dark"] .profile-set .profile-content .profile-contentname h4 {
            color: #94a3b8 !important;
        }

        /* Pitch Black Dropdown & Popovers */
        body[data-theme="dark"] .dropdown-menu {
            background-color: #121214 !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.8) !important;
        }
        body[data-theme="dark"] .dropdown-menu .dropdown-item {
            color: #f1f5f9 !important;
        }
        body[data-theme="dark"] .dropdown-menu .dropdown-item:hover {
            background-color: #18181b !important;
            color: #38bdf8 !important;
        }

        /* ═══════════════════════════════════════════════════
           MODERN COHESIVE CARD COLOR SYSTEM & GRADIENTS
           ═══════════════════════════════════════════════════ */
        .dash-count {
            background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%) !important;
            border-radius: 10px !important;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.25) !important;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .dash-count.das1 {
            background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%) !important;
            border-radius: 10px !important;
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.25) !important;
        }
        .dash-count.das2 {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%) !important;
            border-radius: 10px !important;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.25) !important;
        }
        .dash-count.das3 {
            background: linear-gradient(135deg, #10b981 0%, #047857 100%) !important;
            border-radius: 10px !important;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.25) !important;
        }
        .dash-count:hover {
            transform: translateY(-2px);
        }
        .dash-count .dash-counts h4,
        .dash-count .dash-counts h5 {
            color: #ffffff !important;
        }
        .dash-count .dash-imgs {
            color: rgba(255, 255, 255, 0.9) !important;
        }

        /* Sidebar / Header-Left Logo Display Toggle Rules */
        body:not(.mini-sidebar) .header-left .logo-small {
            display: none !important;
        }
        body.mini-sidebar .header-left .logo {
            display: none !important;
        }
        body.mini-sidebar .header-left .logo-small {
            display: flex !important;
        }

        /* Toggle Icon & Button Styling */
        #dark_mode_toggle,
        #mobile_dark_mode_toggle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        body:not([data-theme="dark"]) #dark_mode_toggle,
        body:not([data-theme="dark"]) #mobile_dark_mode_toggle {
            background-color: #f1f5f9 !important;
            color: #0f172a !important;
            border: 1px solid #e2e8f0;
        }
        body[data-theme="dark"] #dark_mode_toggle,
        body[data-theme="dark"] #mobile_dark_mode_toggle {
            background-color: #18181b !important;
            color: #fbbf24 !important;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 0 10px rgba(251, 191, 36, 0.3);
        }

        .header-action-btn {
            width: 36px !important;
            height: 36px !important;
            border-radius: 50% !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: all 0.2s ease !important;
        }
        body:not([data-theme="dark"]) .header-action-btn {
            background-color: #f1f5f9 !important;
            color: #0f172a !important;
            border: 1px solid #e2e8f0 !important;
        }
        body[data-theme="dark"] .header-action-btn {
            background-color: #18181b !important;
            color: #fbbf24 !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
        }
        body[data-theme="dark"] .header-action-btn .fa-bell,
        body[data-theme="dark"] .header-action-btn .fa-user {
            color: #e2e8f0 !important;
        }

        /* ═══════════════════════════════════════════════════
           BULLETPROOF CUSTOM MOBILE DRAWER SYSTEM (< 992px)
           ═══════════════════════════════════════════════════ */
        @media (max-width: 991.98px) {
            .page-wrapper {
                margin-left: 0 !important;
                padding-top: 60px !important;
            }
            .header {
                height: 60px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                padding: 0 12px !important;
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
                z-index: 1040 !important;
            }
            #custom_mobile_toggle {
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
            }

            
            /* Custom Mobile Sidebar Drawer (Snug 230px Width & Locked Top Header) */
            .sidebar {
                position: fixed !important;
                top: 0 !important;
                bottom: 0 !important;
                left: 0 !important;
                width: 230px !important;
                height: 100vh !important;
                z-index: 1055 !important;
                margin-left: 0 !important;
                transform: translateX(-230px) !important;
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                display: flex !important;
                flex-direction: column !important;
                overflow: hidden !important;
            }
            body.custom-drawer-open .sidebar {
                transform: translateX(0) !important;
                box-shadow: 10px 0 30px rgba(0, 0, 0, 0.5) !important;
            }
            #mobile_sidebar_header {
                height: 56px !important;
                flex-shrink: 0 !important;
            }
            .sidebar .sidebar-inner {
                flex-grow: 1 !important;
                height: calc(100vh - 56px) !important;
                overflow-y: auto !important;
            }
            body[data-theme="dark"] .sidebar-menu ul li a span {
                color: #cbd5e1 !important;
            }

            /* Custom Overlay Backdrop */
            #custom_mobile_overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background-color: rgba(0, 0, 0, 0.6);
                z-index: 1050;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.3s ease;
            }
            body.custom-drawer-open #custom_mobile_overlay {
                opacity: 1;
                pointer-events: auto;
            }
            body[data-theme="dark"] #custom_mobile_overlay {
                background-color: rgba(0, 0, 0, 0.85);
            }
        }
        @media (max-width: 767.98px) {
            .content {
                padding: 15px !important;
            }
            .dash-widget {
                margin-bottom: 15px !important;
            }
        }
    </style>
</head>

<body>
    <!-- Minimalist Global Page Preloader (Glassmorphism Blur Overlay) -->
    <div id="global-loader" style="position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:999999;background:rgba(15,23,42,0.55);backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px);display:flex;align-items:center;justify-content:center;">
        <div class="loader-glass-card">
            <div class="minimal-ring-spinner"></div>
            <p class="loader-label-text">Loading...</p>
        </div>
    </div>

    <!-- Custom Mobile Backdrop Overlay -->
    <div id="custom_mobile_overlay" class="d-lg-none"></div>

    <div class="main-wrapper">
        <div class="header">
            <!-- Desktop Header Left (Hidden on Mobile, Displayed >= 992px) -->
            <div class="header-left active d-none d-lg-flex align-items-center">
                <a href="{{ route('home') }}" class="logo text-decoration-none d-flex align-items-center">
                    <span class="brand-avatar-icon me-2"><i class="fas fa-heartpulse"></i></span>
                    <span class="fw-bold fs-6 brand-logo-text text-dark">Bacsay<span class="text-primary">MedSys</span></span>
                </a>
                <a href="{{ route('home') }}" class="logo-small text-decoration-none d-flex align-items-center justify-content-center">
                    <span class="brand-avatar-icon"><i class="fas fa-heartpulse"></i></span>
                </a>
                <a id="toggle_btn" href="javascript:void(0);">
                </a>
            </div>

            <!-- Custom Mobile Left: Hamburger Toggle Button -->
            <button type="button" id="custom_mobile_toggle" class="btn btn-link text-body p-0 d-lg-none text-decoration-none border-0" aria-label="Open Menu">
                <i class="fas fa-bars fs-4"></i>
            </button>


            <!-- Desktop User Menu (Hidden on Mobile, Displayed >= 992px) -->
            <ul class="nav user-menu d-none d-lg-flex">
                <!-- Dark Mode Toggle Button -->
                <li class="nav-item me-3 d-flex align-items-center">
                    <a href="javascript:void(0);" id="dark_mode_toggle" class="nav-link p-0 d-flex align-items-center justify-content-center" title="Toggle Theme">
                        <i id="theme_icon" class="fas fa-moon" style="font-size: 18px;"></i>
                    </a>
                </li>

                <!-- Flag Nav -->
                <li class="nav-item dropdown has-arrow flag-nav">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);" role="button" title="Philippines (PHP)">
                        <img src="{{ asset('assets/img/flags/ph.svg') }}" alt="PH Flag" height="20" style="border-radius: 2px;">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0);" class="dropdown-item active d-flex align-items-center">
                            <img src="{{ asset('assets/img/flags/ph.svg') }}" alt="" height="16" class="me-2" style="border-radius: 2px;"> Philippines (₱)
                        </a>
                    </div>
                </li>

                <!-- Notification Bell -->
                @php
                    $unreadNotifications = \App\Models\Notification::latest()->take(5)->get();
                    $totalUnreadCount = \App\Models\Notification::where('is_read', false)->count();
                @endphp
                <li class="nav-item dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <img src="{{ asset('assets/img/icons/notification-bing.svg') }}" alt="img">
                        @if($totalUnreadCount > 0)
                            <span class="badge rounded-pill bg-danger">{{ $totalUnreadCount }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="{{ route('notifications.clear') }}" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                @forelse($unreadNotifications as $noti)
                                <li class="notification-message">
                                    <a href="{{ route('notifications.read', $noti->id) }}">
                                        <div class="media d-flex">
                                            <span class="avatar flex-shrink-0 bg-light-primary rounded-circle p-2 text-center me-2">
                                                <i class="fas fa-bell text-primary fs-5"></i>
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details">
                                                    <span class="noti-title">{{ $noti->title }}</span> 
                                                    {{ $noti->message }}
                                                </p>
                                                <p class="noti-time"><span class="notification-time">{{ $noti->created_at ? $noti->created_at->diffForHumans() : 'Just now' }}</span></p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @empty
                                <li class="notification-message p-3 text-center text-muted fs-12">
                                    No new notifications
                                </li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="{{ route('notifications.read', 'all') }}">Mark All as Read</a>
                        </div>
                    </div>
                </li>

                <!-- User Profile Dropdown -->
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <img src="{{ asset('assets/img/profiles/avatar-02.jpg') }}" alt="KBOT User" style="border-radius: 50%;">
                            <span class="status online"></span>
                        </span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <div class="profileset">
                                <span class="user-img"><img src="{{ asset('assets/img/profiles/avatar-02.jpg') }}" alt="KBOT User" style="border-radius: 50%;">
                                    <span class="status online"></span></span>
                                <div class="profilesets">
                                    <h6>{{ Auth::user()->name ?? 'KBOT Admin' }}</h6>
                                    <h5>{{ Auth::user()->role_name ?? 'Admin' }}</h5>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="me-2" data-feather="user"></i>
                                My Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('settings') }}">
                                <i class="me-2" data-feather="settings"></i>Settings</a>
                            <hr class="m-0">
                            <a class="dropdown-item logout pb-0" href="{{ route('logout') }}">
                                <img src="{{ asset('assets/img/icons/log-out.svg') }}" class="me-2" alt="img">Logout
                            </a>
                        </div>
                    </div>
                </li>
            </ul>

            <!-- Mobile Right Actions: Theme Toggle, Notifications, Profile Button (Same Size, NO 3-Dots!) -->
            <div class="d-flex align-items-center gap-2 d-lg-none me-1" style="height: 60px;">
                <!-- Mobile Dark Mode Toggle Button -->
                <a href="javascript:void(0);" id="mobile_dark_mode_toggle" class="header-action-btn text-decoration-none" title="Toggle Theme">
                    <i id="mobile_theme_icon" class="fas fa-moon fs-6"></i>
                </a>

                <!-- Mobile Notification Bell Button -->
                <div class="dropdown">
                    <a href="javascript:void(0);" class="header-action-btn position-relative text-decoration-none" data-bs-toggle="dropdown" title="Notifications">
                        <i class="fas fa-bell fs-6"></i>
                        <span class="badge rounded-pill bg-danger position-absolute" style="top: -2px; right: -2px; font-size: 8px; padding: 2px 4px;">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end notifications p-0">
                        <div class="topnav-dropdown-header p-3 border-bottom">
                            <span class="notification-title fw-bold">Notifications</span>
                        </div>
                        <div class="noti-content p-2">
                            <ul class="notification-list list-unstyled mb-0">
                                <li class="notification-message p-2 border-bottom">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('assets/img/profiles/avatar-02.jpg') }}" alt="KBOT" class="rounded-circle" style="width: 30px; height: 30px;">
                                        <div>
                                            <span class="fw-semibold fs-7 d-block">KBOT System</span>
                                            <span class="text-muted fs-8">Welcome to KBOT Mobile Dashboard!</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Mobile User Profile Menu Button (Replaces 3-dots!) -->
                <div class="dropdown">
                    <a href="javascript:void(0);" class="header-action-btn text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false" title="User Profile">
                        <i class="fas fa-user fs-6"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user-circle me-2"></i>My Profile</a>
                        <a class="dropdown-item" href="{{ route('settings') }}"><i class="fas fa-cog me-2"></i>Settings</a>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                    </div>
                </div>
            </div>
        </div>

        @include('sidebar.sidebar')
        @yield('content')
    </div>

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/script.js') }}?v={{ time() }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // SweetAlert2 Toast Helper for Session Notifications
            @if (session('success'))
                const isDarkSuccess = document.body.getAttribute('data-theme') === 'dark';
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: false,
                    background: isDarkSuccess ? '#121214' : '#ffffff',
                    color: isDarkSuccess ? '#f8fafc' : '#0f172a',
                    iconColor: '#10b981'
                });
            @endif

            @if (session('error'))
                const isDarkError = document.body.getAttribute('data-theme') === 'dark';
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: "{{ session('error') }}",
                    timer: 3500,
                    showConfirmButton: false,
                    background: isDarkError ? '#121214' : '#ffffff',
                    color: isDarkError ? '#f8fafc' : '#0f172a',
                    iconColor: '#ef4444'
                });
            @endif

            // Global Confirmation Dialog Helper
            window.confirmAction = function(options, onConfirm) {
                const isDark = document.body.getAttribute('data-theme') === 'dark';
                Swal.fire({
                    title: options.title || 'Are you sure?',
                    text: options.text || 'This action cannot be undone!',
                    icon: options.icon || 'warning',
                    showCancelButton: true,
                    confirmButtonColor: options.confirmButtonColor || '#38bdf8',
                    cancelButtonColor: isDark ? '#27272a' : '#94a3b8',
                    confirmButtonText: options.confirmButtonText || 'Yes, proceed!',
                    cancelButtonText: options.cancelButtonText || 'Cancel',
                    background: isDark ? '#121214' : '#ffffff',
                    color: isDark ? '#f8fafc' : '#0f172a',
                }).then((result) => {
                    if (result.isConfirmed && typeof onConfirm === 'function') {
                        onConfirm();
                    }
                });
            };
            const toggleBtn = document.getElementById('dark_mode_toggle');
            const mobileToggleBtn = document.getElementById('mobile_dark_mode_toggle');
            const themeIcon = document.getElementById('theme_icon');
            const mobileThemeIcon = document.getElementById('mobile_theme_icon');
            const currentTheme = localStorage.getItem('theme');

            function applyTheme(theme) {
                if (theme === 'dark') {
                    document.body.setAttribute('data-theme', 'dark');
                    document.body.classList.add('dark-mode');
                    if (themeIcon) themeIcon.className = 'fas fa-sun';
                    if (mobileThemeIcon) mobileThemeIcon.className = 'fas fa-sun';
                } else {
                    document.body.setAttribute('data-theme', 'light');
                    document.body.classList.remove('dark-mode');
                    if (themeIcon) themeIcon.className = 'fas fa-moon';
                    if (mobileThemeIcon) mobileThemeIcon.className = 'fas fa-moon';
                }
            }

            if (currentTheme) {
                applyTheme(currentTheme);
            }

            function toggleTheme() {
                let activeTheme = document.body.getAttribute('data-theme');
                let nextTheme = activeTheme === 'dark' ? 'light' : 'dark';
                localStorage.setItem('theme', nextTheme);
                applyTheme(nextTheme);
            }

            if (toggleBtn) toggleBtn.addEventListener('click', toggleTheme);
            if (mobileToggleBtn) mobileToggleBtn.addEventListener('click', toggleTheme);

            // Custom Mobile Drawer Controller
            const customMobileToggle = document.getElementById('custom_mobile_toggle');
            const customMobileOverlay = document.getElementById('custom_mobile_overlay');
            const customMobileCloseBtn = document.getElementById('custom_mobile_close_btn');

            function openCustomDrawer() {
                document.body.classList.add('custom-drawer-open');
                document.body.classList.add('slide-nav');
            }

            function closeCustomDrawer() {
                document.body.classList.remove('custom-drawer-open');
                document.body.classList.remove('slide-nav');
                document.body.classList.remove('menu-opened');
                var wrapper = document.querySelector('.main-wrapper');
                if (wrapper) wrapper.classList.remove('slide-nav');
                var overlay = document.querySelector('.sidebar-overlay');
                if (overlay) overlay.classList.remove('opened');
            }

            if (customMobileToggle) customMobileToggle.addEventListener('click', openCustomDrawer);
            if (customMobileOverlay) customMobileOverlay.addEventListener('click', closeCustomDrawer);
            if (customMobileCloseBtn) customMobileCloseBtn.addEventListener('click', closeCustomDrawer);

            // Delegate click listener for X close button or its child icon
            document.addEventListener('click', function(e) {
                if (e.target.closest('#custom_mobile_close_btn')) {
                    closeCustomDrawer();
                }
            });

            // Global Page Loader Controller & Navigation Transitions
            var loaderElem = document.getElementById('global-loader');

            function showPageLoader() {
                if (loaderElem) {
                    // Override jQuery's fadeOut (which sets display:none inline)
                    loaderElem.style.display = 'flex';
                    loaderElem.style.opacity = '1';
                }
            }

            function hidePageLoader() {
                if (loaderElem) {
                    loaderElem.style.opacity = '0';
                    setTimeout(function() {
                        loaderElem.style.display = 'none';
                    }, 300);
                }
            }

            // Stop the original script.js jQuery fadeOut from interfering
            // by hiding our way after a controlled delay
            if (loaderElem) {
                // Keep loader visible, override any jQuery fadeOut
                loaderElem.style.display = 'flex';
                loaderElem.style.opacity = '1';
            }
            setTimeout(hidePageLoader, 600);
            window.addEventListener('load', function() {
                setTimeout(hidePageLoader, 500);
            });

            // Show Loader on Page Link Click Navigation
            document.addEventListener('click', function(e) {
                var targetLink = e.target.closest('a');
                if (targetLink && targetLink.href) {
                    var href = targetLink.getAttribute('href');
                    var targetAttr = targetLink.getAttribute('target');
                    if (
                        href &&
                        !href.startsWith('#') &&
                        !href.startsWith('javascript:') &&
                        targetAttr !== '_blank' &&
                        !targetLink.hasAttribute('data-bs-toggle') &&
                        !targetLink.hasAttribute('data-bs-dismiss') &&
                        !targetLink.classList.contains('dropdown-item')
                    ) {
                        showPageLoader();
                    }
                }
            });

            // Show Loader on Form Submit
            document.addEventListener('submit', function() {
                showPageLoader();
            });
        });
    </script>
    @yield('script')
    
</body>
</html>