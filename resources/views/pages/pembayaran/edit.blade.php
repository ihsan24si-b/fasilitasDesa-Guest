@extends('layouts.app')

@section('title', 'Edit Pembayaran')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <div class="d-flex justify-content-between mb-4">
            <h4 class="mb-0 text-primary fw-bold">Edit Transaksi Pembayaran</h4>
            <a href="{{ route('pages.pembayaran.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>

        {{-- PENTING: enctype --}}
        <form action="{{ route('pages.pembayaran.update', $pembayaran->bayar_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Tagihan</label>
                <select class="form-select" name="pinjam_id" required>
                    @foreach ($tagihan as $t)
                        <option value="{{ $t->pinjam_id }}" {{ old('pinjam_id', $pembayaran->pinjam_id) == $t->pinjam_id ? 'selected' : '' }}>
                            {{ $t->kode_booking }} - {{ $t->warga->nama }} (Rp {{ number_format($t->total_biaya) }})
                        </option>
                    @endforeach
                </select>
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
                <input type="number" class="form-control" name="jumlah" value="{{ old('jumlah', $pembayaran->jumlah) }}" min="0" required>
            </div>

            {{-- UPLOAD RESI --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Bukti Pembayaran</label>
                
                {{-- Preview Lama --}}
                @if($pembayaran->media)
                    <div class="mb-2">
                        <a href="{{ asset('storage/resi_pembayaran/' . $pembayaran->media->file_name) }}" target="_blank">
                            <img src="{{ asset('storage/resi_pembayaran/' . $pembayaran->media->file_name) }}" class="img-thumbnail" style="height: 100px;">
                        </a>
                        <span class="text-muted small ms-2">File saat ini</span>
                    </div>
                @endif

                <input type="file" class="form-control" name="resi" accept="image/*">
                <div class="form-text">Upload untuk mengganti bukti bayar.</div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Keterangan</label>
                <textarea class="form-control" name="keterangan" rows="3">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
            </div>

            <button type="submit" class="btn btn-warning text-white w-100 fw-bold">
                <i class="fas fa-save me-2"></i>Update Pembayaran
            </button>
        </form>
    </div>
</div>
@endsection