@extends('layouts.auth')

@section('title', 'Login Masuk - FDPR')

@section('content')
<div class="auth-header">
    <h1 class="auth-title">Selamat Datang</h1>
    <p class="auth-subtitle">Silakan login untuk mengakses dashboard admin.</p>
</div>

@if (session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
@endif

@if (session('error') || session('login_error'))
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') ?? session('login_error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-error" style="flex-direction: column; align-items: flex-start;">
        <strong>Perhatikan:</strong>
        <ul style="margin-left: 20px; margin-top: 5px;">
            @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('pages.auth.login') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="email" class="form-label">Email Address</label>
        <div class="input-wrapper">
            <input type="email" 
                   id="email" 
                   name="email" 
                   class="form-control" 
                   placeholder="Masukkan email anda" 
                   value="{{ old('email') }}" 
                   required autofocus>
            <i class="fas fa-envelope"></i>
        </div>
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <div class="input-wrapper">
            <input type="password" 
                   id="password" 
                   name="password" 
                   class="form-control" 
                   placeholder="Masukkan password" 
                   required>
            <i class="fas fa-lock"></i>
        </div>
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn-primary">
        Masuk Dashboard <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
    </button>
</form>

<div class="auth-footer" style="margin-top: 20px; border-top: 1px solid #f1f5f9; padding-top: 20px;">
    <p>Belum memiliki akun admin? <br>
    {{-- PERBAIKAN DI SINI: Gunakan route('register') --}}
    <a href="{{ route('register') }}">Daftar akun baru di sini</a></p>
</div>
@endsection