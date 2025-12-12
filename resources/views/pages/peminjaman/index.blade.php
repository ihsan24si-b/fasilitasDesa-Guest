@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Data Peminjaman</h2>
            <p class="mb-0 text-muted">Kelola jadwal peminjaman fasilitas desa</p>
        </div>
        <a href="{{ route('pages.peminjaman.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Buat Peminjaman Baru
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="bg-light rounded p-4">
        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead>
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
                                <div class="ms-2">
                                    <h6 class="mb-0">{{ $item->fasilitas->nama }}</h6>
                                    <small class="text-muted">{{ ucfirst($item->fasilitas->jenis) }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="d-block fw-bold">{{ $item->warga->nama }}</span>
                            <small class="text-muted">{{ $item->warga->telp }}</small>
                        </td>
                        <td>
                            @if($item->tanggal_mulai->isSameDay($item->tanggal_selesai))
                                {{ $item->tanggal_mulai->format('d M Y') }}
                            @else
                                {{ $item->tanggal_mulai->format('d M') }} - {{ $item->tanggal_selesai->format('d M Y') }}
                            @endif
                            <br>
                            <small class="text-muted">{{ $item->tanggal_mulai->diffInDays($item->tanggal_selesai) + 1 }} Hari</small>
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
                            <span class="badge {{ $badges[$item->status] }} rounded-pill px-3 py-2">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('pages.peminjaman.show', $item->pinjam_id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye me-1"></i>Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-calendar-times fa-3x mb-3"></i>
                            <p>Belum ada data peminjaman.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $peminjaman->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
