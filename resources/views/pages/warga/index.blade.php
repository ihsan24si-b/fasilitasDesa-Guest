@extends('layouts.app')

@section('title', 'FDPR - Data Warga')

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- HEADER SECTION --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold"><i class="fas fa-users me-2"></i>Data Warga</h2>
            <p class="text-muted mb-0">Daftar penduduk desa yang terdaftar dalam sistem.</p>
        </div>
        <div>
            <a href="{{ route('pages.warga.create') }}" class="btn btn-primary rounded-pill shadow-sm">
                <i class="fas fa-user-plus me-2"></i>Tambah Warga
            </a>
        </div>
    </div>

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FILTER & SEARCH CARD --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('pages.warga.index') }}">
                <div class="row g-3">
                    {{-- Search --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control bg-light border-start-0"
                                   value="{{ request('search') }}" placeholder="Cari nama, NIK, atau email...">
                        </div>
                    </div>

                    {{-- Filter Gender --}}
                    <div class="col-lg-3 col-md-3">
                        <select name="jenis_kelamin" class="form-select bg-light" onchange="this.form.submit()">
                            <option value="">-- Jenis Kelamin --</option>
                            <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    {{-- Filter Agama --}}
                    <div class="col-lg-3 col-md-3">
                        <select name="agama" class="form-select bg-light" onchange="this.form.submit()">
                            <option value="">-- Agama --</option>
                            @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                <option value="{{ $agama }}" {{ request('agama') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Actions --}}
                    <div class="col-lg-2 col-md-12 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1"><i class="fas fa-filter"></i></button>
                        <a href="{{ route('pages.warga.index') }}" class="btn btn-outline-secondary" title="Reset"><i class="fas fa-sync-alt"></i></a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- GRID CARD WARGA --}}
    <div class="row g-4">
        @forelse ($dataWarga as $item)
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center pt-4 pb-2">
                    
                    {{-- Avatar Inisial --}}
                    <div class="avatar-circle mx-auto mb-3 shadow-sm" 
                         style="background-color: {{ $loop->even ? '#0f766e' : '#f59e0b' }}; color: white;">
                        {{ substr($item->nama, 0, 1) }}
                    </div>

                    {{-- Nama & Pekerjaan --}}
                    <h5 class="fw-bold mb-1 text-truncate" title="{{ $item->nama }}">{{ $item->nama }}</h5>
                    <p class="text-muted small mb-2">{{ $item->pekerjaan ?? '-' }}</p>

                    {{-- Badges --}}
                    <div class="mb-3">
                        <span class="badge rounded-pill bg-light text-dark border">
                            {{ $item->jenis_kelamin == 'Laki-laki' ? '♂ Laki-laki' : '♀ Perempuan' }}
                        </span>
                        <span class="badge rounded-pill bg-light text-dark border">
                            {{ $item->agama }}
                        </span>
                    </div>

                    <hr class="my-3 opacity-10">

                    {{-- Detail Info (NIK & Kontak) --}}
                    <div class="text-start px-2">
                        <div class="d-flex justify-content-between mb-2 small">
                            <span class="text-muted"><i class="far fa-id-card me-2"></i>NIK</span>
                            <span class="fw-semibold text-dark">{{ substr($item->no_ktp, 0, 6) }}******</span> {{-- Sensor NIK --}}
                        </div>
                        <div class="d-flex justify-content-between mb-2 small">
                            <span class="text-muted"><i class="fas fa-phone-alt me-2"></i>Telp</span>
                            <span class="text-dark">{{ $item->telp ?? '-' }}</span>
                        </div>
                        <div class="d-flex justify-content-between small">
                            <span class="text-muted"><i class="far fa-envelope me-2"></i>Email</span>
                            <span class="text-dark text-truncate" style="max-width: 120px;" title="{{ $item->email }}">{{ $item->email ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="card-footer bg-white border-top-0 pt-0 pb-3">
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ route('pages.warga.edit', $item->warga_id) }}" class="btn btn-sm btn-outline-warning w-50">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <form action="{{ route('pages.warga.destroy', $item->warga_id) }}" method="POST" class="w-50">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger w-100" onclick="return confirm('Yakin ingin menghapus data warga ini?')">
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
                    <i class="fas fa-users-slash fa-3x text-muted opacity-50"></i>
                </div>
                <h5 class="text-muted">Data warga tidak ditemukan.</h5>
                <p class="text-muted small mb-3">Coba ubah kata kunci pencarian atau tambahkan data baru.</p>
                <a href="{{ route('pages.warga.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-user-plus me-1"></i> Tambah Warga
                </a>
            </div>
        </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-between align-items-center mt-4 bg-light p-3 rounded">
        <small class="text-muted">
            Menampilkan {{ $dataWarga->firstItem() ?? 0 }} - {{ $dataWarga->lastItem() ?? 0 }} dari {{ $dataWarga->total() }} data
        </small>
        <div>
            {{ $dataWarga->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>

{{-- EXTRA STYLE --}}
@push('styles')
<style>
    .avatar-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: bold;
        text-transform: uppercase;
    }
    .hover-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-card:hover {
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