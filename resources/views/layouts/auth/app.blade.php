<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - {{ config('app.name') }}</title>

    {{-- FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- ICON --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    {{-- CSS guest --}}
    @include('layouts.guest.css')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0D6B68 0%);
            height: 100vh;
            overflow: hidden;
        }

        .login-wrapper {
            max-width: 1000px;
            width: 200%;
            background: #ffffff;
            padding: 40px 35px;
            border-radius: 15px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.12);
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-title {
            font-weight: 700;
            font-size: 28px;
            color: #b0d0ff;
            margin-bottom: 10px;
            text-align: center;
        }

        .login-sub {
            font-size: 14px;
            color: #777;
            margin-bottom: 25px;
            text-align: center;
        }

        .form-control {
            height: 45px;
            border-radius: 10px;
        }

        .btn-login {
            height: 45px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
        }

        .footer-text {
            margin-top: 20px;
            font-size: 13px;
            color: #fff;
            opacity: 0.9;
        }
    </style>
</head>

<body>

    <div class="d-flex justify-content-center align-items-center" style="height:100vh;">
        <div class="login-wrapper">
            @yield('content')
        </div>
    </div>

    {{-- JS guest --}}
    @include('layouts.guest.js')

</body>
</html>
