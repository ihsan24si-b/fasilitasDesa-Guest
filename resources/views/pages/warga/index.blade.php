@extends('layouts.guest.app')

@section('title', 'Ihsan - Data Warga')

@section('content')
<!-- Data Warga Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="mb-1">Data Warga</h1>
                <p class="mb-0">List data seluruh warga desa</p>
            </div>
            <div>
                <a href="{{ route('warga.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Tambah Warga
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="bg-light rounded p-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col" class="text-center">No KTP</th>
                            <th scope="col" class="text-center">Nama</th>
                            <th scope="col" class="text-center">Jenis Kelamin</th>
                            <th scope="col" class="text-center">Agama</th>
                            <th scope="col" class="text-center">Pekerjaan</th>
                            <th scope="col" class="text-center">Telp</th>
                            <th scope="col" class="text-center">Email</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataWarga as $item)
                        <tr>
                            <td>{{ $item->no_ktp }}</td>
                            <td>{{ $item->nama }}</td>
                            <td class="text-center">{{ $item->jenis_kelamin }}</td>
                            <td class="text-center">{{ $item->agama }}</td>
                            <td>{{ $item->pekerjaan }}</td>
                            <td>{{ $item->telp }}</td>
                            <td>{{ $item->email }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn btn-warning btn-sm me-1">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data warga ini?')">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-users fa-2x text-muted mb-3"></i>
                                <p class="text-muted mb-0">Belum ada data warga</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($dataWarga->count() > 0)
            <div class="mt-3 text-muted">
                <small>Total: {{ $dataWarga->count() }} warga</small>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- Data Warga End -->
@endsection
