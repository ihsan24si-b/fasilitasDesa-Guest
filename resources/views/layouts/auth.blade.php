<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FDPR Admin')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary: #009CFF;
            --primary-dark: #0081d6;
            --light: #F3F6F9;
            --dark: #191C24;
            --gray: #6c757d;
            --success: #28a745;
            --danger: #e74c3c;
            --border-radius: 8px;
        }

        body {
            background: linear-gradient(135deg, rgba(0, 156, 255, 0.4) 0%, rgba(0, 86, 179, 0.4) 100%),
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
        }

        /* Overlay yang lebih transparan */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
            z-index: -1;
        }

        .auth-container {
            background: white;
            padding: 40px;
            border-radius: var(--border-radius);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(1px);
        }

        .app-title {
            text-align: center;
            margin-bottom: 10px;
            color: var(--primary);
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .app-subtitle {
            text-align: center;
            margin-bottom: 25px;
            color: var(--gray);
            font-size: 14px;
            font-weight: 400;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: var(--dark);
            font-size: 24px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--dark);
            font-weight: 500;
            font-size: 14px;
        }

        /* Input Group Styles untuk Icon */
        .input-group {
            display: flex;
            align-items: center;
            position: relative;
        }

        .input-group-text {
            background-color: var(--light);
            border: 2px solid var(--light);
            border-right: none;
            border-radius: var(--border-radius) 0 0 var(--border-radius);
            padding: 12px 15px;
            color: var(--gray);
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 50px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--light);
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
            border-left: none;
            font-size: 14px;
            background-color: var(--light);
            transition: 0.3s;
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--primary);
            background-color: white;
            border-left: none;
        }

        /* [PENYESUAIAN] Style error untuk input di dalam input-group */
        .input-group input.input-error {
            border-color: var(--danger) !important;
            background-color: rgba(231, 76, 60, 0.05) !important;
            border-left: none;
        }

        /* [PENYESUAIAN] Style error untuk icon-span saat input error */
        .input-group input.input-error + .input-group-text,
        .input-group .input-group-text.input-error-sibling {
            border-color: var(--danger) !important;
            background-color: rgba(231, 76, 60, 0.05) !important;
        }

        /* (Gaya ini masih diperlukan untuk input yang MUNGKIN tidak pakai icon) */
        input.input-error {
            border-color: var(--danger) !important;
            background-color: rgba(231, 76, 60, 0.05) !important;
        }

        /* Style untuk input tanpa icon (fallback) */
        input:not(.input-group input) {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--light);
            border-radius: var(--border-radius);
            font-size: 14px;
            background-color: var(--light);
            transition: 0.3s;
        }

        input:not(.input-group input):focus {
            outline: none;
            border-color: var(--primary);
            background-color: white;
        }

        small {
            display: block;
            margin-top: 5px;
            color: var(--gray);
            font-size: 12px;
        }

        .btn-login, .btn-register {
            width: 100%;
            padding: 12px;
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-login {
            background: var(--primary);
        }

        .btn-login:hover {
            background: var(--primary-dark);
        }

        .btn-register {
            background: var(--success);
        }

        .btn-register:hover {
            background: #218838;
        }

        .alert {
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: var(--border-radius);
            font-size: 14px;
            text-align: center;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success);
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .alert-error {
            background: rgba(231, 76, 60, 0.1);
            color: var(--danger);
            border: 1px solid rgba(231, 76, 60, 0.2);
        }

        .auth-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid var(--light);
        }

        .auth-link p {
            color: var(--gray);
            font-size: 14px;
        }

        .auth-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .auth-link a:hover {
            text-decoration: underline;
        }

        .text-danger {
            color: var(--danger);
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        /* Fallback jika gambar tidak ditemukan */
        .auth-container {
            background: white;
        }

        @media (max-width: 480px) {
            .auth-container {
                padding: 30px 25px;
            }

            .app-title {
                font-size: 24px;
            }

            h2 {
                font-size: 22px;
            }

            body {
                padding: 15px;
                background-attachment: scroll;
            }
        }

        /* Untuk perangkat dengan layar sangat kecil */
        @media (max-width: 320px) {
            .auth-container {
                padding: 20px 15px;
            }

            .input-group-text {
                min-width: 45px;
                padding: 12px 12px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const body = document.querySelector('body');
            const img = new Image();

            img.src = '{{ asset('assets/img/gambar.png') }}';

            img.onload = function() {
                console.log('Background image loaded successfully');
            };

            img.onerror = function() {
                console.log('Background image failed to load, using gradient fallback');
                body.style.background = 'linear-gradient(135deg, rgba(0, 156, 255, 0.6) 0%, rgba(0, 86, 179, 0.6) 100%)';
            };
        });
    </script>
</head>
<body>
    <div class="auth-container">
        <div class="app-title">FDPR</div>
        <div class="app-subtitle">Fasilitas Desa dan Peminjaman Ruang</div>
        @yield('content')
    </div>
</body>
</html>
