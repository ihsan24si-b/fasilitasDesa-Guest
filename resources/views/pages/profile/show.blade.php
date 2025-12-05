@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Profil Saya</h2>
                <p class="mb-0">Informasi akun Anda</p>
            </div>
            <div>
                <a href="{{ route('pages.profile.edit') }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>Edit Profil
                </a>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="bg-light rounded p-4">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="mb-4">
                        <img src="{{ $user->getProfilePictureUrl() }}" alt="Profile Picture" class="rounded-circle shadow"
                            style="width: 200px; height: 200px; object-fit: cover;">
                    </div>

                    @if ($user->profile_picture)
                        <form action="{{ route('pages.profile.destroy') }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus foto profil?')">
                                <i class="fas fa-trash me-1"></i>Hapus Foto
                            </button>
                        </form>
                    @endif
                </div>

                <div class="col-md-8">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Nama:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $user->name }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $user->email }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Bergabung:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $user->created_at->format('d F Y') }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <strong>Terakhir Update:</strong>
                        </div>
                        <div class="col-sm-9">
                            {{ $user->updated_at->format('d F Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
