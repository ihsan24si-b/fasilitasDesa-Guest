@extends('layouts.auth')

@section('title', 'Login - FDPR Admin')

@section('content')
<h2>Login Admin</h2>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
             {{ $error }}<br>
        @endforeach
    </div>
@endif

@if (session('login_error'))
    <div class="alert alert-error">
        {{ session('login_error') }}
    </div>
@endif

<form action="{{ route('pages.auth.login') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="email">Email</label>
        <div class="input-group">
            <span class="input-group-text {{ $errors->has('email') ? 'input-error-sibling' : '' }}">
                <i class="fas fa-envelope"></i>
            </span>
            <input type="email"
                   id="email"
                   name="email"
                   placeholder="Masukkan email"
                   value="{{ old('email') }}"
                   class="{{ $errors->has('email') ? 'input-error' : '' }}"
                   required>
        </div>
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <div class="input-group">
            <span class="input-group-text {{ $errors->has('password') ? 'input-error-sibling' : '' }}">
                <i class="fas fa-lock"></i>
            </span>
            <input type="password"
                   id="password"
                   name="password"
                   placeholder="Masukkan password"
                   class="{{ $errors->has('password') ? 'input-error' : '' }}"
                   required>
        </div>
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn-login">
        <i class="fas fa-sign-in-alt"></i> Login
    </button>
</form>

<div class="auth-link">
    <p>Belum punya akun? <a href="{{ route('pages.auth.register.form') }}">Daftar di sini</a></p>
</div>
@endsection
