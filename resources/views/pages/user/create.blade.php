@extends('layouts.app')

@section('title', 'FDPR - Tambah User')

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold">Tambah User</h2>
            <p class="mb-0 text-muted">Buat akun pengguna baru untuk akses sistem.</p>
        </div>
        <a href="{{ route('pages.user.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    {{-- MAIN CARD --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="mb-0 text-primary"><i class="fas fa-user-plus me-2"></i>Form Registrasi User</h5>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('pages.user.store') }}" method="POST">
                @csrf
                
                <div class="row g-5">
                    {{-- KOLOM KIRI: Identitas --}}
                    <div class="col-lg-6">
                        <h6 class="text-uppercase text-muted fw-bold mb-3 small border-bottom pb-2">Identitas Pengguna</h6>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="card bg-light border-info border-start-4">
                            <div class="card-body p-3">
                                <label for="role" class="form-label fw-bold text-dark">Hak Akses / Role <span class="text-danger">*</span></label>
                                <select class="form-select border-info fw-bold text-dark @error('role') is-invalid @enderror" id="role" name="role" required>
                                    <option value="">-- Pilih Role --</option>
                                    <option value="Super Admin" {{ old('role') == 'Super Admin' ? 'selected' : '' }}>Super Admin (Full Akses)</option>
                                    <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin (Kelola Data)</option>
                                    <option value="User" {{ old('role') == 'User' ? 'selected' : '' }}>User / Warga</option>
                                </select>
                                <div class="form-text text-muted small mt-1">Pilih role dengan bijak sesuai tanggung jawab.</div>
                                @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- KOLOM KANAN: Keamanan --}}
                    <div class="col-lg-6">
                        <h6 class="text-uppercase text-muted fw-bold mb-3 small border-bottom pb-2">Keamanan Akun</h6>

                        <div class="alert alert-info py-2 small mb-3">
                            <i class="fas fa-lock me-1"></i> Gunakan password minimal 8 karakter kombinasi huruf & angka.
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="******" required>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-secondary px-4">Reset</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i>Simpan User
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection