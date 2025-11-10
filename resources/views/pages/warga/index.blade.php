@extends('layouts.guest.app')

@section('title', 'Ihsan - Data Warga')

@section('content')
<!-- Data Warga Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="mb-1"><i data-feather="users"></i> Data Warga</h1>
                <p class="mb-0">List data seluruh warga desa</p>
            </div>
            <div>
                <a href="{{ route('warga.create') }}" class="btn btn-success">
                    <i data-feather="plus"></i> Tambah Warga
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i data-feather="check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Card View untuk Guest -->
        <div class="row">
            @forelse ($dataWarga as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0"><i data-feather="user"></i> {{ $item->nama }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <small class="text-muted"><i data-feather="credit-card"></i> No KTP:</small>
                            <p class="mb-0">{{ $item->no_ktp }}</p>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted"><i data-feather="user-check"></i> Jenis Kelamin:</small>
                            <p class="mb-0">{{ $item->jenis_kelamin }}</p>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted"><i data-feather="star"></i> Agama:</small>
                            <p class="mb-0">{{ $item->agama }}</p>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted"><i data-feather="briefcase"></i> Pekerjaan:</small>
                            <p class="mb-0">{{ $item->pekerjaan }}</p>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted"><i data-feather="phone"></i> Telepon:</small>
                            <p class="mb-0">{{ $item->telp }}</p>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted"><i data-feather="mail"></i> Email:</small>
                            <p class="mb-0">{{ $item->email }}</p>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('warga.show', $item->warga_id) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                <i data-feather="eye"></i> Detail
                            </a>
                            <div class="btn-group">
                                <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                    <i data-feather="edit"></i>
                                </a>
                                <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data warga ini?')" title="Hapus">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="card text-center py-5">
                    <div class="card-body">
                        <i data-feather="users" style="width: 64px; height: 64px;" class="text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada data warga</h5>
                        <p class="text-muted">Silahkan tambah data warga pertama Anda</p>
                        <a href="{{ route('warga.create') }}" class="btn btn-primary">
                            <i data-feather="plus"></i> Tambah Warga Pertama
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        @if($dataWarga->count() > 0)
        <div class="mt-4 text-center text-muted">
            <small><i data-feather="database"></i> Total: {{ $dataWarga->count() }} warga</small>
        </div>
        @endif
    </div>
</div>
<!-- Data Warga End -->
@endsection
