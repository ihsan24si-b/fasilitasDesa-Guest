@extends('layouts.app')

@section('title', 'Data Petugas Fasilitas')

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold">Petugas Fasilitas</h2>
            <p class="mb-0 text-muted">Manajemen pengelola fasilitas desa.</p>
        </div>
        <a href="{{ route('pages.petugas.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-user-plus me-2"></i>Tambah Petugas
        </a>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="bg-light rounded p-4 shadow-sm">
        
        {{-- FORM FILTER & PENCARIAN --}}
        <form method="GET" action="{{ route('pages.petugas.index') }}" class="mb-4">
            <div class="row g-2">
                
                {{-- 1. Search Bar --}}
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Cari nama petugas..." value="{{ request('search') }}">
                    </div>
                </div>

                {{-- 2. Filter Fasilitas --}}
                <div class="col-md-3">
                    <select name="fasilitas_id" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua Fasilitas --</option>
                        @foreach ($allFasilitas as $f)
                            <option value="{{ $f->fasilitas_id }}" {{ request('fasilitas_id') == $f->fasilitas_id ? 'selected' : '' }}>
                                {{ $f->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- 3. Filter Peran --}}
                <div class="col-md-2">
                    <select name="peran" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua Peran --</option>
                        @foreach(['Penanggung Jawab', 'Operasional', 'Keamanan', 'Kebersihan'] as $role)
                            <option value="{{ $role }}" {{ request('peran') == $role ? 'selected' : '' }}>{{ $role }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- 4. Show Entries (Pagination) --}}
                <div class="col-md-2">
                    <select name="perPage" class="form-select" onchange="this.form.submit()">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>Show 10</option>
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>Show 25</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>Show 50</option>
                    </select>
                </div>

                {{-- 5. Tombol Reset --}}
                <div class="col-md-2">
                    <a href="{{ route('pages.petugas.index') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-sync-alt me-1"></i> Reset
                    </a>
                </div>
            </div>
        </form>

        {{-- Info Showing Data --}}
        <div class="mb-3 text-muted small">
            Menampilkan {{ $petugas->firstItem() ?? 0 }} sampai {{ $petugas->lastItem() ?? 0 }} dari total {{ $petugas->total() }} petugas.
        </div>

        {{-- Tabel Data --}}
        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead class="table-light">
                    <tr class="text-dark">
                        <th class="py-3 ps-3">Nama Petugas</th>
                        <th class="py-3">Fasilitas</th>
                        <th class="py-3">Peran / Jabatan</th>
                        <th class="py-3">Kontak</th>
                        <th class="py-3 text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($petugas as $p)
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold text-dark">{{ $p->warga->nama }}</div>
                            <small class="text-muted">NIK: {{ $p->warga->no_ktp }}</small>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span>{{ $p->fasilitas->nama }}</span>
                            </div>
                        </td>
                        <td>
                            @php
                                $colors = [
                                    'Penanggung Jawab' => 'bg-primary',
                                    'Operasional' => 'bg-info text-dark',
                                    'Keamanan' => 'bg-dark',
                                    'Kebersihan' => 'bg-success'
                                ];
                            @endphp
                            <span class="badge {{ $colors[$p->peran] ?? 'bg-secondary' }} rounded-pill px-3 py-2">
                                {{ $p->peran }}
                            </span>
                        </td>
                        <td>
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $p->warga->telp) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                <i class="fab fa-whatsapp me-1"></i> {{ $p->warga->telp }}
                            </a>
                        </td>
                        <td class="text-end pe-3">
                            <div class="btn-group">
                                {{-- TOMBOL EDIT --}}
                                <a href="{{ route('pages.petugas.edit', $p->petugas_id) }}" class="btn btn-sm btn-warning text-white" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- TOMBOL DELETE --}}
                                <form action="{{ route('pages.petugas.destroy', $p->petugas_id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger rounded-end" onclick="return confirm('Berhentikan petugas ini?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fas fa-user-slash fa-3x mb-3 text-secondary opacity-50"></i>
                            <p class="mb-0">Tidak ada data petugas ditemukan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Links --}}
        <div class="mt-4 d-flex justify-content-end">
            {{ $petugas->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection