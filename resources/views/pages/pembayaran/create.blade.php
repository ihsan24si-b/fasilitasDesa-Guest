@extends('layouts.app')

@section('title', 'Catat Pembayaran')

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold">Catat Pembayaran</h2>
            <p class="mb-0 text-muted">Input transaksi pembayaran sewa fasilitas.</p>
        </div>
        <a href="{{ route('pages.pembayaran.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    {{-- CARD FORM --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 text-primary"><i class="fas fa-file-invoice-dollar me-2"></i>Form Transaksi</h5>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('pages.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-4">
                    {{-- KOLOM KIRI --}}
                    <div class="col-lg-7">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Pilih Tagihan / Booking <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg @error('pinjam_id') is-invalid @enderror" name="pinjam_id" id="selectTagihan" required onchange="updateTotal()">
                                <option value="" data-harga="0">-- Pilih Kode Booking --</option>
                                @foreach ($tagihan as $t)
                                    <option value="{{ $t->pinjam_id }}" data-harga="{{ $t->total_biaya }}">
                                        {{ $t->kode_booking }} - {{ $t->warga->nama }} (Rp {{ number_format($t->total_biaya) }})
                                    </option>
                                @endforeach
                            </select>
                            @if($tagihan->isEmpty())
                                <small class="text-danger mt-1 d-block"><i class="fas fa-info-circle me-1"></i> Tidak ada tagihan yang perlu dibayar.</small>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tanggal Bayar <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_bayar" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Metode <span class="text-danger">*</span></label>
                                <select class="form-select" name="metode" required>
                                    <option value="Tunai">Tunai / Cash</option>
                                    <option value="Transfer">Transfer Bank</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nominal (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold">Rp</span>
                                <input type="number" name="jumlah" id="inputJumlah" class="form-control form-control-lg fw-bold text-success" readonly required placeholder="0">
                            </div>
                            <small class="text-muted">Nominal otomatis terisi sesuai tagihan.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="2" placeholder="Catatan tambahan (opsional)..."></textarea>
                        </div>
                    </div>

                    {{-- KOLOM KANAN (UPLOAD) --}}
                    <div class="col-lg-5">
                        <div class="card bg-light border-dashed h-100">
                            <div class="card-body text-center p-4 d-flex flex-column justify-content-center">
                                <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                                <h6 class="fw-bold">Upload Bukti Pembayaran</h6>
                                <p class="text-muted small mb-3">Format: JPG, PNG. Maksimal 2MB.</p>
                                
                                <input type="file" class="form-control mb-3" name="resi" accept="image/*" onchange="previewResi(this)">
                                
                                {{-- Preview Image Container --}}
                                <div class="mt-2">
                                    <img id="img-preview" src="" class="img-fluid rounded border d-none shadow-sm" style="max-height: 200px; object-fit: contain;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-success px-4 fw-bold"><i class="fas fa-save me-2"></i>Simpan Pembayaran</button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- SCRIPT TETAP DIPERTAHANKAN --}}
<script>
    function updateTotal() {
        var select = document.getElementById('selectTagihan');
        var selectedOption = select.options[select.selectedIndex];
        var harga = selectedOption.getAttribute('data-harga');
        document.getElementById('inputJumlah').value = harga;
    }

    function previewResi(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.getElementById('img-preview');
                img.src = e.target.result;
                img.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

@push('styles')
<style>
    .border-dashed {
        border: 2px dashed #ced4da;
        border-radius: 10px;
    }
</style>
@endpush