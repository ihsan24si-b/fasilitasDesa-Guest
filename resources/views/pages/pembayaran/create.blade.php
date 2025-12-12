@extends('layouts.app')

@section('title', 'Catat Pembayaran')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <h4 class="mb-4">Catat Pembayaran Baru</h4>
        <form action="{{ route('pages.pembayaran.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Pilih Tagihan / Booking</label>
                    <select class="form-select" name="pinjam_id" id="selectTagihan" required onchange="updateTotal()">
                        <option value="" data-harga="0">-- Pilih Booking yang Belum Lunas --</option>
                        @foreach ($tagihan as $t)
                            <option value="{{ $t->pinjam_id }}" data-harga="{{ $t->total_biaya }}">
                                {{ $t->kode_booking }} - {{ $t->warga->nama }} (Rp {{ number_format($t->total_biaya) }})
                            </option>
                        @endforeach
                    </select>
                    @if($tagihan->isEmpty())
                        <small class="text-danger">Semua booking sudah lunas / gratis.</small>
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tanggal Pembayaran</label>
                    <input type="date" name="tgl_bayar" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nominal Pembayaran (Rp)</label>
                    <input type="number" name="jumlah" id="inputJumlah" class="form-control" readonly required>
                    <small class="text-muted">*Otomatis terisi sesuai total tagihan booking.</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Metode Pembayaran</label>
                    <select class="form-select" name="metode" required>
                        <option value="Tunai">Tunai / Cash</option>
                        <option value="Transfer BRI">Transfer Bank BRI</option>
                        <option value="Transfer BNI">Transfer Bank BNI</option>
                        <option value="Transfer Mandiri">Transfer Bank Mandiri</option>
                        <option value="Transfer BCA">Transfer Bank BCA</option>
                        <option value="E-Wallet Dana">E-Wallet DANA</option>
                        <option value="E-Wallet Gopay">E-Wallet GoPay</option>
                        <option value="QRIS">QRIS</option>
                    </select>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Keterangan Tambahan (Opsional)</label>
                    <textarea name="keterangan" class="form-control" rows="2" placeholder="Contoh: Lunas via Pak RT"></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-save me-2"></i>Simpan Pembayaran</button>
            <a href="{{ route('pages.pembayaran.index') }}" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>
</div>

<script>
    // Script sederhana untuk auto-fill nominal saat pilih booking
    function updateTotal() {
        var select = document.getElementById('selectTagihan');
        var selectedOption = select.options[select.selectedIndex];
        var harga = selectedOption.getAttribute('data-harga');
        
        document.getElementById('inputJumlah').value = harga;
    }
</script>
@endsection