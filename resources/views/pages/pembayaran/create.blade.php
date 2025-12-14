@extends('layouts.app')

@section('title', 'Catat Pembayaran')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <h4 class="mb-4 text-primary fw-bold">Catat Pembayaran Baru</h4>
        
        {{-- PENTING: enctype --}}
        <form action="{{ route('pages.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Pilih Tagihan / Booking</label>
                    <select class="form-select @error('pinjam_id') is-invalid @enderror" name="pinjam_id" id="selectTagihan" required onchange="updateTotal()">
                        <option value="" data-harga="0">-- Pilih Booking --</option>
                        @foreach ($tagihan as $t)
                            <option value="{{ $t->pinjam_id }}" data-harga="{{ $t->total_biaya }}">
                                {{ $t->kode_booking }} - {{ $t->warga->nama }} (Rp {{ number_format($t->total_biaya) }})
                            </option>
                        @endforeach
                    </select>
                    @if($tagihan->isEmpty())
                        <small class="text-danger">Tidak ada tagihan yang perlu dibayar.</small>
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tanggal Pembayaran</label>
                    <input type="date" name="tgl_bayar" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nominal (Rp)</label>
                    <input type="number" name="jumlah" id="inputJumlah" class="form-control" readonly required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Metode</label>
                    <select class="form-select" name="metode" required>
                        <option value="Tunai">Tunai / Cash</option>
                        <option value="Transfer">Transfer Bank</option>
                    </select>
                </div>

                {{-- UPLOAD RESI --}}
                <div class="col-md-12 mb-3">
                    <label class="form-label fw-bold">Upload Resi (Opsional)</label>
                    <input type="file" class="form-control" name="resi" accept="image/*" onchange="previewResi(this)">
                    <div class="form-text">JPG, PNG, GIF. Max 2MB.</div>
                    <img id="img-preview" src="" class="mt-2 rounded border d-none" style="max-height: 200px;">
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="2"></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-save me-2"></i>Simpan</button>
            <a href="{{ route('pages.pembayaran.index') }}" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
</div>

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