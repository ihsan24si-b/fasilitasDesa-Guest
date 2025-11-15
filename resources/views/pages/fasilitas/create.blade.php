@extends('layouts.app')

@section('title', 'FDPR - Tambah Fasilitas')
@section('content')
<!-- Tambah Fasilitas Start Main Conent -->

    <div class="container-fluid pt-4 px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Tambah Fasilitas</h2>
                <p class="mb-0">Form untuk menambahkan fasilitas baru</p>
            </div>
            <div>
                <a href="{{ route('pages.fasilitas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        <div class="bg-light rounded p-4">
            <form action="{{ route('pages.fasilitas.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Fasilitas <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis Fasilitas <span
                                    class="text-danger">*</span></label>
                            <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis"
                                required>
                                <option value="">-- Pilih Jenis Fasilitas --</option>
                                <option value="aula" {{ old('jenis') == 'aula' ? 'selected' : '' }}>Aula</option>
                                <option value="lapangan" {{ old('jenis') == 'lapangan' ? 'selected' : '' }}>Lapangan
                                </option>
                                <option value="gedung" {{ old('jenis') == 'gedung' ? 'selected' : '' }}>Gedung</option>
                                <option value="taman" {{ old('jenis') == 'taman' ? 'selected' : '' }}>Taman</option>
                                <option value="lainnya" {{ old('jenis') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Lengkap <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                                required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rt" class="form-label">RT <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('rt') is-invalid @enderror"
                                        id="rt" name="rt" value="{{ old('rt') }}" required>
                                    @error('rt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rw" class="form-label">RW <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('rw') is-invalid @enderror"
                                        id="rw" name="rw" value="{{ old('rw') }}" required>
                                    @error('rw')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="kapasitas" class="form-label">Kapasitas (orang) <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('kapasitas') is-invalid @enderror"
                                id="kapasitas" name="kapasitas" value="{{ old('kapasitas') }}" min="1" required>
                            @error('kapasitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ================================ --}}
                {{-- SECTION BARU: SYARAT FASILITAS --}}
                {{-- ================================ --}}
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-list-check me-2"></i>Syarat Penggunaan Fasilitas
                                </h5>
                            </div>
                            <div class="card-body">
                                <div id="syarat-container">
                                    {{-- Syarat akan ditambahkan dinamis di sini --}}
                                </div>

                                <button type="button" class="btn btn-outline-primary btn-sm mt-3" onclick="tambahSyarat()">
                                    <i class="fas fa-plus me-1"></i>Tambah Syarat
                                </button>

                                @error('syarat_nama.*')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                                @error('syarat_deskripsi.*')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Simpan Data
                        </button>
                        <a href="{{ route('pages.fasilitas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

<!-- Tambah Fasilitas End -->
@endsection

@push('scripts')
<script>
let syaratCount = 0;

function tambahSyarat() {
    syaratCount++;
    const container = document.getElementById('syarat-container');

    const syaratHtml = `
        <div class="border rounded p-3 mb-3 syarat-item" id="syarat-${syaratCount}">
            <div class="row">
                <div class="col-md-5">
                    <div class="mb-3">
                        <label class="form-label">Nama Syarat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"
                               name="syarat_nama[]"
                               placeholder="Contoh: Membawa KTP asli"
                               required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Syarat</label>
                        <textarea class="form-control"
                                  name="syarat_deskripsi[]"
                                  rows="1"
                                  placeholder="Deskripsi lengkap syarat (opsional)"></textarea>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="mb-3">
                        <label class="form-label">&nbsp;</label>
                        <button type="button" class="btn btn-danger btn-block"
                                onclick="hapusSyarat(${syaratCount})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', syaratHtml);
}

function hapusSyarat(id) {
    const element = document.getElementById(`syarat-${id}`);
    if (element) {
        element.remove();
    }
}

// Tambah satu syarat otomatis saat load
document.addEventListener('DOMContentLoaded', function() {
    tambahSyarat();
});
</script>
@endpush
