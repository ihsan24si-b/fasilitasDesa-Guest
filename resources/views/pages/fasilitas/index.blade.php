@extends('layouts.app')

@section('title', 'FDPR - Data Fasilitas')

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- TITLE SECTION --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold"><i class="fas fa-building me-2"></i>Data Fasilitas</h2>
            <p class="text-muted mb-0">Daftar aset dan fasilitas umum desa yang tersedia.</p>
        </div>
        <div>
            <a href="{{ route('pages.fasilitas.create') }}" class="btn btn-primary rounded-pill shadow-sm">
                <i class="fas fa-plus me-2"></i>Tambah Baru
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

    {{-- FILTER & SEARCH SECTION --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('pages.fasilitas.index') }}">
                <div class="row g-3">
                    {{-- Search --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control bg-light border-start-0"
                                   value="{{ request('search') }}" placeholder="Cari nama atau alamat...">
                        </div>
                    </div>

                    {{-- Filter Jenis --}}
                    <div class="col-lg-3 col-md-3">
                        <select name="jenis" class="form-select bg-light" onchange="this.form.submit()">
                            <option value="">-- Semua Jenis --</option>
                            <option value="aula" {{ request('jenis') == 'aula' ? 'selected' : '' }}>Aula</option>
                            <option value="lapangan" {{ request('jenis') == 'lapangan' ? 'selected' : '' }}>Lapangan</option>
                            <option value="gedung" {{ request('jenis') == 'gedung' ? 'selected' : '' }}>Gedung</option>
                            <option value="taman" {{ request('jenis') == 'taman' ? 'selected' : '' }}>Taman</option>
                            <option value="lainnya" {{ request('jenis') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    {{-- Filter RT/RW --}}
                    <div class="col-lg-3 col-md-3">
                        <div class="input-group">
                            <input type="text" name="rt" class="form-control bg-light" placeholder="RT" value="{{ request('rt') }}" maxlength="3">
                            <span class="input-group-text bg-light">/</span>
                            <input type="text" name="rw" class="form-control bg-light" placeholder="RW" value="{{ request('rw') }}" maxlength="3">
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="col-lg-2 col-md-12 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1"><i class="fas fa-filter"></i></button>
                        <a href="{{ route('pages.fasilitas.index') }}" class="btn btn-outline-secondary" title="Reset Filter"><i class="fas fa-sync-alt"></i></a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- GRID CARD LISTING --}}
    <div class="row g-4">
        @forelse ($dataFasilitas as $item)
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm hover-card">
                
                {{-- GAMBAR THUMBNAIL --}}
                <div class="position-relative">
                    @php
                        // Ambil gambar pertama dari relasi media
                        $media = $item->media->first();
                        // Logika path gambar
                        if($media) {
                            // Cek path apakah dari storage/media atau assets
                            $imgUrl = asset('storage/media/' . $media->file_name);
                        } else {
                            $imgUrl = asset('assets/img/placeholder.jpg'); // Pastikan file placeholder ada
                        }
                    @endphp
                    
                    <img src="{{ $imgUrl }}" 
                         class="card-img-top" 
                         alt="{{ $item->nama }}" 
                         style="height: 180px; object-fit: cover;"
                         onerror="this.onerror=null; this.src='{{ asset('assets/img/placeholder.jpg') }}';">
                    
                    {{-- Badge Jenis di pojok kiri atas gambar --}}
                    <span class="position-absolute top-0 start-0 m-2 badge rounded-pill 
                        @if($item->jenis == 'aula') bg-primary
                        @elseif($item->jenis == 'lapangan') bg-success
                        @elseif($item->jenis == 'gedung') bg-info text-dark
                        @elseif($item->jenis == 'taman') bg-warning text-dark
                        @else bg-secondary @endif">
                        {{ strtoupper($item->jenis) }}
                    </span>
                </div>

                {{-- CARD BODY --}}
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-1 text-truncate" title="{{ $item->nama }}">{{ $item->nama }}</h5>
                    <p class="text-muted small mb-3"><i class="fas fa-map-marker-alt me-1 text-danger"></i> RT {{ $item->rt }} / RW {{ $item->rw }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center bg-light rounded p-2 mb-3">
                        <div class="text-center w-50 border-end">
                            <small class="d-block text-muted" style="font-size: 0.7rem;">KAPASITAS</small>
                            <span class="fw-bold">{{ $item->kapasitas }} Org</span>
                        </div>
                        <div class="text-center w-50">
                            <small class="d-block text-muted" style="font-size: 0.7rem;">SYARAT</small>
                            <span class="fw-bold text-primary">{{ $item->syaratFasilitas->count() }} Item</span>
                        </div>
                    </div>

                    <p class="card-text text-muted small text-truncate">{{ $item->alamat }}</p>
                </div>

                {{-- CARD FOOTER (ACTIONS) --}}
                <div class="card-footer bg-white border-top-0 pt-0 pb-3">
                    <div class="d-flex gap-2">
                        <a href="{{ route('pages.fasilitas.show', $item->fasilitas_id) }}" class="btn btn-sm btn-outline-info flex-grow-1">
                            <i class="fas fa-eye me-1"></i> Detail
                        </a>
                        <a href="{{ route('pages.fasilitas.edit', $item->fasilitas_id) }}" class="btn btn-sm btn-outline-warning flex-grow-1">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        
                        <form action="{{ route('pages.fasilitas.destroy', $item->fasilitas_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus fasilitas ini beserta fotonya?')" title="Hapus">
                                <i class="fas fa-trash"></i>
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
                    <i class="fas fa-box-open fa-3x text-muted opacity-50"></i>
                </div>
                <h5 class="text-muted">Belum ada data fasilitas.</h5>
                <p class="text-muted small mb-3">Silakan tambahkan data baru untuk memulai.</p>
                <a href="{{ route('pages.fasilitas.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus me-1"></i> Tambah Data
                </a>
            </div>
        </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-between align-items-center mt-4 bg-light p-3 rounded">
        <small class="text-muted">
            Menampilkan {{ $dataFasilitas->firstItem() ?? 0 }} - {{ $dataFasilitas->lastItem() ?? 0 }} dari {{ $dataFasilitas->total() }} data
        </small>
        <div>
            {{ $dataFasilitas->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>

{{-- EXTRA STYLE FOR HOVER EFFECT --}}
@push('styles')
<style>
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