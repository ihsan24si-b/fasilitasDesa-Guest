@extends('layouts.app')

@section('title', 'Booking Fasilitas')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Booking Fasilitas</h2>
            <p class="mb-0 text-muted">Input data peminjaman baru</p>
        </div>
        <a href="{{ route('pages.peminjaman.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="bg-light rounded p-4 mb-4">
                <h5 class="mb-4 text-primary fw-bold">Formulir Booking</h5>
                <form action="{{ route('pages.peminjaman.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
    <label class="form-label fw-bold">Nama Peminjam (Warga)</label>
    <select class="form-select @error('warga_id') is-invalid @enderror" name="warga_id" required>
        <option value="">-- Pilih Warga --</option>
        @foreach ($warga as $w)
            {{-- PERBAIKAN: Gunakan 'warga_id' bukan 'id' --}}
            <option value="{{ $w->warga_id }}" {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
                {{ $w->nama }} - {{ $w->no_ktp }}
            </option>
        @endforeach
    </select>
    @error('warga_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

                    {{-- Pilih Fasilitas --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Fasilitas yang Dipinjam</label>
                        <select class="form-select @error('fasilitas_id') is-invalid @enderror" name="fasilitas_id" required>
                            <option value="">-- Pilih Fasilitas --</option>
                            @foreach ($fasilitas as $f)
                                <option value="{{ $f->fasilitas_id }}" {{ old('fasilitas_id') == $f->fasilitas_id ? 'selected' : '' }}>
                                    {{ $f->nama }} (Kapasitas: {{ $f->kapasitas }} orang)
                                </option>
                            @endforeach
                        </select>
                        @error('fasilitas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Tanggal Sewa --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                   value="{{ old('tanggal_mulai') }}" required>
                            @error('tanggal_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                   value="{{ old('tanggal_selesai') }}" required>
                            @error('tanggal_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    {{-- Tujuan --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tujuan Pemakaian</label>
                        <textarea class="form-control @error('tujuan') is-invalid @enderror" name="tujuan" rows="3" 
                                  placeholder="Contoh: Acara Pernikahan, Rapat RT, dll">{{ old('tujuan') }}</textarea>
                        @error('tujuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <hr class="my-4">

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="fas fa-save me-2"></i>Simpan Booking
                    </button>
                </div>
            </div>

            <div class="col-md-4">
                <div class="bg-light rounded p-4">
                    <h5 class="mb-4 text-primary fw-bold">Pembayaran</h5>
                    
                    <div class="mb-3">
                        <label class="form-label">Total Biaya (Rp)</label>
                        <input type="number" name="total_biaya" class="form-control form-control-lg fw-bold text-end" 
                               value="{{ old('total_biaya', 0) }}" min="0">
                        <div class="form-text">Isi 0 jika gratis.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Bukti Bayar / DP</label>
                        <input class="form-control" type="file" name="bukti_bayar" accept="image/*">
                        <div class="form-text">Format: JPG, PNG (Max 2MB).</div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection