@extends('layouts.app')

@section('title', 'Booking Fasilitas')

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold">Booking Fasilitas</h2>
            <p class="mb-0 text-muted">Formulir peminjaman fasilitas baru.</p>
        </div>
        <a href="{{ route('pages.peminjaman.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FORM CARD --}}
    <form action="{{ route('pages.peminjaman.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row g-4">
            
            {{-- KOLOM KIRI: DATA UTAMA --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary"><i class="fas fa-calendar-plus me-2"></i>Data Peminjaman</h5>
                    </div>
                    <div class="card-body p-4">
                        
                        {{-- Pilih Warga --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Nama Peminjam (Warga) <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg @error('warga_id') is-invalid @enderror" name="warga_id" required>
                                <option value="">-- Pilih Warga --</option>
                                @foreach ($warga as $w)
                                    <option value="{{ $w->warga_id }}" {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
                                        {{ $w->nama }} - {{ $w->no_ktp }}
                                    </option>
                                @endforeach
                            </select>
                            @error('warga_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Pilih Fasilitas --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Fasilitas yang Dipinjam <span class="text-danger">*</span></label>
                            <select class="form-select @error('fasilitas_id') is-invalid @enderror" name="fasilitas_id" required>
                                <option value="">-- Pilih Fasilitas --</option>
                                @foreach ($fasilitas as $f)
                                    <option value="{{ $f->fasilitas_id }}" {{ old('fasilitas_id') == $f->fasilitas_id ? 'selected' : '' }}>
                                        {{ $f->nama }} (Kapasitas: {{ $f->kapasitas }} org)
                                    </option>
                                @endforeach
                            </select>
                            @error('fasilitas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Tanggal --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai') }}" required>
                                @error('tanggal_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai') }}" required>
                                @error('tanggal_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        {{-- Tujuan --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tujuan Pemakaian</label>
                            <textarea class="form-control @error('tujuan') is-invalid @enderror" name="tujuan" rows="3" placeholder="Contoh: Acara Pernikahan, Rapat RT, dll">{{ old('tujuan') }}</textarea>
                            @error('tujuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: BIAYA & BUKTI --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-light py-3 border-bottom">
                        <h6 class="mb-0 fw-bold">Biaya & Pembayaran</h6>
                    </div>
                    <div class="card-body p-4">
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Total Biaya (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white fw-bold">Rp</span>
                                <input type="number" name="total_biaya" class="form-control form-control-lg fw-bold text-success text-end" value="{{ old('total_biaya', 0) }}" min="0">
                            </div>
                            <div class="form-text text-end">Isi 0 jika gratis.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Upload Bukti Bayar / DP</label>
                            <div class="card bg-light border-dashed text-center p-3">
                                <i class="fas fa-cloud-upload-alt text-muted mb-2 fs-4"></i>
                                <input class="form-control form-control-sm" type="file" name="bukti_bayar" accept="image/*">
                                <small class="text-muted mt-2 d-block" style="font-size: 0.7rem;">JPG, PNG (Max 2MB)</small>
                            </div>
                        </div>

                        <hr class="my-4">

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm">
                            <i class="fas fa-save me-2"></i>Simpan Booking
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    .border-dashed {
        border: 2px dashed #ced4da;
        border-radius: 8px;
    }
</style>
@endpush