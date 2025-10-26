<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FDPR Admin')</title>
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
            background: linear-gradient(135deg, var(--primary) 0%, #0056b3 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .auth-container {
            background: white;
            padding: 40px;
            border-radius: var(--border-radius);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
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

        input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--light);
            border-radius: var(--border-radius);
            font-size: 14px;
            background-color: var(--light);
            transition: 0.3s;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            background-color: white;
        }

        .input-error {
            border-color: var(--danger);
            background-color: rgba(231, 76, 60, 0.05);
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
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="app-title">FDPR</div>
        <div class="app-subtitle">Admin</div>
        @yield('content')
    </div>
</body>
</html>
