@extends('layouts.app')

@section('title', 'FDPR - Tambah Fasilitas')

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold">Tambah Fasilitas</h2>
            <p class="mb-0 text-muted">Input data fasilitas desa baru.</p>
        </div>
        <a href="{{ route('pages.fasilitas.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    {{-- MAIN FORM CARD --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 text-primary"><i class="fas fa-edit me-2"></i>Formulir Data</h5>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('pages.fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-4">
                    {{-- KOLOM KIRI: Identitas --}}
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Fasilitas <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Balai Desa Sukamaju" required>
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jenis <span class="text-danger">*</span></label>
                                <select class="form-select @error('jenis') is-invalid @enderror" name="jenis" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="aula" {{ old('jenis') == 'aula' ? 'selected' : '' }}>Aula</option>
                                    <option value="lapangan" {{ old('jenis') == 'lapangan' ? 'selected' : '' }}>Lapangan</option>
                                    <option value="gedung" {{ old('jenis') == 'gedung' ? 'selected' : '' }}>Gedung</option>
                                    <option value="taman" {{ old('jenis') == 'taman' ? 'selected' : '' }}>Taman</option>
                                    <option value="lainnya" {{ old('jenis') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kapasitas (Org) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="kapasitas" value="{{ old('kapasitas') }}" min="1" placeholder="0" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="alamat" rows="2" placeholder="Jl. Raya Desa..." required>{{ old('alamat') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold">RT</label>
                                <input type="text" class="form-control" name="rt" value="{{ old('rt') }}" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label fw-bold">RW</label>
                                <input type="text" class="form-control" name="rw" value="{{ old('rw') }}" required>
                            </div>
                        </div>
                    </div>

                    {{-- KOLOM KANAN: Deskripsi & Foto --}}
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi Tambahan</label>
                            <textarea class="form-control" name="deskripsi" rows="4" placeholder="Jelaskan kondisi atau info tambahan...">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="card bg-light border-dashed">
                            <div class="card-body text-center p-4">
                                <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                <h6 class="fw-bold">Upload Foto Fasilitas</h6>
                                <p class="text-muted small mb-3">Format: JPG, PNG (Max 2MB per file). Bisa pilih banyak.</p>
                                <input type="file" class="form-control" name="photos[]" multiple accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                {{-- SYARAT PENGGUNAAN (Dynamic) --}}
                <div class="card border-primary mb-4">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="fas fa-list-check me-2"></i>Syarat & Ketentuan Peminjaman</h6>
                        <button type="button" class="btn btn-sm btn-light text-primary fw-bold" onclick="tambahSyarat()">
                            <i class="fas fa-plus me-1"></i> Tambah
                        </button>
                    </div>
                    <div class="card-body bg-light">
                        <div id="syarat-container"></div>
                        <small class="text-muted fst-italic">* Klik tombol "Tambah" di kanan atas untuk memasukkan syarat.</small>
                    </div>
                </div>

                {{-- BUTTONS --}}
                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i>Simpan Data</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .border-dashed {
        border: 2px dashed #ced4da;
        border-radius: 10px;
    }
</style>
@endpush

@push('scripts')
<script>
let syaratCount = 0;
function tambahSyarat() {
    syaratCount++;
    const html = `
        <div class="card mb-2 shadow-sm border-0" id="syarat-${syaratCount}">
            <div class="card-body p-2">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <input type="text" class="form-control form-control-sm" name="syarat_nama[]" placeholder="Judul Syarat (Wajib)" required>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control form-control-sm" name="syarat_deskripsi[]" placeholder="Deskripsi/Keterangan tambahan (Opsional)">
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
// Tambah 1 kolom otomatis saat load
document.addEventListener('DOMContentLoaded', () => tambahSyarat());
</script>
@endpush