@extends('layouts.app')

@section('title', 'FDPR - Detail Fasilitas')

@section('content')
<!-- Detail Fasilitas Start -->
<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Detail Fasilitas</h2>
            <p class="mb-0">Informasi lengkap fasilitas dan syarat penggunaan</p>
        </div>
        <div>
            <a href="{{ route('pages.fasilitas.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Informasi Fasilitas -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Fasilitas
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Nama Fasilitas:</div>
                        <div class="col-sm-8">{{ $fasilitas->nama }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Jenis:</div>
                        <div class="col-sm-8">
                            @if($fasilitas->jenis == 'aula')
                                <span class="badge bg-primary">Aula</span>
                            @elseif($fasilitas->jenis == 'lapangan')
                                <span class="badge bg-success">Lapangan</span>
                            @elseif($fasilitas->jenis == 'gedung')
                                <span class="badge bg-info">Gedung</span>
                            @elseif($fasilitas->jenis == 'taman')
                                <span class="badge bg-warning">Taman</span>
                            @else
                                <span class="badge bg-secondary">Lainnya</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Alamat:</div>
                        <div class="col-sm-8">{{ $fasilitas->alamat }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">RT/RW:</div>
                        <div class="col-sm-8">{{ $fasilitas->rt }}/{{ $fasilitas->rw }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Kapasitas:</div>
                        <div class="col-sm-8">{{ $fasilitas->kapasitas }} orang</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Deskripsi:</div>
                        <div class="col-sm-8">
                            @if($fasilitas->deskripsi)
                                {{ $fasilitas->deskripsi }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 fw-bold">Dibuat:</div>
                        <div class="col-sm-8">{{ $fasilitas->created_at->format('d M Y H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Syarat -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-list-check me-2"></i>
                        Syarat Penggunaan
                        <span class="badge bg-light text-dark ms-2">{{ $fasilitas->syaratFasilitas->count() }}</span>
                    </h5>
                </div>
                <div class="card-body">
                    @if($fasilitas->syaratFasilitas->count() > 0)
                        <div class="list-group">
                            @foreach($fasilitas->syaratFasilitas as $index => $syarat)
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">
                                            <span class="badge bg-primary me-2">{{ $loop->iteration }}</span>
                                            {{ $syarat->nama_syarat }}
                                        </h6>
                                        @if($syarat->deskripsi)
                                            <p class="mb-1 text-muted small">{{ $syarat->deskripsi }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-exclamation-circle fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada syarat penggunaan untuk fasilitas ini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex gap-2 justify-content-end">
                <a href="{{ route('pages.fasilitas.edit', $fasilitas->fasilitas_id) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>Edit Fasilitas
                </a>
                <a href="{{ route('pages.fasilitas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-list me-2"></i>Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Detail Fasilitas End -->
@endsection
