@extends('layouts.app')

@section('title', 'Tambah Petugas')

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold">Assign Petugas</h2>
            <p class="mb-0 text-muted">Menetapkan warga sebagai pengelola fasilitas desa.</p>
        </div>
        <a href="{{ route('pages.petugas.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- MAIN CARD --}}
    <div class="card border-0 shadow-sm" style="max-width: 800px; margin: 0 auto;">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="mb-0 text-primary"><i class="fas fa-user-tag me-2"></i>Form Penugasan</h5>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('pages.petugas.store') }}" method="POST">
                @csrf
                
                <div class="row g-4">
                    {{-- INFO DASAR --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Pilih Fasilitas <span class="text-danger">*</span></label>
                        <select class="form-select" name="fasilitas_id" required>
                            <option value="">-- Pilih Fasilitas --</option>
                            @foreach ($fasilitas as $f)
                                <option value="{{ $f->fasilitas_id }}" {{ old('fasilitas_id') == $f->fasilitas_id ? 'selected' : '' }}>
                                    {{ $f->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Pilih Warga (Petugas) <span class="text-danger">*</span></label>
                        <select class="form-select" name="warga_id" required>
                            <option value="">-- Pilih Warga --</option>
                            @foreach ($warga as $w)
                                <option value="{{ $w->warga_id }}" {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                    {{ $w->nama }} ({{ $w->pekerjaan ?? 'Warga' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- PILIHAN PERAN (Visual Card) --}}
                    <div class="col-12">
                        <label class="form-label fw-bold d-block mb-3">Pilih Peran / Jabatan <span class="text-danger">*</span></label>
                        <div class="row g-3">
                            @foreach(['Penanggung Jawab', 'Operasional', 'Keamanan', 'Kebersihan'] as $idx => $role)
                                <div class="col-md-6">
                                    <input type="radio" class="btn-check" name="peran" id="role_{{ $idx }}" value="{{ $role }}" {{ old('peran') == $role ? 'checked' : '' }} required>
                                    <label class="btn btn-outline-light text-dark w-100 p-3 text-start border shadow-sm h-100 d-flex align-items-center" for="role_{{ $idx }}">
                                        <div class="me-3 text-primary">
                                            @if($role == 'Penanggung Jawab') <i class="fas fa-user-tie fa-2x"></i>
                                            @elseif($role == 'Keamanan') <i class="fas fa-shield-alt fa-2x"></i>
                                            @elseif($role == 'Kebersihan') <i class="fas fa-broom fa-2x"></i>
                                            @else <i class="fas fa-cogs fa-2x"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="fw-bold d-block">{{ $role }}</span>
                                            <small class="text-muted">Bertugas sebagai {{ strtolower($role) }} fasilitas.</small>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-secondary px-4">Reset</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i>Simpan Data
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
    /* Style untuk Radio Button Card */
    .btn-check:checked + .btn-outline-light {
        background-color: #e7f1ff;
        border-color: #0d6efd !important;
        color: #0d6efd !important;
    }
    .btn-check:checked + .btn-outline-light .text-primary {
        color: #0d6efd !important;
    }
</style>
@endsection