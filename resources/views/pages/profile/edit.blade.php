@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Edit Profil</h2>
                <p class="mb-0">Ubah informasi profil Anda</p>
            </div>
            <div>
                <a href="{{ route('pages.profile.show') }}" class="btn btn-info">
                    <i class="fas fa-eye me-2"></i>Lihat Profil
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

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="bg-light rounded p-4">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="mb-4">
                        <img src="{{ $user->getProfilePictureUrl() }}" alt="Current Profile Picture"
                            class="rounded-circle shadow mb-3" style="width: 200px; height: 200px; object-fit: cover;">

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
                </div>

                <div class="col-md-8">
                    <form action="{{ route('pages.profile.update') }}" method="POST" enctype="multipart/form-data"> @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Foto Profil Baru</label>
                            <input type="file" class="form-control @error('profile_picture') is-invalid @enderror"
                                id="profile_picture" name="profile_picture"
                                accept="image/jpeg,image/png,image/jpg,image/gif">
                            <div class="form-text">
                                Format: JPEG, PNG, JPG, GIF. Maksimal: 2MB
                            </div>
                            @error('profile_picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                            <div class="form-text">Untuk mengubah nama, hubungi administrator</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                            <div class="form-text">Email tidak dapat diubah</div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Profil
                            </button>
                            <a href="{{ route('pages.profile.show') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Image Script -->
    <script>
        document.getElementById('profile_picture').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.rounded-circle').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
