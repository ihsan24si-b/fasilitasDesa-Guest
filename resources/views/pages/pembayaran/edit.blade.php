@extends('layouts.app')

@section('title', 'Edit Pembayaran')

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold">Edit Pembayaran</h2>
            <p class="mb-0 text-muted">Perbarui data transaksi yang sudah dicatat.</p>
        </div>
        <a href="{{ route('pages.pembayaran.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    {{-- CARD FORM --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning bg-opacity-10 py-3">
            <h5 class="mb-0 text-dark"><i class="fas fa-edit me-2"></i>Edit Data Transaksi</h5>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('pages.pembayaran.update', $pembayaran->bayar_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    {{-- KOLOM KIRI --}}
                    <div class="col-lg-7">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tagihan / Booking</label>
                            <select class="form-select bg-light" name="pinjam_id" required>
                                @foreach ($tagihan as $t)
                                    <option value="{{ $t->pinjam_id }}" {{ old('pinjam_id', $pembayaran->pinjam_id) == $t->pinjam_id ? 'selected' : '' }}>
                                        {{ $t->kode_booking }} - {{ $t->warga->nama }} (Rp {{ number_format($t->total_biaya) }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">Pastikan booking sesuai dengan pembayaran.</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tanggal Bayar</label>
                                <input type="date" class="form-control" name="tgl_bayar" value="{{ old('tgl_bayar', $pembayaran->tgl_bayar->format('Y-m-d')) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Metode</label>
                                <select class="form-select" name="metode" required>
                                    <option value="Tunai" {{ old('metode', $pembayaran->metode) == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                                    <option value="Transfer" {{ old('metode', $pembayaran->metode) == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Jumlah (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text fw-bold">Rp</span>
                                <input type="number" class="form-control fw-bold" name="jumlah" value="{{ old('jumlah', $pembayaran->jumlah) }}" min="0" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Keterangan</label>
                            <textarea class="form-control" name="keterangan" rows="2">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
                        </div>
                    </div>

                    {{-- KOLOM KANAN (PREVIEW & UPLOAD) --}}
                    <div class="col-lg-5">
                        <div class="card border h-100">
                            <div class="card-header bg-light fw-bold small">BUKTI PEMBAYARAN</div>
                            <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                                
                                {{-- Preview Gambar Lama --}}
                                @if($pembayaran->media)
                                    <div class="mb-3 position-relative">
                                        <a href="{{ asset('storage/resi_pembayaran/' . $pembayaran->media->file_name) }}" target="_blank">
                                            <img src="{{ asset('storage/resi_pembayaran/' . $pembayaran->media->file_name) }}" 
                                                 class="img-thumbnail shadow-sm" 
                                                 style="max-height: 150px;">
                                        </a>
                                        <span class="badge bg-success position-absolute top-0 start-100 translate-middle">Ada File</span>
                                    </div>
                                    <p class="small text-muted">Klik gambar untuk memperbesar.</p>
                                @else
                                    <div class="text-muted mb-3">
                                        <i class="fas fa-image fa-3x opacity-25"></i>
                                        <p class="small mt-2">Belum ada bukti pembayaran.</p>
                                    </div>
                                @endif

                                <hr class="w-100 my-2">
                                
                                <label class="form-label fw-bold small text-primary align-self-start">Ganti Bukti Bayar</label>
                                <input type="file" class="form-control form-control-sm" name="resi" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-warning text-white px-4 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection