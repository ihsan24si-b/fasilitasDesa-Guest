@extends('layouts.app')

@section('title', 'Edit Peminjaman')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold">Edit Booking</h2>
            <p class="mb-0 text-muted">Ubah data peminjaman atau perbarui status.</p>
        </div>
        <a href="{{ route('pages.peminjaman.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="bg-light rounded p-4 shadow-sm">
        <form action="{{ route('pages.peminjaman.update', $peminjaman->pinjam_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                {{-- KOLOM KIRI --}}
                <div class="col-md-6">
                    <h5 class="mb-3 text-info"><i class="fas fa-user-tag me-2"></i>Informasi Peminjam</h5>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Peminjam <span class="text-danger">*</span></label>
                        <select class="form-select @error('warga_id') is-invalid @enderror" name="warga_id" required>
                            <option value="">-- Pilih Warga --</option>
                            @foreach ($warga as $w)
                                <option value="{{ $w->warga_id }}" 
                                    {{ old('warga_id', $peminjaman->warga_id) == $w->warga_id ? 'selected' : '' }}>
                                    {{ $w->nama }} ({{ $w->nik }})
                                </option>
                            @endforeach
                        </select>
                        @error('warga_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Fasilitas yang Disewa <span class="text-danger">*</span></label>
                        <select class="form-select @error('fasilitas_id') is-invalid @enderror" name="fasilitas_id" required>
                            <option value="">-- Pilih Fasilitas --</option>
                            @foreach ($fasilitas as $f)
                                <option value="{{ $f->fasilitas_id }}" 
                                    {{ old('fasilitas_id', $peminjaman->fasilitas_id) == $f->fasilitas_id ? 'selected' : '' }}>
                                    {{ $f->nama }} (Kapasitas: {{ $f->kapasitas }} org)
                                </option>
                            @endforeach
                        </select>
                        @error('fasilitas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tujuan Penggunaan <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('tujuan') is-invalid @enderror" name="tujuan" rows="3" required>{{ old('tujuan', $peminjaman->tujuan) }}</textarea>
                        @error('tujuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- KOLOM KANAN --}}
                <div class="col-md-6">
                    <h5 class="mb-3 text-info"><i class="fas fa-clock me-2"></i>Waktu & Status</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Mulai <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                   name="tanggal_mulai" 
                                   value="{{ old('tanggal_mulai', \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->format('Y-m-d\TH:i')) }}" required>
                            @error('tanggal_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Selesai <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                   name="tanggal_selesai" 
                                   value="{{ old('tanggal_selesai', \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->format('Y-m-d\TH:i')) }}" required>
                            @error('tanggal_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Total Biaya (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control @error('total_biaya') is-invalid @enderror" 
                                   name="total_biaya" value="{{ old('total_biaya', $peminjaman->total_biaya) }}" min="0" required>
                        </div>
                        @error('total_biaya') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Status Booking <span class="text-danger">*</span></label>
                        <select class="form-select border-3 border-warning @error('status') is-invalid @enderror" name="status" required>
                            @php
                                $statuses = ['pending', 'disetujui', 'ditolak', 'selesai', 'dibatalkan'];
                            @endphp
                            @foreach($statuses as $st)
                                <option value="{{ $st }}" {{ old('status', $peminjaman->status) == $st ? 'selected' : '' }}>
                                    {{ ucfirst($st) }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text">Ubah status ini untuk menyetujui atau menolak booking.</div>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <hr class="my-4">
            
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('pages.peminjaman.index') }}" class="btn btn-light border">Batal</a>
                <button type="submit" class="btn btn-warning text-white px-4 fw-bold">
                    <i class="fas fa-save me-2"></i>SIMPAN PERUBAHAN
                </button>
            </div>
        </form>
    </div>
</div>
@endsection