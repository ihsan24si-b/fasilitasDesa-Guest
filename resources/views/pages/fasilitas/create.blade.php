@extends('layouts.app')

@section('title', 'FDPR - Tambah Fasilitas')
@section('content')

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
            {{-- PENTING: enctype ditambahkan untuk upload file --}}
            <form action="{{ route('pages.fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Fasilitas <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis Fasilitas <span class="text-danger">*</span></label>
                            <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="aula" {{ old('jenis') == 'aula' ? 'selected' : '' }}>Aula</option>
                                <option value="lapangan" {{ old('jenis') == 'lapangan' ? 'selected' : '' }}>Lapangan</option>
                                <option value="gedung" {{ old('jenis') == 'gedung' ? 'selected' : '' }}>Gedung</option>
                                <option value="taman" {{ old('jenis') == 'taman' ? 'selected' : '' }}>Taman</option>
                                <option value="lainnya" {{ old('jenis') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('jenis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                            @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- INPUT FILE BARU --}}
                        <div class="mb-3">
                            <label for="photos" class="form-label">Foto Fasilitas (Bisa pilih banyak)</label>
                            <input type="file" class="form-control @error('photos') is-invalid @enderror" id="photos" name="photos[]" multiple accept="image/*">
                            <div class="form-text">Format: jpg, jpeg, png. Maks: 2MB per foto.</div>
                            @error('photos.*') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="rt" class="form-label">RT <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('rt') is-invalid @enderror" id="rt" name="rt" value="{{ old('rt') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="rw" class="form-label">RW <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('rw') is-invalid @enderror" id="rw" name="rw" value="{{ old('rw') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="kapasitas" class="form-label">Kapasitas (orang) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('kapasitas') is-invalid @enderror" id="kapasitas" name="kapasitas" value="{{ old('kapasitas') }}" min="1" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- SECTION SYARAT (Sama seperti sebelumnya, saya ringkas script-nya di bawah) --}}
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="fas fa-list-check me-2"></i>Syarat Penggunaan</h5>
                            </div>
                            <div class="card-body">
                                <div id="syarat-container"></div>
                                <button type="button" class="btn btn-outline-primary btn-sm mt-3" onclick="tambahSyarat()">
                                    <i class="fas fa-plus me-1"></i>Tambah Syarat
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
let syaratCount = 0;
function tambahSyarat() {
    syaratCount++;
    const html = `
        <div class="border rounded p-3 mb-3" id="syarat-${syaratCount}">
            <div class="row">
                <div class="col-md-5 mb-2"><input type="text" class="form-control" name="syarat_nama[]" placeholder="Nama Syarat" required></div>
                <div class="col-md-6 mb-2"><textarea class="form-control" name="syarat_deskripsi[]" rows="1" placeholder="Deskripsi"></textarea></div>
                <div class="col-md-1"><button type="button" class="btn btn-danger w-100" onclick="document.getElementById('syarat-${syaratCount}').remove()"><i class="fas fa-trash"></i></button></div>
            </div>
        </div>`;
    document.getElementById('syarat-container').insertAdjacentHTML('beforeend', html);
}
document.addEventListener('DOMContentLoaded', () => tambahSyarat());
</script>
@endpush
