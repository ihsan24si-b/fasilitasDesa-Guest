@extends('layouts.app')

@section('title', 'Riwayat Pembayaran')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold">Kas Masuk</h2>
            <p class="mb-0 text-muted">Riwayat pembayaran sewa fasilitas desa.</p>
        </div>
        <a href="{{ route('pages.pembayaran.create') }}" class="btn btn-success shadow-sm">
            <i class="fas fa-cash-register me-2"></i>Catat Pembayaran
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }} 
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="bg-light rounded p-4 shadow-sm">
        
        {{-- FILTER & SEARCH BAR --}}
        <form method="GET" action="{{ route('pages.pembayaran.index') }}" class="mb-4">
            <div class="row g-2">
                
                {{-- Search --}}
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" 
                               value="{{ request('search') }}" 
                               placeholder="Cari Kode Booking / Nama...">
                    </div>
                </div>

                {{-- Filter Metode --}}
                <div class="col-md-2">
                    <select name="metode" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Metode --</option>
                        <option value="Tunai" {{ request('metode') == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                        <option value="Transfer" {{ request('metode') == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                    </select>
                </div>

                {{-- Filter Tanggal --}}
                <div class="col-md-2">
                    <input type="date" name="tanggal" class="form-control" 
                           value="{{ request('tanggal') }}" onchange="this.form.submit()" 
                           title="Filter per Tanggal">
                </div>

                {{-- Pagination --}}
                <div class="col-md-2">
                    <select name="perPage" class="form-select" onchange="this.form.submit()">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>Show 10</option>
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>Show 25</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>Show 50</option>
                    </select>
                </div>

                {{-- Reset --}}
                <div class="col-md-2">
                    <a href="{{ route('pages.pembayaran.index') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-sync-alt me-1"></i> Reset
                    </a>
                </div>
            </div>
        </form>

        {{-- INFO & TABEL --}}
        <div class="mb-3 text-muted small">
            Menampilkan {{ $pembayaran->firstItem() ?? 0 }} - {{ $pembayaran->lastItem() ?? 0 }} dari total {{ $pembayaran->total() }} data.
        </div>

        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead class="table-light">
                    <tr class="text-dark">
                        <th>Tgl Bayar</th>
                        <th>Kode Booking</th>
                        <th>Penyewa</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                        <th>Bukti</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pembayaran as $item)
                    <tr>
                        <td>{{ $item->tgl_bayar->format('d M Y') }}</td>
                        <td>
                            <span class="text-primary fw-bold">{{ $item->peminjaman->kode_booking ?? '-' }}</span><br>
                            <small class="text-muted">{{ $item->peminjaman->fasilitas->nama ?? 'Fasilitas Dihapus' }}</small>
                        </td>
                        <td>{{ $item->peminjaman->warga->nama ?? 'Warga Dihapus' }}</td>
                        <td class="fw-bold text-success">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge {{ $item->metode == 'Tunai' ? 'bg-success' : 'bg-info text-dark' }}">
                                {{ $item->metode }}
                            </span>
                        </td>
                        
                        {{-- Kolom Resi --}}
                        <td>
                            @if($item->media)
                                <a href="{{ asset('storage/resi_pembayaran/' . $item->media->file_name) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-image"></i>
                                </a>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>

                        <td class="text-end">
                            <a href="{{ route('pages.pembayaran.edit', $item->bayar_id) }}" class="btn btn-sm btn-warning me-1">
                                <i class="fas fa-edit text-white"></i>
                            </a>
                            <form action="{{ route('pages.pembayaran.destroy', $item->bayar_id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus data pembayaran ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center py-5 text-muted">Belum ada data pembayaran.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 d-flex justify-content-end">
            {{ $pembayaran->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection