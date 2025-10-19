<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
        }

        button:hover {
            background: #2980b9;
        }

        .alert {
            background: #e74c3c;
            color: white;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login Admin</h2>

        @if (session('error'))
            <div class="alert">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert">
                @foreach ($errors->all() as $error)
                    * {{ $error }} <br>
                @endforeach
            </div>
        @endif

        <form action="{{ url('/auth/login') }}" method="POST">
            @csrf
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" value="{{ old('username') }}">

            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password">

            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
