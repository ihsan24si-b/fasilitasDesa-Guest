@extends('layouts.auth')

@section('title', 'Registrasi - FDPR Admin')

@section('content')
<h2>Registrasi Admin</h2>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-error">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif

@if (session('registration_error'))
    <div class="alert alert-error">
        {{ session('registration_error') }}
    </div>
@endif

<form action="{{ route('pages.auth.register') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        <div class="input-group">
            <span class="input-group-text {{ $errors->has('nama') ? 'input-error-sibling' : '' }}">
                <i class="fas fa-user"></i>
            </span>
            <input type="text"
                   id="nama"
                   name="nama"
                   value="{{ old('nama') }}"
                   placeholder="Masukkan nama lengkap"
                   class="{{ $errors->has('nama') ? 'input-error' : '' }}"
                   required>
        </div>
        @error('nama')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <small>Tidak boleh mengandung angka</small>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <div class="input-group">
            <span class="input-group-text {{ $errors->has('email') ? 'input-error-sibling' : '' }}">
                <i class="fas fa-envelope"></i>
            </span>
            <input type="email"
                   id="email"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="Masukkan email"
                   class="{{ $errors->has('email') ? 'input-error' : '' }}"
                   required>
        </div>
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <small>Email akan digunakan untuk login</small>
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
        <small>Minimal 8 karakter, harus ada huruf kapital dan angka</small>
    </div>

    <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <div class="input-group">
            <span class="input-group-text {{ $errors->has('confirm_password') ? 'input-error-sibling' : '' }}">
                <i class="fas fa-lock"></i>
            </span>
            <input type="password"
                   id="confirm_password"
                   name="confirm_password"
                   placeholder="Konfirmasi password"
                   class="{{ $errors->has('confirm_password') ? 'input-error' : '' }}"
                   required>
        </div>
        @error('confirm_password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn-register">
        <i class="fas fa-user-plus"></i> Daftar
    </button>
</form>

<div class="auth-link">
    <p>Sudah punya akun? <a href="{{ route('pages.auth.index') }}">Login di sini</a></p>
</div>
@endsection
