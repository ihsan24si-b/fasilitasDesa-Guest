@extends('layouts.guest.app')

@section('title', 'Ihsan - Detail Warga')

@section('content')
<div class="container-fluid py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="mb-1">Detail Warga</h1>
                <p class="mb-0">Informasi lengkap data warga</p>
            </div>
            <div>
                <a href="{{ route('warga.index') }}@extends('layouts.guest.app')

@section('title', 'Ihsan - Detail Warga')

@section('content')
<!-- Detail Warga Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="mb-1">Detail Warga</h1>
                <p class="mb-0">Informasi lengkap data warga</p>
            </div>
            <div>
                <a href="{{ route('warga.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i data-feather="user"></i> Informasi Pribadi</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong><i data-feather="credit-card"></i> No KTP:</strong>
                                    <p class="mt-1">{{ $warga->no_ktp }}</p>
                                </div>
                                <div class="mb-3">
                                    <strong><i data-feather="user"></i> Nama Lengkap:</strong>
                                    <p class="mt-1">{{ $warga->nama_lengkap }}</p>
                                </div>
                                <div class="mb-3">
                                    <strong><i data-feather="user-check"></i> Jenis Kelamin:</strong>
                                    <p class="mt-1">{{ $warga->jenis_kelamin_lengkap }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong><i data-feather="star"></i> Agama:</strong>
                                    <p class="mt-1">{{ $warga->agama }}</p>
                                </div>
                                <div class="mb-3">
                                    <strong><i data-feather="briefcase"></i> Pekerjaan:</strong>
                                    <p class="mt-1">{{ $warga->pekerjaan }}</p>
                                </div>
                                <div class="mb-3">
                                    <strong><i data-feather="phone"></i> No Telepon:</strong>
                                    <p class="mt-1">{{ $warga->telepon_formatted }}</p>
                                </div>
                                <div class="mb-3">
                                    <strong><i data-feather="mail"></i> Email:</strong>
                                    <p class="mt-1">{{ $warga->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i data-feather="calendar"></i>
                                Dibuat: {{ $warga->created_at->format('d M Y H:i') }} |
                                Diupdate: {{ $warga->updated_at->format('d M Y H:i') }}
                            </small>
                            <div class="btn-group">
                                <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-warning btn-sm">
                                    <i data-feather="edit"></i> Edit
                                </a>
                                <a href="{{ route('warga.index') }}" class="btn btn-secondary btn-sm">
                                    <i data-feather="list"></i> Daftar Warga
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Detail Warga End -->
@endsection" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        <div class="bg-light rounded p-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">No KTP</label>
                        <p class="form-control-plaintext">{{ $warga->no_ktp }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <p class="form-control-plaintext">{{ $warga->nama_lengkap }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Jenis Kelamin</label>
                        <p class="form-control-plaintext">{{ $warga->jenis_kelamin_lengkap }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Agama</label>
                        <p class="form-control-plaintext">{{ $warga->agama }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Pekerjaan</label>
                        <p class="form-control-plaintext">{{ $warga->pekerjaan }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">No Telepon</label>
                        <p class="form-control-plaintext">{{ $warga->no_telepon }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Email</label>
                        <p class="form-control-plaintext">{{ $warga->email }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Tanggal Dibuat</label>
                        <p class="form-control-plaintext">{{ $warga->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex gap-2">
                        <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i> Edit Data
                        </a>
                        <form action="{{ route('warga.destroy', $warga->warga_id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus data?')">
                                <i class="fas fa-trash me-2"></i> Hapus Data
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
