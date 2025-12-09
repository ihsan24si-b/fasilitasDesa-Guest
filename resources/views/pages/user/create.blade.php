@extends('layouts.guest.app')

@section('title', 'Tambah User')

@section('content')
<div class="container-fluid pt-4 px-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1"><i data-feather="user-plus"></i> Tambah User</h2>
            <p class="mb-0">Form untuk menambahkan user baru</p>
        </div>
        <div>
            <a href="{{ route('user.index') }}" class="btn btn-secondary">
                <i data-feather="arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Card Form -->
    <div class="bg-light rounded p-4">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf

            <div class="row g-4">

                <!-- Left -->
                <div class="col-md-6">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select id="role" name="role" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="pelanggan" {{ old('role') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                            <option value="mitra" {{ old('role') == 'mitra' ? 'selected' : '' }}>Mitra</option>
                        </select>
                    </div>

                </div>

                <!-- Right -->
                <div class="col-md-6">

                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               id="password_confirmation" name="password_confirmation" required>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

            </div>

            <!-- Buttons -->
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i data-feather="save"></i> Simpan Data
                </button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary">
                    <i data-feather="x-circle"></i> Batal
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
