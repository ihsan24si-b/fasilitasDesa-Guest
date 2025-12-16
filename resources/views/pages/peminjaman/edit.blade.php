@extends('layouts.app')

@section('title', 'Edit Peminjaman')

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold">Edit Booking</h2>
            <p class="mb-0 text-muted">Perbarui data atau status peminjaman.</p>
        </div>
        <a href="{{ route('pages.peminjaman.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    {{-- MAIN CARD --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning bg-opacity-10 py-3">
            <h5 class="mb-0 text-dark"><i class="fas fa-edit me-2"></i>Form Edit Booking</h5>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('pages.peminjaman.update', $peminjaman->pinjam_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-5">
                    {{-- KOLOM KIRI: INFO DASAR --}}
                    <div class="col-lg-6">
                        <h6 class="text-uppercase text-muted fw-bold mb-3 small border-bottom pb-2">Informasi Peminjam</h6>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Peminjam</label>
                            <select class="form-select bg-light" name="warga_id" required>
                                @foreach ($warga as $w)
                                    <option value="{{ $w->warga_id }}" {{ old('warga_id', $peminjaman->warga_id) == $w->warga_id ? 'selected' : '' }}>
                                        {{ $w->nama }} ({{ $w->nik ?? 'NIK tidak ada' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Fasilitas</label>
                            <select class="form-select bg-light" name="fasilitas_id" required>
                                @foreach ($fasilitas as $f)
                                    <option value="{{ $f->fasilitas_id }}" {{ old('fasilitas_id', $peminjaman->fasilitas_id) == $f->fasilitas_id ? 'selected' : '' }}>
                                        {{ $f->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tujuan Penggunaan</label>
                            <textarea class="form-control" name="tujuan" rows="3" required>{{ old('tujuan', $peminjaman->tujuan) }}</textarea>
                        </div>
                    </div>

                    {{-- KOLOM KANAN: WAKTU & STATUS --}}
                    <div class="col-lg-6">
                        <h6 class="text-uppercase text-muted fw-bold mb-3 small border-bottom pb-2">Waktu & Status</h6>

                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Mulai</label>
                                <input type="datetime-local" class="form-control" name="tanggal_mulai" 
                                       value="{{ old('tanggal_mulai', \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->format('Y-m-d\TH:i')) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Selesai</label>
                                <input type="datetime-local" class="form-control" name="tanggal_selesai" 
                                       value="{{ old('tanggal_selesai', \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->format('Y-m-d\TH:i')) }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Total Biaya (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">Rp</span>
                                <input type="number" class="form-control fw-bold" name="total_biaya" value="{{ old('total_biaya', $peminjaman->total_biaya) }}" min="0" required>
                            </div>
                        </div>

                        <div class="card bg-light border-warning border-2">
                            <div class="card-body">
                                <label class="form-label fw-bold text-dark">Status Booking</label>
                                <select class="form-select border-warning fw-bold" name="status" required>
                                    @foreach(['pending', 'disetujui', 'ditolak', 'selesai', 'dibatalkan'] as $st)
                                        <option value="{{ $st }}" {{ old('status', $peminjaman->status) == $st ? 'selected' : '' }}>
                                            {{ ucfirst($st) }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-text text-muted small mt-1">Ubah status untuk memproses pengajuan.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">
                
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('pages.peminjaman.index') }}" class="btn btn-light border px-4">Batal</a>
                    <button type="submit" class="btn btn-warning text-white px-4 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection