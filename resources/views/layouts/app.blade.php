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
        /* ─── Warm Beige & Orange Theme System ─── */
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
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            position: relative;
        }

        .account-container {
            width: 100%;
            max-width: 1020px;
            margin: 20px;
            background: var(--bg-card);
            border-radius: 24px;
            box-shadow: 0 20px 40px -15px rgba(234, 88, 12, 0.12), 0 0 2px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid rgba(254, 215, 170, 0.6);
        }

        .account-wrapper {
            display: flex;
            flex-wrap: wrap;
            min-height: 620px;
        }

        /* Left Column: Form Area (~50% width) */
        .auth-form-column {
            flex: 1;
            min-width: 320px;
            padding: 44px 48px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Right Column: Hero Panel (~50% width) */
        .auth-hero-column {
            flex: 1;
            min-width: 340px;
            background: linear-gradient(145deg, #fff7ed 0%, #ffedd5 60%, #fed7aa 100%);
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            position: relative;
            margin: 12px;
            border-radius: 20px;
            border: 1px solid rgba(251, 146, 60, 0.3);
            text-align: center;
        }

        /* ─── Floating Inset Label Inputs (Matches Reference Image) ─── */
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

        @media (max-width: 991px) {
            .auth-hero-column {
                display: none;
            }
            .auth-form-column {
                padding: 32px 24px;
            }
        }
    </style>
</head>

<body class="account-page">
    <div class="account-container">
        @yield('content')
    </div>

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    @yield('script')
</body>
</html>