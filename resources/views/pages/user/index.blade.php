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

        <!-- Card View untuk Guest -->
        <div class="row">
            @forelse ($dataUser as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">
                            <i data-feather="user"></i> {{ $item->name }}
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted"><i data-feather="mail"></i> Email:</small>
                            <p class="mb-0">{{ $item->email }}</p>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted"><i data-feather="lock"></i> Password:</small>
                            <p class="mb-0">
                                <small class="text-muted">{{ substr($item->password, 0, 20) }}...</small>
                            </p>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted"><i data-feather="calendar"></i> Dibuat:</small>
                            <p class="mb-0">
                                <small>{{ $item->created_at->format('d M Y') }}</small>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('user.show', $item->id) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                <i data-feather="eye"></i> Detail
                            </a>
                            <div class="btn-group">
                                <a href="{{ route('user.edit', $item->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                    <i data-feather="edit"></i>
                                </a>
                                <form action="{{ route('user.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?')" title="Hapus">
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

        @if($dataUser->count() > 0)
        <div class="mt-4 text-center text-muted">
            <small><i data-feather="database"></i> Total: {{ $dataUser->count() }} user</small>
        </div>
        @endif
    </div>
</div>
<!-- Data User End -->
@endsection
