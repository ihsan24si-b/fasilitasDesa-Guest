<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FDPR Admin')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif; /* Upgrade Font */
        }

        :root {
            --primary: #009CFF;
            --primary-gradient: linear-gradient(to right, #009CFF, #007bff);
            --primary-dark: #0072bc;
            --light: #F3F6F9;
            --dark: #191C24;
            --gray: #6c757d;
            --success: #28a745;
            --danger: #e74c3c;
            --border-radius: 12px; /* Lebih rounded */
        }

        body {
            background: linear-gradient(135deg, rgba(0, 78, 146, 0.7) 0%, rgba(0, 4, 40, 0.7) 100%),
                        url('{{ asset('assets/img/gambar.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Upgrade: Card dengan efek Glassmorphism */
        .auth-container {
            background: rgba(255, 255, 255, 0.92); /* Semi transparan */
            padding: 45px 40px;
            border-radius: var(--border-radius);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px); /* Efek blur kaca */
            border: 1px solid rgba(255, 255, 255, 0.5);
            animation: fadeInUp 0.8s ease-out; /* Animasi masuk */
        }

        /* Animasi Masuk */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .app-title {
            text-align: center;
            margin-bottom: 5px;
            color: var(--primary);
            font-size: 32px;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .app-subtitle {
            text-align: center;
            margin-bottom: 30px;
            color: var(--gray);
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: var(--dark);
            font-size: 22px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--dark);
            font-weight: 600;
            font-size: 13px;
        }

        /* Input Group Styles */
        .input-group {
            display: flex;
            align-items: stretch;
            position: relative;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            border-radius: var(--border-radius);
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-right: none;
            border-top-left-radius: var(--border-radius);
            border-bottom-left-radius: var(--border-radius);
            padding: 0 15px;
            color: var(--primary); /* Icon warna primary */
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 45px;
            transition: all 0.3s ease;
        }

        .input-group input {
            width: 100%;
            padding: 14px 15px;
            border: 1px solid #e9ecef;
            border-top-right-radius: var(--border-radius);
            border-bottom-right-radius: var(--border-radius);
            border-left: none;
            font-size: 14px;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
            color: var(--dark);
        }

        /* Efek Focus */
        .input-group:focus-within .input-group-text {
            background-color: #fff;
            border-color: var(--primary);
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--primary);
            background-color: #fff;
            box-shadow: none; /* Hilangkan shadow default */
        }

        .input-group:focus-within {
            box-shadow: 0 0 0 3px rgba(0, 156, 255, 0.15); /* Soft glow */
        }

        /* Error States */
        .input-group input.input-error {
            border-color: var(--danger) !important;
            background-color: #fff5f5 !important;
        }

        .input-group input.input-error + .input-group-text,
        .input-group .input-group-text.input-error-sibling {
            border-color: var(--danger) !important;
            background-color: #fff5f5 !important;
            color: var(--danger);
        }

        /* Standalone Input */
        input:not(.input-group input) {
            width: 100%;
            padding: 14px 15px;
            border: 1px solid #e9ecef;
            border-radius: var(--border-radius);
            font-size: 14px;
            background-color: #f8f9fa;
            transition: 0.3s;
        }

        input:not(.input-group input):focus {
            outline: none;
            border-color: var(--primary);
            background-color: white;
            box-shadow: 0 0 0 3px rgba(0, 156, 255, 0.15);
        }

        small {
            display: block;
            margin-top: 6px;
            color: var(--gray);
            font-size: 12px;
        }

        /* Buttons Upgrade */
        .btn-login, .btn-register {
            width: 100%;
            padding: 14px;
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 6px rgba(0, 156, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .btn-login {
            background: var(--primary-gradient);
        }

        .btn-login:hover {
            background: linear-gradient(to right, #0081d6, #0069d9);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 156, 255, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-register {
            background: #28a745;
            box-shadow: 0 4px 6px rgba(40, 167, 69, 0.2);
        }

        .btn-register:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(40, 167, 69, 0.3);
        }

        /* Alerts */
        .alert {
            padding: 14px 15px;
            margin-bottom: 25px;
            border-radius: var(--border-radius);
            font-size: 13px;
            text-align: left; /* Lebih rapi rata kiri */
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert::before {
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            color: #1e7e34;
            border: 1px solid rgba(40, 167, 69, 0.2);
        }
        .alert-success::before { content: "\f00c"; } /* Icon Check */

        .alert-error {
            background: rgba(231, 76, 60, 0.1);
            color: #c0392b;
            border: 1px solid rgba(231, 76, 60, 0.2);
        }
        .alert-error::before { content: "\f071"; } /* Icon Warning */

        /* Links */
        .auth-link {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px dashed #dee2e6; /* Dashed line lebih halus */
        }

        .auth-link p {
            color: var(--gray);
            font-size: 14px;
        }

        .auth-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .auth-link a:hover {
            color: var(--primary-dark);
            text-decoration: none;
        }

        .text-danger {
            color: var(--danger);
            font-size: 12px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .text-danger::before {
            content: '\f06a';
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
        }

        /* Media Queries */
        @media (max-width: 480px) {
            .auth-container {
                padding: 30px 20px;
            }

            .app-title {
                font-size: 26px;
            }

            body {
                padding: 10px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const body = document.querySelector('body');
            const img = new Image();

            // Load gambar background
            img.src = '{{ asset('assets/img/gambar.png') }}';

            img.onload = function() {
                console.log('Background image loaded successfully');
                // Optional: Tambah efek fadeIn jika gambar selesai diload
            };

            img.onerror = function() {
                console.log('Background image failed to load, using gradient fallback');
                // Gradient fallback yang lebih smooth
                body.style.background = 'linear-gradient(135deg, #009CFF 0%, #004e92 100%)';
            };
        });
    </script>
</head>
<body>
    <div class="auth-container">
        <div class="app-title">
<a href="{{ route('dashboard') }}" class="navbar-brand d-flex d-lg-none me-4">
    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo FDPR" style="height: 40px; width: auto;">
</a>        </div>
        <div class="app-subtitle">Sistem Informasi Fasilitas Desa & Peminjaman Ruang</div>

        @yield('content')
    </div>
</body>
</html>
