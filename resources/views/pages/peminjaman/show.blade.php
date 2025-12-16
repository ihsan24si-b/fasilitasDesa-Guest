@extends('layouts.app')

@section('title', 'Detail Booking #' . $peminjaman->kode_booking)

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold">Detail Booking</h2>
            <p class="mb-0 text-muted">Kode Referensi: <span class="fw-bold text-dark">#{{ $peminjaman->kode_booking }}</span></p>
        </div>
        <a href="{{ route('pages.peminjaman.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- LOGIKA LAYOUT: Jika Admin, Kolom Kiri col-lg-8. Jika Warga, Full Width (col-12) --}}
    @php
        $isAdmin = in_array(Auth::user()->role, ['Super Admin', 'Admin', 'Petugas']);
    @endphp

    <div class="row g-4">
        
        {{-- KOLOM INFO UTAMA --}}
        <div class="{{ $isAdmin ? 'col-lg-8' : 'col-12' }}">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0 text-primary"><i class="fas fa-info-circle me-2"></i>Informasi Peminjaman</h5>
                </div>
                <div class="card-body p-4">
                    
                    {{-- Status Badge Besar --}}
                    <div class="mb-4 text-center">
                        @php
                            $badgeColor = match($peminjaman->status) {
                                'pending' => 'warning',
                                'disetujui' => 'primary',
                                'selesai' => 'success',
                                'ditolak' => 'danger',
                                'dibatalkan' => 'secondary',
                                default => 'secondary',
                            };
                        @endphp
                        <span class="badge bg-{{ $badgeColor }} fs-5 px-4 py-2 rounded-pill shadow-sm">
                            {{ strtoupper($peminjaman->status) }}
                        </span>
                        
                        {{-- Pesan Khusus Warga --}}
                        @if(!$isAdmin && $peminjaman->status == 'pending')
                            <p class="text-muted small mt-2">Mohon menunggu, Admin sedang meninjau pengajuan Anda.</p>
                        @elseif(!$isAdmin && $peminjaman->status == 'disetujui')
                            <p class="text-success small mt-2 fw-bold">Pengajuan disetujui! Silakan gunakan fasilitas sesuai jadwal.</p>
                        @endif
                    </div>

                    <div class="row gy-3">
                        <div class="col-sm-4 text-muted fw-bold">Fasilitas</div>
                        <div class="col-sm-8 text-dark fw-bold">{{ $peminjaman->fasilitas->nama }}</div>

                        <div class="col-sm-4 text-muted fw-bold">Penyewa</div>
                        <div class="col-sm-8">
                            {{ $peminjaman->warga->nama }} <br>
                            <small class="text-muted"><i class="fas fa-phone-alt me-1"></i> {{ $peminjaman->warga->telp }}</small>
                        </div>

                        <div class="col-sm-4 text-muted fw-bold">Tanggal Sewa</div>
                        <div class="col-sm-8">
                            <i class="far fa-calendar-alt me-1"></i> 
                            @if(\Carbon\Carbon::parse($peminjaman->tanggal_mulai)->isSameDay($peminjaman->tanggal_selesai))
                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->format('d F Y') }}
                                <br><small class="text-muted">({{ \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->format('H:i') }})</small>
                            @else
                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->format('d M Y') }}
                            @endif
                        </div>

                        <div class="col-sm-4 text-muted fw-bold">Tujuan</div>
                        <div class="col-sm-8 fst-italic">"{{ $peminjaman->tujuan }}"</div>

                        <div class="col-sm-4 text-muted fw-bold">Total Biaya</div>
                        <div class="col-sm-8 fw-bold text-success fs-5">
                            Rp {{ number_format($peminjaman->total_biaya, 0, ',', '.') }}
                        </div>
                    </div>

                    <hr class="my-4">

                    {{-- Info Pembayaran --}}
                    <h6 class="fw-bold mb-3"><i class="fas fa-wallet me-2"></i>Status Pembayaran</h6>
                    @if($peminjaman->pembayaran)
                        <div class="alert alert-success d-flex align-items-center border-0 shadow-sm">
                            <i class="fas fa-check-circle fa-2x me-3"></i>
                            <div>
                                <h6 class="mb-0 fw-bold">SUDAH LUNAS</h6>
                                <small>Dibayar pada {{ $peminjaman->pembayaran->tgl_bayar->format('d F Y') }} via {{ $peminjaman->pembayaran->metode }}</small>
                            </div>
                        </div>
                    @elseif($peminjaman->total_biaya == 0)
                        <div class="alert alert-info border-0 shadow-sm"><i class="fas fa-gift me-2"></i> Fasilitas ini <b>GRATIS</b>.</div>
                    @else
                        <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                            <div>
                                <h6 class="mb-0 fw-bold">BELUM LUNAS</h6>
                                <small>Harap segera lakukan pembayaran.</small>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            {{-- DOKUMEN / BUKTI --}}
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0 text-primary"><i class="fas fa-folder-open me-2"></i>Dokumen / Bukti Bayar</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        @forelse ($peminjaman->media as $media)
                            <div class="col-md-4 col-6">
                                <div class="card h-100 border shadow-sm overflow-hidden">
                                    <a href="{{ asset('storage/' . $media->file_name) }}" target="_blank">
                                        @if(in_array(pathinfo($media->file_name, PATHINFO_EXTENSION), ['jpg','jpeg','png','webp']))
                                            <img src="{{ asset('storage/' . $media->file_name) }}" class="card-img-top" style="height: 120px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center text-secondary" style="height: 120px;">
                                                <i class="fas fa-file-alt fa-3x"></i>
                                            </div>
                                        @endif
                                    </a>
                                    <div class="card-footer bg-white border-top-0 text-center p-2">
                                        <a href="{{ asset('storage/' . $media->file_name) }}" class="btn btn-sm btn-outline-primary w-100" download>
                                            <i class="fas fa-download me-1"></i> Unduh
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center text-muted py-3">
                                <i class="fas fa-file-excel fa-2x mb-2 opacity-50"></i>
                                <p class="mb-0 small">Tidak ada dokumen dilampirkan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: PANEL AKSI (HANYA MUNCUL JIKA ADMIN) --}}
        @if($isAdmin)
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top" style="top: 100px; z-index: 10;">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Panel Aksi Admin</h5>
                </div>
                <div class="card-body p-4">
                    
                    {{-- 1. Tombol Shortcut Bayar --}}
                    @if(!$peminjaman->pembayaran && $peminjaman->total_biaya > 0 && !in_array($peminjaman->status, ['ditolak', 'dibatalkan']))
                        <div class="d-grid mb-3">
                            <a href="{{ route('pages.pembayaran.create') }}" class="btn btn-warning fw-bold text-dark py-2 shadow-sm">
                                <i class="fas fa-cash-register me-2"></i>Catat Pembayaran
                            </a>
                        </div>
                        <hr>
                    @endif

                    {{-- 2. Form Update Status --}}
                    <form action="{{ route('pages.peminjaman.update-status', $peminjaman->pinjam_id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="d-grid gap-2">
                            @if($peminjaman->status == 'pending')
                                <button name="status" value="disetujui" class="btn btn-success fw-bold py-2">
                                    <i class="fas fa-check me-2"></i>Setujui Pengajuan
                                </button>
                                <button name="status" value="ditolak" class="btn btn-danger fw-bold py-2">
                                    <i class="fas fa-times me-2"></i>Tolak Pengajuan
                                </button>
                            
                            @elseif($peminjaman->status == 'disetujui')
                                <button name="status" value="selesai" class="btn btn-primary fw-bold py-2">
                                    <i class="fas fa-flag-checkered me-2"></i>Tandai Selesai
                                </button>
                                <button name="status" value="dibatalkan" class="btn btn-secondary fw-bold py-2">
                                    <i class="fas fa-ban me-2"></i>Batalkan
                                </button>
                            
                            @else
                                <div class="alert alert-secondary text-center small mb-0">
                                    <i class="fas fa-lock me-1"></i> Status Terkunci.
                                </div>
                            @endif
                        </div>
                    </form>

                    <hr class="my-4">

                    {{-- 3. Hapus Permanen --}}
                    <form action="{{ route('pages.peminjaman.destroy', $peminjaman->pinjam_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100 btn-sm" 
                                onclick="return confirm('Yakin ingin menghapus data ini selamanya?')">
                            <i class="fas fa-trash-alt me-2"></i>Hapus Data Permanen
                        </button>
                    </form>

                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection