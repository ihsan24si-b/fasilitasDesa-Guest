@extends('layouts.app')

@section('title', 'Riwayat Pembayaran')

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold"><i class="fas fa-file-invoice-dollar me-2"></i>Kas Masuk</h2>
            <p class="mb-0 text-muted">Rekapitulasi pembayaran sewa fasilitas desa.</p>
        </div>
        <a href="{{ route('pages.pembayaran.create') }}" class="btn btn-success shadow-sm rounded-pill">
            <i class="fas fa-plus-circle me-2"></i>Catat Pembayaran
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
            <form method="GET" action="{{ route('pages.pembayaran.index') }}">
                <div class="row g-2 align-items-center">
                    
                    {{-- 1. Search --}}
                    <div class="col-lg-3 col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control bg-light border-start-0" 
                                   value="{{ request('search') }}" 
                                   placeholder="Cari Kode / Nama Penyewa...">
                        </div>
                    </div>

                    {{-- 2. Filter Metode --}}
                    <div class="col-lg-2 col-md-3">
                        <select name="metode" class="form-select bg-light" onchange="this.form.submit()">
                            <option value="">-- Metode --</option>
                            <option value="Tunai" {{ request('metode') == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                            <option value="Transfer" {{ request('metode') == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                        </select>
                    </div>

                    {{-- 3. Filter Tanggal --}}
                    <div class="col-lg-3 col-md-3">
                        <input type="date" name="tanggal" class="form-control bg-light" 
                               value="{{ request('tanggal') }}" onchange="this.form.submit()">
                    </div>

                    {{-- 4. Actions --}}
                    <div class="col-lg-4 col-md-12 d-flex gap-2 justify-content-end">
                        <a href="{{ route('pages.pembayaran.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-sync-alt me-1"></i> Reset Filter
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- GRID CARD PEMBAYARAN --}}
    <div class="row g-4">
        @forelse ($pembayaran as $item)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm hover-lift position-relative">
                    
                    {{-- Badge Metode (Pojok Kanan Atas) --}}
                    <span class="position-absolute top-0 end-0 m-3 badge {{ $item->metode == 'Tunai' ? 'bg-success' : 'bg-primary' }} rounded-pill">
                        {{ $item->metode }}
                    </span>

                    <div class="card-body">
                        {{-- Tanggal --}}
                        <div class="text-muted small mb-1">
                            <i class="far fa-calendar-alt me-1"></i> {{ $item->tgl_bayar->format('d M Y') }}
                        </div>

                        {{-- Nominal Besar --}}
                        <h4 class="fw-bold text-dark mb-3">
                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                        </h4>

                        {{-- Info Penyewa --}}
                        <div class="d-flex align-items-center mb-3 bg-light p-2 rounded">
                            <div class="me-2 text-secondary"><i class="fas fa-user-circle fa-2x"></i></div>
                            <div class="overflow-hidden">
                                <div class="fw-bold text-truncate">{{ $item->peminjaman->warga->nama ?? 'Warga Dihapus' }}</div>
                                <div class="small text-muted text-truncate">{{ $item->peminjaman->fasilitas->nama ?? '-' }}</div>
                            </div>
                        </div>

                        {{-- Kode Booking & Bukti --}}
                        <div class="d-flex justify-content-between align-items-center border-top border-dashed pt-3">
                            <div>
                                <small class="d-block text-muted" style="font-size: 0.7rem;">KODE BOOKING</small>
                                <span class="fw-bold text-primary">{{ $item->peminjaman->kode_booking ?? '-' }}</span>
                            </div>
                            
                            {{-- Thumbnail Bukti Bayar --}}
                            @if($item->media)
                                <a href="{{ asset('storage/resi_pembayaran/' . $item->media->file_name) }}" target="_blank" class="position-relative" title="Lihat Bukti">
                                    <img src="{{ asset('storage/resi_pembayaran/' . $item->media->file_name) }}" 
                                         class="rounded border" 
                                         style="width: 40px; height: 40px; object-fit: cover;"
                                         onerror="this.src='{{ asset('assets/img/placeholder.jpg') }}'">
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger p-1 border border-light">
                                        <span class="visually-hidden">Bukti</span>
                                    </span>
                                </a>
                            @else
                                <span class="text-muted small fst-italic">Tanpa Bukti</span>
                            @endif
                        </div>
                    </div>

                    {{-- Footer Actions --}}
                    <div class="card-footer bg-white border-0 pb-3 pt-0">
                        <div class="d-flex gap-2">
                            <a href="{{ route('pages.pembayaran.edit', $item->bayar_id) }}" class="btn btn-sm btn-outline-warning flex-grow-1">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <form action="{{ route('pages.pembayaran.destroy', $item->bayar_id) }}" method="POST" class="d-inline flex-grow-1">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger w-100" onclick="return confirm('Hapus data pembayaran ini?')">
                                    <i class="fas fa-trash me-1"></i> Hapus
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
                        <i class="fas fa-comment-dollar fa-3x text-muted opacity-50"></i>
                    </div>
                    <h5 class="text-muted">Belum ada data pembayaran.</h5>
                    <p class="text-muted small mb-3">Catat pembayaran baru untuk pemasukan kas desa.</p>
                    <a href="{{ route('pages.pembayaran.create') }}" class="btn btn-sm btn-success rounded-pill">
                        <i class="fas fa-plus me-1"></i> Catat Baru
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-between align-items-center mt-4 bg-light p-3 rounded">
        <small class="text-muted">
            Halaman {{ $pembayaran->currentPage() }} dari {{ $pembayaran->lastPage() }}
        </small>
        <div>
            {{ $pembayaran->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@push('styles')
<style>
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
    .border-dashed {
        border-style: dashed !important;
    }
    .border-dashed-2 {
        border: 2px dashed #dee2e6;
        border-radius: 10px;
    }
</style>
@endpush

@endsection