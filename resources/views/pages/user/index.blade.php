@extends('layouts.guest.app')

@section('title', 'Data User')

@section('content')
<!-- Data User Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="mb-1"><i data-feather="users"></i> Data User</h1>
                <p class="mb-0">List data seluruh user sistem</p>
            </div>
            <div>
                <a href="{{ route('user.create') }}" class="btn btn-success">
                    <i data-feather="plus"></i> Tambah User
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i data-feather="check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i data-feather="alert-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Filter & Search Section -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('user.index') }}" method="GET">
                    <div class="row g-3">
                        <!-- Search -->
                        <div class="col-md-8">
                            <label for="search" class="form-label">Pencarian</label>
                            <input type="text" class="form-control" id="search" name="search"
                                   value="{{ $search }}" placeholder="Cari nama atau email user...">
                        </div>

                        <!-- Items Per Page -->
                        <div class="col-md-4">
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
                                <a href="{{ route('user.index') }}" class="btn btn-secondary">
                                    <i data-feather="refresh-cw"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Data User Cards -->
        <div class="row">
            @forelse ($dataUser as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">
                            <i data-feather="user"></i> {{ $item->name }}
                            @if($item->email === session('admin_email'))
                                <span class="badge bg-warning float-end">Anda</span>
                            @endif
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted"><i data-feather="mail"></i> Email:</small>
                            <p class="mb-0">{{ $item->email }}</p>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted"><i data-feather="calendar"></i> Dibuat:</small>
                            <p class="mb-0">
                                <small>{{ $item->created_at->format('d M Y H:i') }}</small>
                            </p>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted"><i data-feather="edit"></i> Diupdate:</small>
                            <p class="mb-0">
                                <small>{{ $item->updated_at->format('d M Y H:i') }}</small>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('user.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i data-feather="edit"></i> Edit
                            </a>
                            @if($item->email !== session('admin_email'))
                            <form action="{{ route('user.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?')" title="Hapus">
                                    <i data-feather="trash-2"></i> Hapus
                                </button>
                            </form>
                            @else
                            <button class="btn btn-secondary btn-sm" disabled title="Tidak dapat menghapus akun sendiri">
                                <i data-feather="shield"></i> Diri Sendiri
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="card text-center py-5">
                    <div class="card-body">
                        <i data-feather="users" style="width: 64px; height: 64px;" class="text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada data user</h5>
                        <p class="text-muted">Silahkan tambah user pertama Anda</p>
                        <a href="{{ route('user.create') }}" class="btn btn-primary">
                            <i data-feather="plus"></i> Tambah User Pertama
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($dataUser->hasPages())
        <div class="mt-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="pagination-info">
                    Menampilkan {{ $dataUser->firstItem() }} - {{ $dataUser->lastItem() }} dari {{ $dataUser->total() }} data
                </div>
                <div>
                    {{ $dataUser->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
        @endif

        @if($dataUser->count() > 0)
        <div class="mt-4 text-center text-muted">
            <small><i data-feather="database"></i> Total: {{ $dataUser->total() }} user</small>
        </div>
        @endif
    </div>
</div>
<!-- Data User End -->
@endsection
