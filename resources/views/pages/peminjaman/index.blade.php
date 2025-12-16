@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- HEADER SECTION --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold"><i class="fas fa-calendar-alt me-2"></i>Data Peminjaman</h2>
            <p class="text-muted mb-0">Kelola jadwal dan status permohonan fasilitas desa.</p>
        </div>
        <div>
            <a href="{{ route('pages.peminjaman.create') }}" class="btn btn-primary rounded-pill shadow-sm">
                <i class="fas fa-plus me-2"></i>Buat Peminjaman
            </a>
        </div>
    </div>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FILTER & SEARCH --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('pages.peminjaman.index') }}">
                <div class="row g-2 align-items-center">
                    {{-- Search --}}
                    <div class="col-lg-3 col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control bg-light border-start-0" 
                                   value="{{ request('search') }}" 
                                   placeholder="Cari Kode, Nama, Fasilitas...">
                        </div>
                    </div>

                    {{-- Filter Status --}}
                    <div class="col-lg-2 col-md-3">
                        <select name="status" class="form-select bg-light" onchange="this.form.submit()">
                            <option value="">-- Status --</option>
                            @foreach(['pending', 'disetujui', 'ditolak', 'selesai', 'dibatalkan'] as $st)
                                <option value="{{ $st }}" {{ request('status') == $st ? 'selected' : '' }}>
                                    {{ ucfirst($st) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter Fasilitas --}}
                    <div class="col-lg-3 col-md-3">
                        <select name="fasilitas_id" class="form-select bg-light" onchange="this.form.submit()">
                            <option value="">-- Semua Fasilitas --</option>
                            @foreach ($allFasilitas as $f)
                                <option value="{{ $f->fasilitas_id }}" {{ request('fasilitas_id') == $f->fasilitas_id ? 'selected' : '' }}>
                                    {{ $f->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Actions --}}
                    <div class="col-lg-4 col-md-12 d-flex gap-2 justify-content-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                        <a href="{{ route('pages.peminjaman.index') }}" class="btn btn-outline-secondary"><i class="fas fa-sync-alt"></i> Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- GRID CARD PEMINJAMAN --}}
    <div class="row g-4">
        @forelse ($peminjaman as $item)
            {{-- Tentukan Warna Card Berdasarkan Status --}}
            @php
                $statusColor = match($item->status) {
                    'pending' => 'warning',
                    'disetujui' => 'primary',
                    'selesai' => 'success',
                    'ditolak' => 'danger',
                    'dibatalkan' => 'secondary',
                    default => 'secondary',
                };
                
                $statusIcon = match($item->status) {
                    'pending' => 'fa-clock',
                    'disetujui' => 'fa-check-circle',
                    'selesai' => 'fa-flag-checkered',
                    'ditolak' => 'fa-times-circle',
                    'dibatalkan' => 'fa-ban',
                    default => 'fa-question-circle',
                };
            @endphp

            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm hover-up">
                    
                    {{-- HEADER CARD (Warna Warni Sesuai Status) --}}
                    <div class="card-header bg-{{ $statusColor }} bg-opacity-10 border-0 d-flex justify-content-between align-items-center py-3">
                        <span class="badge bg-{{ $statusColor }} rounded-pill px-3">
                            <i class="fas {{ $statusIcon }} me-1"></i> {{ ucfirst($item->status) }}
                        </span>
                        <small class="text-muted fw-bold">#{{ $item->kode_booking }}</small>
                    </div>

                    <div class="card-body">
                        {{-- Nama Peminjam --}}
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-sm rounded-circle bg-light text-primary d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-truncate" style="max-width: 150px;">{{ $item->warga->nama }}</h6>
                                <small class="text-muted">{{ $item->warga->telp }}</small>
                            </div>
                        </div>

                        <hr class="my-2 opacity-10">

                        {{-- Detail Fasilitas --}}
                        <div class="mb-2">
                            <small class="text-muted d-block">Fasilitas</small>
                            <span class="fw-semibold text-dark"><i class="fas fa-building me-1 text-secondary"></i> {{ $item->fasilitas->nama }}</span>
                        </div>

                        {{-- Tanggal Sewa --}}
                        <div class="bg-light rounded p-2 text-center border">
                            <small class="text-muted d-block mb-1">Tanggal Sewa</small>
                            <span class="fw-bold text-dark">
                                @if(\Carbon\Carbon::parse($item->tanggal_mulai)->isSameDay($item->tanggal_selesai))
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}
                                @else
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M') }} - {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                                @endif
                            </span>
                            <div class="small text-{{ $statusColor }} mt-1">
                                ({{ \Carbon\Carbon::parse($item->tanggal_mulai)->diffInDays($item->tanggal_selesai) + 1 }} Hari)
                            </div>
                        </div>
                    </div>

                    {{-- FOOTER ACTIONS --}}
                    <div class="card-footer bg-white border-top-0 pt-0 pb-3">
                        <div class="d-flex gap-2">
                            <a href="{{ route('pages.peminjaman.show', $item->pinjam_id) }}" class="btn btn-sm btn-outline-info flex-grow-1">
                                Detail
                            </a>
                            
                            {{-- Edit hanya muncul jika status masih Pending --}}
                            @if($item->status == 'pending')
                            <a href="{{ route('pages.peminjaman.edit', $item->pinjam_id) }}" class="btn btn-sm btn-outline-warning flex-grow-1">
                                Edit
                            </a>
                            @endif

                            <form action="{{ route('pages.peminjaman.destroy', $item->pinjam_id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data ini?')" title="Hapus">
                                    <i class="fas fa-trash"></i>
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
                        <i class="fas fa-calendar-times fa-3x text-muted opacity-50"></i>
                    </div>
                    <h5 class="text-muted">Tidak ada data peminjaman.</h5>
                    <p class="text-muted small mb-3">Belum ada warga yang mengajukan sewa fasilitas.</p>
                    <a href="{{ route('pages.peminjaman.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus me-1"></i> Buat Peminjaman
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-between align-items-center mt-4 bg-light p-3 rounded">
        <small class="text-muted">
            Halaman {{ $peminjaman->currentPage() }} dari {{ $peminjaman->lastPage() }}
        </small>
        <div>
            {{ $peminjaman->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@push('styles')
<style>
    .hover-up {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-up:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
    .border-dashed {
        border: 2px dashed #dee2e6;
        border-radius: 10px;
    }
</style>
@endpush

@endsection