@extends('layouts.app')

@section('title', 'FDPR - Edit Fasilitas')

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold">Edit Fasilitas</h2>
            <p class="mb-0 text-muted">Perbarui data fasilitas yang sudah ada.</p>
        </div>
        <a href="{{ route('pages.fasilitas.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    {{-- MAIN FORM CARD --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning bg-opacity-10 py-3">
            <h5 class="mb-0 text-dark"><i class="fas fa-edit me-2"></i>Edit Data: {{ $dataFasilitas->nama }}</h5>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('pages.fasilitas.update', $dataFasilitas->fasilitas_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    {{-- KOLOM KIRI --}}
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Fasilitas</label>
                            <input type="text" class="form-control" name="nama" value="{{ old('nama', $dataFasilitas->nama) }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jenis</label>
                                <select class="form-select" name="jenis" required>
                                    @foreach(['aula','lapangan','gedung','taman','lainnya'] as $j)
                                        <option value="{{ $j }}" {{ old('jenis', $dataFasilitas->jenis) == $j ? 'selected' : '' }}>{{ ucfirst($j) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kapasitas</label>
                                <input type="number" class="form-control" name="kapasitas" value="{{ $dataFasilitas->kapasitas }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="2" required>{{ old('alamat', $dataFasilitas->alamat) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3"><label class="form-label fw-bold">RT</label><input type="text" class="form-control" name="rt" value="{{ $dataFasilitas->rt }}" required></div>
                            <div class="col-6 mb-3"><label class="form-label fw-bold">RW</label><input type="text" class="form-control" name="rw" value="{{ $dataFasilitas->rw }}" required></div>
                        </div>
                    </div>

                    {{-- KOLOM KANAN: Foto --}}
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="3">{{ $dataFasilitas->deskripsi }}</textarea>
                        </div>

                        {{-- MANAJEMEN FOTO --}}
                        <div class="card bg-light border">
                            <div class="card-header bg-white fw-bold small">KELOLA FOTO</div>
                            <div class="card-body">
                                
                                {{-- List Foto Lama --}}
                                @if($dataFasilitas->media->count() > 0)
                                    <p class="small text-muted mb-2">Centang "Hapus" untuk membuang foto:</p>
                                    <div class="row g-2 mb-3">
                                        @foreach($dataFasilitas->media as $foto)
                                            <div class="col-4 col-sm-3 text-center position-relative">
                                                <div class="border p-1 bg-white rounded">
                                                    <img src="{{ asset('storage/media/' . $foto->file_name) }}" class="img-fluid rounded mb-1" style="height: 60px; object-fit: cover;">
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input border-danger" type="checkbox" name="delete_photos[]" value="{{ $foto->media_id }}" id="del_{{ $foto->media_id }}">
                                                        <label class="form-check-label ms-1 small text-danger fw-bold" style="font-size: 0.7rem;" for="del_{{ $foto->media_id }}">Hapus</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                {{-- Upload Baru --}}
                                <label class="form-label fw-bold small text-success"><i class="fas fa-plus-circle me-1"></i>Upload Foto Baru</label>
                                <input type="file" class="form-control form-control-sm" name="photos[]" multiple accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                {{-- SYARAT (Dynamic) --}}
                <div class="card border-primary mb-4">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="fas fa-list-check me-2"></i>Syarat Penggunaan</h6>
                        <button type="button" class="btn btn-sm btn-light text-primary fw-bold" onclick="tambahSyarat()">
                            <i class="fas fa-plus me-1"></i> Tambah
                        </button>
                    </div>
                    <div class="card-body bg-light">
                        <div id="syarat-container">
                            {{-- Looping Data Syarat Lama --}}
                            @php $cnt = 0; @endphp
                            @foreach($dataFasilitas->syaratFasilitas as $syarat)
                                @php $cnt++; @endphp
                                <div class="card mb-2 shadow-sm border-0" id="syarat-{{ $cnt }}">
                                    <div class="card-body p-2">
                                        <div class="row align-items-center">
                                            <div class="col-md-4">
                                                <input type="text" class="form-control form-control-sm" name="syarat_nama[]" value="{{ $syarat->nama_syarat }}" required>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control form-control-sm" name="syarat_deskripsi[]" value="{{ $syarat->deskripsi }}">
                                            </div>
                                            <div class="col-md-1 text-end">
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="document.getElementById('syarat-{{ $cnt }}').remove()">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- BUTTONS --}}
                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i>Simpan Perubahan</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let syaratCount = {{ $dataFasilitas->syaratFasilitas->count() }};
function tambahSyarat() {
    syaratCount++;
    const html = `
        <div class="card mb-2 shadow-sm border-0" id="syarat-${syaratCount}">
            <div class="card-body p-2">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <input type="text" class="form-control form-control-sm" name="syarat_nama[]" placeholder="Judul Syarat" required>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control form-control-sm" name="syarat_deskripsi[]" placeholder="Deskripsi">
                    </div>
                    <div class="col-md-1 text-end">
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="document.getElementById('syarat-${syaratCount}').remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>`;
    document.getElementById('syarat-container').insertAdjacentHTML('beforeend', html);
}
</script>
@endpush