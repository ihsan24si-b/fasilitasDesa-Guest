@extends('layouts.app')

@section('title', 'FDPR - Detail Fasilitas')
@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Detail Fasilitas</h2>
            <p class="mb-0">Informasi lengkap fasilitas</p>
        </div>
        <div><a href="{{ route('pages.fasilitas.index') }}" class="btn btn-secondary">Kembali</a></div>
    </div>

    <div class="row">
        {{-- KOLOM KIRI: Foto & Info Utama --}}
        <div class="col-lg-6 mb-4">
            {{-- Carousel Galeri Foto --}}
            <div class="card mb-4">
                <div class="card-body p-2">
                    @if($fasilitas->media->count() > 0)
                        <div id="carouselFasilitas" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner rounded">
                                @foreach($fasilitas->media as $key => $foto)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        {{-- Pastikan path asset sesuai penyimpanan --}}
                                        <img src="{{ asset('storage/media/' . $foto->file_name) }}" class="d-block w-100" style="height: 300px; object-fit: cover;" alt="Foto Fasilitas">
                                    </div>
                                @endforeach
                            </div>
                            @if($fasilitas->media->count() > 1)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselFasilitas" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselFasilitas" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </button>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-5 bg-light text-muted">
                            <i class="fas fa-image fa-3x mb-2"></i>
                            <p>Tidak ada foto tersedia</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Info Text (Nama, Alamat, dll) sama seperti sebelumnya --}}
            <div class="card">
                <div class="card-header bg-primary text-white">Informasi</div>
                <div class="card-body">
                    <p><strong>Nama:</strong> {{ $fasilitas->nama }}</p>
                    <p><strong>Jenis:</strong> <span class="badge bg-info">{{ ucfirst($fasilitas->jenis) }}</span></p>
                    <p><strong>Alamat:</strong> {{ $fasilitas->alamat }} (RT {{ $fasilitas->rt }} / RW {{ $fasilitas->rw }})</p>
                    <p><strong>Kapasitas:</strong> {{ $fasilitas->kapasitas }} Orang</p>
                    <p><strong>Deskripsi:</strong> {{ $fasilitas->deskripsi ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: Syarat --}}
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-success text-white">Syarat Penggunaan</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($fasilitas->syaratFasilitas as $syarat)
                            <li class="list-group-item">
                                <strong>{{ $syarat->nama_syarat }}</strong>
                                <br><small class="text-muted">{{ $syarat->deskripsi }}</small>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted">Tidak ada syarat khusus.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 text-end">
        <a href="{{ route('pages.fasilitas.edit', $fasilitas->fasilitas_id) }}" class="btn btn-warning">Edit</a>
    </div>
</div>
@endsection
