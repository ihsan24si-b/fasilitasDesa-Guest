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

        <!-- Filter & Search Section -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('warga.index') }}" method="GET">
                    <div class="row g-3">
                        <!-- Search -->
                        <div class="col-md-4">
                            <label for="search" class="form-label">Pencarian</label>
                            <input type="text" class="form-control" id="search" name="search"
                                   value="{{ $search }}" placeholder="Cari nama, no KTP, email, telepon...">
                        </div>

                        <!-- Filter Jenis Kelamin -->
                        <div class="col-md-2">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="">Semua</option>
                                <option value="Laki-laki" {{ ($filters['jenis_kelamin'] ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ ($filters['jenis_kelamin'] ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- Filter Agama -->
                        <div class="col-md-2">
                            <label for="agama" class="form-label">Agama</label>
                            <select class="form-select" id="agama" name="agama">
                                <option value="">Semua</option>
                                <option value="Islam" {{ ($filters['agama'] ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ ($filters['agama'] ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ ($filters['agama'] ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ ($filters['agama'] ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ ($filters['agama'] ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ ($filters['agama'] ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                        </div>

                        <!-- Filter Pekerjaan -->
                        <div class="col-md-2">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                   value="{{ $filters['pekerjaan'] ?? '' }}" placeholder="Pekerjaan...">
                        </div>

                        <!-- Items Per Page -->
                        <div class="col-md-2">
                            <label for="perPage" class="form-label">Item per Halaman</label>
                            <select class="form-select" id="perPage" name="perPage">
                                <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i data-feather="filter"></i> Terapkan Filter
                                </button>
                                <a href="{{ route('warga.index') }}" class="btn btn-secondary">
                                    <i data-feather="refresh-cw"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Warga Cards -->
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
                            <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i data-feather="edit"></i> Edit
                            </a>
                            <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data warga ini?')" title="Hapus">
                                    <i data-feather="trash-2"></i> Hapus
                                </button>
                            </form>
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

        <!-- Pagination -->
        @if($dataWarga->hasPages())
        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="pagination-info">
                    Menampilkan {{ $dataWarga->firstItem() }} - {{ $dataWarga->lastItem() }} dari {{ $dataWarga->total() }} data
                </div>
                <div>
                    {{ $dataWarga->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
        @endif

        @if($dataWarga->count() > 0)
        <div class="mt-4 text-center text-muted">
            <small><i data-feather="database"></i> Total: {{ $dataWarga->total() }} warga</small>
        </div>
        @endif
    </div>
</div>
<!-- Data Warga End -->
@endsection
