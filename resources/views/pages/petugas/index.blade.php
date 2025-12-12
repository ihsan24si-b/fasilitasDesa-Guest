@extends('layouts.app')

@section('title', 'Data Petugas Fasilitas')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Petugas Fasilitas</h2>
            <p class="mb-0 text-muted">Manajemen pengelola fasilitas desa</p>
        </div>
        <a href="{{ route('pages.petugas.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus me-2"></i>Tambah Petugas
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
                        <th>Nama Petugas</th>
                        <th>Fasilitas</th>
                        <th>Peran / Jabatan</th>
                        <th>Kontak</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($petugas as $p)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $p->warga->nama }}</div>
                            <small class="text-muted">{{ $p->warga->no_ktp }}</small>
                        </td>
                        <td>
                            <i class="fas fa-building text-secondary me-2"></i>
                            {{ $p->fasilitas->nama }}
                        </td>
                        <td>
                            @php
                                $colors = [
                                    'Penanggung Jawab' => 'bg-primary',
                                    'Operasional' => 'bg-info text-dark',
                                    'Keamanan' => 'bg-dark',
                                    'Kebersihan' => 'bg-success'
                                ];
                            @endphp
                            <span class="badge {{ $colors[$p->peran] ?? 'bg-secondary' }} rounded-pill px-3">
                                {{ $p->peran }}
                            </span>
                        </td>
                        <td>
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $p->warga->telp) }}" target="_blank" class="btn btn-sm btn-success text-white">
                                <i class="fab fa-whatsapp me-1"></i> {{ $p->warga->telp }}
                            </a>
                        </td>
                        <td class="text-end">
                            <form action="{{ route('pages.petugas.destroy', $p->petugas_id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Berhentikan petugas ini?')">
                                    <i class="fas fa-user-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-4">Belum ada petugas assigned.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $petugas->links('pagination::bootstrap-5') }}</div>
    </div>
</div>
@endsection