@extends('layouts.guest.app')

@section('title', 'Ihsan - Data Fasilitas')

@section('content')
<!-- Data Fasilitas Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="mb-1"><i data-feather="home"></i> Data Fasilitas</h1>
                <p class="mb-0">List data seluruh fasilitas desa</p>
            </div>
            <div>
                <a href="{{ route('fasilitas.create') }}" class="btn btn-success">
                    <i data-feather="plus"></i> Tambah Fasilitas
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
            @forelse ($dataFasilitas as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header text-white
                        @if($item->jenis == 'aula') bg-primary
                        @elseif($item->jenis == 'lapangan') bg-success
                        @elseif($item->jenis == 'gedung') bg-info
                        @elseif($item->jenis == 'taman') bg-warning
                        @else bg-secondary @endif">
                        <h6 class="mb-0">
                            <i data-feather="
                                @if($item->jenis == 'aula') home
                                @elseif($item->jenis == 'lapangan') activity
                                @elseif($item->jenis == 'gedung') building
                                @elseif($item->jenis == 'taman') tree
                                @else box @endif
                            "></i>
                            {{ $item->nama }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <small class="text-muted"><i data-feather="grid"></i> Jenis:</small>
                            <p class="mb-0">
                                @if($item->jenis == 'aula')
                                    <span class="badge bg-primary">Aula</span>
                                @elseif($item->jenis == 'lapangan')
                                    <span class="badge bg-success">Lapangan</span>
                                @elseif($item->jenis == 'gedung')
                                    <span class="badge bg-info">Gedung</span>
                                @elseif($item->jenis == 'taman')
                                    <span class="badge bg-warning">Taman</span>
                                @else
                                    <span class="badge bg-secondary">Lainnya</span>
                                @endif
                            </p>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted"><i data-feather="map-pin"></i> Alamat:</small>
                            <p class="mb-0">{{ $item->alamat }}</p>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted"><i data-feather="users"></i> RT/RW:</small>
                            <p class="mb-0">{{ $item->rt }}/{{ $item->rw }}</p>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted"><i data-feather="user-check"></i> Kapasitas:</small>
                            <p class="mb-0">{{ $item->kapasitas }} orang</p>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('fasilitas.show', $item->fasilitas_id) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                <i data-feather="eye"></i> Detail
                            </a>
                            <div class="btn-group">
                                <a href="{{ route('fasilitas.edit', $item->fasilitas_id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                    <i data-feather="edit"></i>
                                </a>
                                <form action="{{ route('fasilitas.destroy', $item->fasilitas_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus fasilitas ini?')" title="Hapus">
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
                        <i data-feather="home" style="width: 64px; height: 64px;" class="text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada data fasilitas</h5>
                        <p class="text-muted">Silahkan tambah fasilitas pertama Anda</p>
                        <a href="{{ route('fasilitas.create') }}" class="btn btn-primary">
                            <i data-feather="plus"></i> Tambah Fasilitas Pertama
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        @if($dataFasilitas->count() > 0)
        <div class="mt-4 text-center text-muted">
            <small><i data-feather="database"></i> Total: {{ $dataFasilitas->count() }} fasilitas</small>
        </div>
        @endif
    </div>
</div>
<!-- Data Fasilitas End -->
@endsection
