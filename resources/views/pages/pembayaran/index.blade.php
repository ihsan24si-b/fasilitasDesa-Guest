@extends('layouts.app')

@section('title', 'Riwayat Pembayaran')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Kas Masuk</h2>
            <p class="mb-0 text-muted">Riwayat pembayaran sewa fasilitas</p>
        </div>
        <a href="{{ route('pages.pembayaran.create') }}" class="btn btn-success">
            <i class="fas fa-cash-register me-2"></i>Catat Pembayaran
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="bg-light rounded p-4">
        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th>Tgl Bayar</th>
                        <th>Kode Booking</th>
                        <th>Penyewa</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pembayaran as $item)
                    <tr>
                        <td>{{ $item->tgl_bayar->format('d M Y') }}</td>
                        <td>
                            <span class="text-primary fw-bold">{{ $item->peminjaman->kode_booking }}</span><br>
                            <small class="text-muted">{{ $item->peminjaman->fasilitas->nama }}</small>
                        </td>
                        <td>{{ $item->peminjaman->warga->nama }}</td>
                        <td class="fw-bold text-success">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        <td><span class="badge bg-secondary">{{ $item->metode }}</span></td>
                        <td>
                            <form action="{{ route('pages.pembayaran.destroy', $item->bayar_id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data pembayaran ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-4">Belum ada data pembayaran.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $pembayaran->links('pagination::bootstrap-5') }}</div>
    </div>
</div>
@endsection