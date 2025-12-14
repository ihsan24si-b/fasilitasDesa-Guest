@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold">Data Peminjaman</h2>
            <p class="mb-0 text-muted">Kelola jadwal peminjaman fasilitas desa.</p>
        </div>
        <a href="{{ route('pages.peminjaman.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-2"></i>Buat Peminjaman Baru
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="bg-light rounded p-4 shadow-sm">
        
        {{-- FORM FILTER & SEARCH --}}
        <form method="GET" action="{{ route('pages.peminjaman.index') }}" class="mb-4">
            <div class="row g-2">
                
                {{-- 1. Search Bar --}}
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" 
                               value="{{ request('search') }}" 
                               placeholder="Cari Kode / Nama / Fasilitas...">
                    </div>
                </div>

                {{-- 2. Filter Status --}}
                <div class="col-md-2">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua Status --</option>
                        @foreach(['pending', 'disetujui', 'ditolak', 'selesai', 'dibatalkan'] as $st)
                            <option value="{{ $st }}" {{ request('status') == $st ? 'selected' : '' }}>
                                {{ ucfirst($st) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- 3. Filter Fasilitas --}}
                <div class="col-md-3">
                    <select name="fasilitas_id" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua Fasilitas --</option>
                        @foreach ($allFasilitas as $f)
                            <option value="{{ $f->fasilitas_id }}" {{ request('fasilitas_id') == $f->fasilitas_id ? 'selected' : '' }}>
                                {{ $f->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- 4. Show Entries --}}
                <div class="col-md-2">
                    <select name="perPage" class="form-select" onchange="this.form.submit()">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>Show 10</option>
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>Show 25</option>
                        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>Show 50</option>
                    </select>
                </div>

                {{-- 5. Reset --}}
                <div class="col-md-2">
                    <a href="{{ route('pages.peminjaman.index') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-sync-alt me-1"></i> Reset
                    </a>
                </div>
            </div>
        </form>

        {{-- Info Showing --}}
        <div class="mb-3 text-muted small">
            Menampilkan {{ $peminjaman->firstItem() ?? 0 }} sampai {{ $peminjaman->lastItem() ?? 0 }} dari total {{ $peminjaman->total() }} data.
        </div>

        {{-- Tabel Data --}}
        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead class="table-light">
                    <tr class="text-dark">
                        <th scope="col">Kode Booking</th>
                        <th scope="col">Fasilitas</th>
                        <th scope="col">Peminjam</th>
                        <th scope="col">Tanggal Sewa</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($peminjaman as $item)
                    <tr>
                        <td class="fw-bold text-primary">{{ $item->kode_booking }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                
                                <div>
                                    <h6 class="mb-0 small">{{ $item->fasilitas->nama }}</h6>
                                    <small class="text-muted" style="font-size: 0.75rem;">{{ ucfirst($item->fasilitas->jenis) }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="d-block fw-bold text-dark">{{ $item->warga->nama }}</span>
                            <small class="text-muted">{{ $item->warga->telp }}</small>
                        </td>
                        <td>
                            @if(\Carbon\Carbon::parse($item->tanggal_mulai)->isSameDay($item->tanggal_selesai))
                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}
                            @else
                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M') }} - {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                            @endif
                            <br>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->diffInDays($item->tanggal_selesai) + 1 }} Hari
                            </small>
                        </td>
                        <td>
                            @php
                                $badges = [
                                    'pending' => 'bg-warning text-dark',
                                    'disetujui' => 'bg-info text-white',
                                    'selesai' => 'bg-success',
                                    'ditolak' => 'bg-danger',
                                    'dibatalkan' => 'bg-secondary'
                                ];
                            @endphp
                            <span class="badge {{ $badges[$item->status] ?? 'bg-secondary' }} rounded-pill px-3 py-2">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('pages.peminjaman.show', $item->pinjam_id) }}" 
                                   class="btn btn-sm btn-outline-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('pages.peminjaman.edit', $item->pinjam_id) }}" 
                                   class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('pages.peminjaman.destroy', $item->pinjam_id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                            onclick="return confirm('Hapus data peminjaman ini?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-calendar-times fa-3x mb-3 text-secondary opacity-50"></i>
                            <p class="mb-0">Tidak ada data peminjaman ditemukan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Links --}}
        <div class="mt-4 d-flex justify-content-end">
            {{ $peminjaman->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection