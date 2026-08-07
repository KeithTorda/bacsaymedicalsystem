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
        /* Modern Centered Auth Layout with Ambient Live Particle Background */
        body.account-page {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: #090d16;
            overflow-x: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            position: relative;
        }

        #particles-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 1;
            pointer-events: none;
        }

        .account-content {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            padding: 24px;
        }

        .auth-card {
            background: rgba(15, 23, 42, 0.82);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 18px;
            padding: 36px 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), 0 0 30px rgba(2, 132, 199, 0.15);
            color: #ffffff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .auth-brand-header {
            text-align: center;
            margin-bottom: 28px;
        }
        .auth-brand-logo {
            width: 56px;
            height: 56px;
            object-fit: contain;
            margin-bottom: 12px;
            filter: drop-shadow(0 4px 10px rgba(2, 132, 199, 0.4));
        }
        .auth-brand-title {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #ffffff;
            margin: 0 0 4px;
        }
        .auth-brand-subtitle {
            font-size: 13px;
            color: #94a3b8;
            margin: 0;
        }

        .auth-card .form-label {
            color: #e2e8f0;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
        }
        .auth-card .form-control {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #ffffff !important;
            border-radius: 10px;
            padding: 11px 16px;
            font-size: 14px;
        }
        .auth-card .form-control:focus {
            background: rgba(30, 41, 59, 0.9);
            border-color: #38bdf8;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
        }
        .auth-card .btn-login {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            border: none;
            color: #ffffff;
            font-weight: 700;
            padding: 12px;
            border-radius: 10px;
            font-size: 15px;
            width: 100%;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.3);
        }
        .auth-card .btn-login:hover {
            background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(56, 189, 248, 0.4);
        }

        .auth-card a {
            color: #38bdf8;
            text-decoration: none;
            font-weight: 600;
        }
        .auth-card a:hover {
            text-decoration: underline;
            color: #7dd3fc;
        }
        .auth-footer-text {
            text-align: center;
            font-size: 13px;
            color: #94a3b8;
            margin-top: 20px;
        }
    </style>
</head>

<body class="account-page">
    <!-- Live Canvas Particle Background -->
    <canvas id="particles-canvas"></canvas>

    <div class="account-content">
        @yield('content')
    </div>

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Interactive Live Particle Canvas Animation Script -->
    <script>
        (function() {
            const canvas = document.getElementById('particles-canvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let width, height;
            let particles = [];

            function resize() {
                width = canvas.width = window.innerWidth;
                height = canvas.height = window.innerHeight;
            }
            window.addEventListener('resize', resize);
            resize();

            const particleCount = Math.min(Math.floor(window.innerWidth / 15), 65);
            for (let i = 0; i < particleCount; i++) {
                particles.push({
                    x: Math.random() * width,
                    y: Math.random() * height,
                    radius: Math.random() * 2 + 1,
                    vx: (Math.random() - 0.5) * 0.4,
                    vy: (Math.random() - 0.5) * 0.4,
                    alpha: Math.random() * 0.5 + 0.2
                });
            }

            function animate() {
                ctx.clearRect(0, 0, width, height);

                // Subtle Radial Medical Blue Background Glow
                const grad = ctx.createRadialGradient(width / 2, height / 2, 50, width / 2, height / 2, Math.max(width, height) * 0.75);
                grad.addColorStop(0, 'rgba(3, 105, 161, 0.22)');
                grad.addColorStop(1, 'rgba(9, 13, 22, 0.95)');
                ctx.fillStyle = grad;
                ctx.fillRect(0, 0, width, height);

                // Render Particles & Connecting Lines
                for (let i = 0; i < particles.length; i++) {
                    let p = particles[i];
                    p.x += p.vx;
                    p.y += p.vy;

                    if (p.x < 0) p.x = width;
                    if (p.x > width) p.x = 0;
                    if (p.y < 0) p.y = height;
                    if (p.y > height) p.y = 0;

                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(56, 189, 248, ${p.alpha})`;
                    ctx.shadowBlur = 8;
                    ctx.shadowColor = '#38bdf8';
                    ctx.fill();
                    ctx.shadowBlur = 0;

                    for (let j = i + 1; j < particles.length; j++) {
                        let p2 = particles[j];
                        let dx = p.x - p2.x;
                        let dy = p.y - p2.y;
                        let dist = Math.sqrt(dx * dx + dy * dy);

                        if (dist < 110) {
                            ctx.beginPath();
                            ctx.moveTo(p.x, p.y);
                            ctx.lineTo(p2.x, p2.y);
                            ctx.strokeStyle = `rgba(56, 189, 248, ${0.15 * (1 - dist / 110)})`;
                            ctx.lineWidth = 0.8;
                            ctx.stroke();
                        }
                    }
                }
                requestAnimationFrame(animate);
            }
            animate();
        })();
    </script>
    @yield('script')
</body>
</html>