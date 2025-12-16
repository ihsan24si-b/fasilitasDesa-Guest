@extends('layouts.app')

@section('title', 'Edit Petugas')

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold">Edit Petugas</h2>
            <p class="mb-0 text-muted">Perbarui data penugasan atau jabatan.</p>
        </div>
        <a href="{{ route('pages.petugas.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    {{-- MAIN CARD --}}
    <div class="card border-0 shadow-sm" style="max-width: 800px; margin: 0 auto;">
        <div class="card-header bg-warning bg-opacity-10 py-3 border-bottom">
            <h5 class="mb-0 text-dark"><i class="fas fa-user-edit me-2"></i>Edit Data Penugasan</h5>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('pages.petugas.update', $petugas->petugas_id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Fasilitas</label>
                        <select class="form-select bg-light" name="fasilitas_id" required>
                            @foreach ($fasilitas as $f)
                                <option value="{{ $f->fasilitas_id }}" {{ old('fasilitas_id', $petugas->fasilitas_id) == $f->fasilitas_id ? 'selected' : '' }}>
                                    {{ $f->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Warga (Petugas)</label>
                        <select class="form-select bg-light" name="warga_id" required>
                            @foreach ($warga as $w)
                                <option value="{{ $w->warga_id }}" {{ old('warga_id', $petugas->warga_id) == $w->warga_id ? 'selected' : '' }}>
                                    {{ $w->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold d-block mb-3">Peran / Jabatan</label>
                        <div class="row g-3">
                            @foreach(['Penanggung Jawab', 'Operasional', 'Keamanan', 'Kebersihan'] as $idx => $role)
                                <div class="col-md-6">
                                    <input type="radio" class="btn-check" name="peran" id="role_{{ $idx }}" value="{{ $role }}" {{ old('peran', $petugas->peran) == $role ? 'checked' : '' }} required>
                                    <label class="btn btn-outline-light text-dark w-100 p-3 text-start border shadow-sm h-100 d-flex align-items-center" for="role_{{ $idx }}">
                                        <div class="me-3 text-warning">
                                            @if($role == 'Penanggung Jawab') <i class="fas fa-user-tie fa-2x"></i>
                                            @elseif($role == 'Keamanan') <i class="fas fa-shield-alt fa-2x"></i>
                                            @elseif($role == 'Kebersihan') <i class="fas fa-broom fa-2x"></i>
                                            @else <i class="fas fa-cogs fa-2x"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="fw-bold d-block">{{ $role }}</span>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('pages.petugas.index') }}" class="btn btn-light border px-4">Batal</a>
                    <button type="submit" class="btn btn-warning text-white px-4 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
    /* Style untuk Radio Button Card (Edit Mode - Warna Kuning) */
    .btn-check:checked + .btn-outline-light {
        background-color: #fff3cd;
        border-color: #ffc107 !important;
        color: #856404 !important;
    }
    .btn-check:checked + .btn-outline-light .text-warning {
        color: #856404 !important;
    }
</style>
@endsection