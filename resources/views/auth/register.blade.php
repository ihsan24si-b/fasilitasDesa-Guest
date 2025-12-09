<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h1>Pendaftaran Pengguna Baru</h1>

    {{-- Tampilkan error validasi dari Controller --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('auth.store') }}">
        @csrf

        <div>
            <label for="name">Nama</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
        </div>

        <div style="margin-top: 10px;">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div style="margin-top: 10px;">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
        </div>

        <div style="margin-top: 10px;">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>

        <div style="margin-top: 20px;">
            <button type="submit">Daftar</button>
        </div>

        <p style="margin-top: 20px;">Sudah punya akun? <a href="{{ route('auth.index') }}">Login di sini</a></p>
    </form>
</body>
</html>
