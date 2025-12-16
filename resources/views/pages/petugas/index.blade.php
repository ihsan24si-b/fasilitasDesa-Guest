@extends('layouts.app')

@section('title', 'Data Petugas Fasilitas')

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- HEADER SECTION --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold"><i class="fas fa-id-badge me-2"></i>Petugas Fasilitas</h2>
            <p class="mb-0 text-muted">Manajemen personel dan pengelola fasilitas desa.</p>
        </div>
        <a href="{{ route('pages.petugas.create') }}" class="btn btn-primary rounded-pill shadow-sm">
            <i class="fas fa-user-plus me-2"></i>Tambah Petugas
        </a>
    </div>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FILTER CARD --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('pages.petugas.index') }}">
                <div class="row g-2 align-items-center">
                    
                    {{-- 1. Search --}}
                    <div class="col-lg-3 col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control bg-light border-start-0" 
                                   placeholder="Cari nama petugas..." value="{{ request('search') }}">
                        </div>
                    </div>

                    {{-- 2. Filter Fasilitas --}}
                    <div class="col-lg-3 col-md-3">
                        <select name="fasilitas_id" class="form-select bg-light" onchange="this.form.submit()">
                            <option value="">-- Lokasi Tugas --</option>
                            @foreach ($allFasilitas as $f)
                                <option value="{{ $f->fasilitas_id }}" {{ request('fasilitas_id') == $f->fasilitas_id ? 'selected' : '' }}>
                                    {{ $f->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- 3. Filter Peran --}}
                    <div class="col-lg-3 col-md-3">
                        <select name="peran" class="form-select bg-light" onchange="this.form.submit()">
                            <option value="">-- Jabatan --</option>
                            @foreach(['Penanggung Jawab', 'Operasional', 'Keamanan', 'Kebersihan'] as $role)
                                <option value="{{ $role }}" {{ request('peran') == $role ? 'selected' : '' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- 4. Actions --}}
                    <div class="col-lg-3 col-md-12 d-flex gap-2 justify-content-end">
                        <a href="{{ route('pages.petugas.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-sync-alt me-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- GRID CARD PETUGAS --}}
    <div class="row g-4">
        @forelse ($petugas as $p)
            @php
                // Tentukan Warna Berdasarkan Jabatan
                $roleColor = match($p->peran) {
                    'Penanggung Jawab' => 'primary',
                    'Keamanan' => 'dark',
                    'Kebersihan' => 'success',
                    'Operasional' => 'info',
                    default => 'secondary',
                };
            @endphp

            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm hover-up overflow-hidden">
                    
                    {{-- HEADER WARNA (JABATAN) --}}
                    <div class="bg-{{ $roleColor }} text-white text-center py-2 fw-bold small text-uppercase letter-spacing-1">
                        {{ $p->peran }}
                    </div>

                    <div class="card-body text-center pt-4">
                        
                        {{-- Avatar Inisial --}}
                        <div class="avatar-circle mx-auto mb-3 shadow-sm bg-light text-{{ $roleColor }} border border-{{ $roleColor }}">
                            {{ substr($p->warga->nama, 0, 1) }}
                        </div>

                        {{-- Nama & NIK --}}
                        <h5 class="fw-bold mb-1 text-truncate">{{ $p->warga->nama }}</h5>
                        <p class="text-muted small mb-3">NIK: {{ substr($p->warga->no_ktp, 0, 6) }}******</p>

                        {{-- Lokasi Tugas --}}
                        <div class="bg-light rounded p-2 mb-3 border">
                            <small class="text-muted d-block" style="font-size: 0.7rem;">LOKASI TUGAS</small>
                            <span class="fw-semibold text-dark">
                                <i class="fas fa-map-pin me-1 text-danger"></i> {{ $p->fasilitas->nama }}
                            </span>
                        </div>

                        {{-- Tombol WA --}}
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', $p->warga->telp) }}" target="_blank" class="btn btn-outline-success btn-sm w-100 mb-2">
                            <i class="fab fa-whatsapp me-2"></i> Hubungi via WA
                        </a>
                    </div>

                    {{-- FOOTER ACTIONS --}}
                    <div class="card-footer bg-white border-top-0 pt-0 pb-3">
                        <div class="d-flex gap-2">
                            <a href="{{ route('pages.petugas.edit', $p->petugas_id) }}" class="btn btn-sm btn-warning flex-grow-1 text-white">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <form action="{{ route('pages.petugas.destroy', $p->petugas_id) }}" method="POST" class="d-inline flex-grow-1">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Berhentikan petugas ini?')">
                                    <i class="fas fa-user-times me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light text-center py-5 border-dashed">
                    <div class="mb-3">
                        <i class="fas fa-user-slash fa-3x text-muted opacity-50"></i>
                    </div>
                    <h5 class="text-muted">Belum ada data petugas.</h5>
                    <p class="text-muted small mb-3">Silakan tambahkan petugas baru untuk mengelola fasilitas.</p>
                    <a href="{{ route('pages.petugas.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-user-plus me-1"></i> Tambah Petugas
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-between align-items-center mt-4 bg-light p-3 rounded">
        <small class="text-muted">
            Menampilkan {{ $petugas->firstItem() ?? 0 }} - {{ $petugas->lastItem() ?? 0 }} dari {{ $petugas->total() }} data
        </small>
        <div>
            {{ $petugas->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@push('styles')
<style>
    .avatar-circle {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        font-weight: bold;
        text-transform: uppercase;
    }
    .hover-up {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-up:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
    .letter-spacing-1 {
        letter-spacing: 1px;
    }
    .border-dashed {
        border: 2px dashed #dee2e6;
        border-radius: 10px;
    }
</style>
@endpush

@endsection