@extends('layouts.app')

@section('title', 'FDPR - Edit User')

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold">Edit User</h2>
            <p class="mb-0 text-muted">Perbarui data profil atau hak akses pengguna.</p>
        </div>
        <a href="{{ route('pages.user.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    {{-- MAIN CARD --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning bg-opacity-10 py-3 border-bottom">
            <h5 class="mb-0 text-dark"><i class="fas fa-user-edit me-2"></i>Edit Data: {{ $dataUser->name }}</h5>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('pages.user.update', $dataUser->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-5">
                    {{-- KOLOM KIRI --}}
                    <div class="col-lg-6">
                        <h6 class="text-uppercase text-muted fw-bold mb-3 small border-bottom pb-2">Info Dasar</h6>
                        
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $dataUser->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $dataUser->email) }}" required>
                        </div>

                        <div class="card bg-light border-warning border-start-4">
                            <div class="card-body p-3">
                                <label for="role" class="form-label fw-bold text-dark">Hak Akses / Role</label>
                                <select class="form-select border-warning fw-bold" id="role" name="role" required>
                                    <option value="Super Admin" {{ old('role', $dataUser->role) == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                                    <option value="Admin" {{ old('role', $dataUser->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="User" {{ old('role', $dataUser->role) == 'User' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- KOLOM KANAN: Ubah Password --}}
                    <div class="col-lg-6">
                        <h6 class="text-uppercase text-muted fw-bold mb-3 small border-bottom pb-2">Ubah Password</h6>
                        <div class="alert alert-warning py-2 small mb-3">
                            <i class="fas fa-info-circle me-1"></i> Biarkan kosong jika tidak ingin mengganti password.
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password Baru</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Isi password baru...">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru...">
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('pages.user.index') }}" class="btn btn-light border px-4">Batal</a>
                    <button type="submit" class="btn btn-warning text-white px-4 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection