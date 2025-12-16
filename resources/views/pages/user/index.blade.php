@extends('layouts.app')

@section('title', 'Data User')

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold"><i class="fas fa-users-cog me-2"></i>Data User</h2>
            <p class="mb-0 text-muted">Manajemen pengguna sistem dan hak akses.</p>
        </div>
        <a href="{{ route('pages.user.create') }}" class="btn btn-success shadow-sm rounded-pill">
            <i class="fas fa-user-plus me-2"></i>Tambah User
        </a>
    </div>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FILTER & SEARCH --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('pages.user.index') }}">
                <div class="row g-2 align-items-center">
                    
                    {{-- 1. Search --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control bg-light border-start-0" 
                                   value="{{ request('search') }}" 
                                   placeholder="Cari Nama / Email...">
                        </div>
                    </div>

                    {{-- 2. Pagination --}}
                    <div class="col-lg-2 col-md-3">
                        <select name="perPage" class="form-select bg-light" onchange="this.form.submit()">
                            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>Show 10</option>
                            <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>Show 25</option>
                            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>Show 50</option>
                        </select>
                    </div>

                    {{-- 3. Reset --}}
                    <div class="col-lg-6 col-md-12 d-flex justify-content-end">
                        <a href="{{ route('pages.user.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-sync-alt me-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- GRID CARD USER --}}
    <div class="row g-4">
        @forelse ($dataUser as $item)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center position-relative overflow-hidden">
                    
                    {{-- Hiasan Background Header --}}
                    <div class="position-absolute top-0 start-0 w-100" style="height: 5px; background: {{ $item->role == 'Super Admin' ? '#dc3545' : ($item->role == 'Admin' ? '#ffc107' : '#0dcaf0') }};"></div>

                    <div class="card-body pt-5 pb-4">
                        
                        {{-- Avatar --}}
                        <div class="mb-3 position-relative d-inline-block">
                            @if($item->profile_picture) 
                                <img src="{{ asset('storage/' . $item->profile_picture) }}" 
                                     alt="{{ $item->name }}" 
                                     class="rounded-circle shadow-sm border border-3 border-white"
                                     style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                <div class="avatar-circle mx-auto shadow-sm text-white fw-bold d-flex align-items-center justify-content-center border border-3 border-white" 
                                     style="width: 80px; height: 80px; font-size: 2rem; background-color: {{ $loop->even ? '#6610f2' : '#fd7e14' }};">
                                    {{ substr($item->name, 0, 1) }}
                                </div>
                            @endif
                            
                            {{-- Badge Role (Melayang di Avatar) --}}
                            <span class="position-absolute bottom-0 start-100 translate-middle badge rounded-pill border border-light 
                                {{ $item->role == 'Super Admin' ? 'bg-danger' : ($item->role == 'Admin' ? 'bg-warning text-dark' : 'bg-info text-dark') }}">
                                {{ $item->role }}
                            </span>
                        </div>

                        {{-- Info User --}}
                        <h5 class="fw-bold text-dark mb-1 text-truncate px-3" title="{{ $item->name }}">{{ $item->name }}</h5>
                        <p class="text-muted small mb-3 text-truncate px-3" title="{{ $item->email }}">
                            <i class="far fa-envelope me-1"></i> {{ $item->email }}
                        </p>

                    </div>

                    {{-- Footer Actions --}}
                    <div class="card-footer bg-white border-top-0 pb-4 pt-0">
                        <div class="d-flex justify-content-center gap-2 px-3">
                            <a href="{{ route('pages.user.edit', $item->id) }}" class="btn btn-sm btn-outline-warning flex-grow-1">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            
                            <form action="{{ route('pages.user.destroy', $item->id) }}" method="POST" class="d-inline flex-grow-1">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger w-100" onclick="return confirm('Hapus user ini? Data terkait mungkin ikut terhapus.')">
                                    <i class="fas fa-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light text-center py-5 border-dashed">
                    <div class="mb-3">
                        <i class="fas fa-user-slash fa-3x text-muted opacity-50"></i>
                    </div>
                    <h5 class="text-muted">Tidak ada data user.</h5>
                    <p class="text-muted small mb-3">Silakan tambahkan user baru untuk akses sistem.</p>
                    <a href="{{ route('pages.user.create') }}" class="btn btn-sm btn-success rounded-pill">
                        <i class="fas fa-plus me-1"></i> Tambah User
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-between align-items-center mt-4 bg-light p-3 rounded">
        <small class="text-muted">
            Halaman {{ $dataUser->currentPage() }} dari {{ $dataUser->lastPage() }}
        </small>
        <div>
            {{ $dataUser->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@push('styles')
<style>
    .avatar-circle {
        border-radius: 50%;
    }
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
    .border-dashed {
        border: 2px dashed #dee2e6;
        border-radius: 10px;
    }
</style>
@endpush

@endsection