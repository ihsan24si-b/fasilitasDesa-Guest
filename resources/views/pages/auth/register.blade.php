@extends('layouts.auth')

@section('title', 'Registrasi Admin - FDPR')

@section('content')
<div class="auth-header">
    <h1 class="auth-title">Buat Akun</h1>
    <p class="auth-subtitle">Daftarkan diri Anda sebagai admin sistem.</p>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-error" style="flex-direction: column; align-items: flex-start;">
        <strong>Terjadi Kesalahan:</strong>
        <ul style="margin-left: 20px; margin-top: 5px;">
            @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('registration_error'))
    <div class="alert alert-error">{{ session('registration_error') }}</div>
@endif

{{-- Route POST tetap menggunakan nama lengkap --}}
<form action="{{ route('pages.auth.register') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="nama" class="form-label">Nama Lengkap</label>
        <div class="input-wrapper">
            <input type="text" id="nama" name="nama" class="form-control" 
                   value="{{ old('nama') }}" placeholder="Contoh: Budi Santoso" required>
            <i class="fas fa-user"></i>
        </div>
        @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label for="email" class="form-label">Alamat Email</label>
        <div class="input-wrapper">
            <input type="email" id="email" name="email" class="form-control" 
                   value="{{ old('email') }}" placeholder="contoh@email.com" required>
            <i class="fas fa-envelope"></i>
        </div>
        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <div class="input-wrapper">
            <input type="password" id="password" name="password" class="form-control" 
                   placeholder="Minimal 8 karakter" required>
            <i class="fas fa-lock"></i>
        </div>
        <small style="color: #94a3b8; font-size: 12px;">Min. 8 karakter, huruf kapital & angka.</small>
        @error('password') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        <label for="confirm_password" class="form-label">Konfirmasi Password</label>
        <div class="input-wrapper">
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" 
                   placeholder="Ulangi password" required>
            <i class="fas fa-check-double"></i>
        </div>
        @error('confirm_password') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn-primary">
        Daftar Sekarang
    </button>
</form>

<div class="auth-footer" style="margin-top: 20px; border-top: 1px solid #f1f5f9; padding-top: 20px;">
    {{-- PERBAIKAN DI SINI: Gunakan route('login') --}}
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
</div>
@endsection