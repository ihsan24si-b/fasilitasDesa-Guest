@extends('layouts.app')

@section('title', 'Ihsan - Edit Warga')

@section('content')
<!-- Edit Fasilitas Start -->
<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Edit Fasilitas</h2>
            <p class="mb-0">Form untuk mengubah data fasilitas</p>
        </div>
        <div>
            <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="bg-light rounded p-4">
        <form action="{{ route('fasilitas.update', $dataFasilitas->fasilitas_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Fasilitas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                               id="nama" name="nama" value="{{ old('nama', $dataFasilitas->nama) }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis Fasilitas <span class="text-danger">*</span></label>
                        <select class="form-select @error('jenis') is-invalid @enderror"
                                id="jenis" name="jenis" required>
                            <option value="">-- Pilih Jenis Fasilitas --</option>
                            <option value="aula" {{ old('jenis', $dataFasilitas->jenis) == 'aula' ? 'selected' : '' }}>Aula</option>
                            <option value="lapangan" {{ old('jenis', $dataFasilitas->jenis) == 'lapangan' ? 'selected' : '' }}>Lapangan</option>
                            <option value="gedung" {{ old('jenis', $dataFasilitas->jenis) == 'gedung' ? 'selected' : '' }}>Gedung</option>
                            <option value="taman" {{ old('jenis', $dataFasilitas->jenis) == 'taman' ? 'selected' : '' }}>Taman</option>
                            <option value="lainnya" {{ old('jenis', $dataFasilitas->jenis) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror"
                                  id="alamat" name="alamat" rows="3" required>{{ old('alamat', $dataFasilitas->alamat) }}</textarea>
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
                                       id="rt" name="rt" value="{{ old('rt', $dataFasilitas->rt) }}" required>
                                @error('rt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="rw" class="form-label">RW <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('rw') is-invalid @enderror"
                                       id="rw" name="rw" value="{{ old('rw', $dataFasilitas->rw) }}" required>
                                @error('rw')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="kapasitas" class="form-label">Kapasitas (orang) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('kapasitas') is-invalid @enderror"
                               id="kapasitas" name="kapasitas" value="{{ old('kapasitas', $dataFasilitas->kapasitas) }}" min="1" required>
                        @error('kapasitas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                  id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $dataFasilitas->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i> Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Edit Fasilitas End -->
@endsection

@push('scripts')
<script>
    // Format input no KTP
    document.getElementById('no_ktp').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Format input telepon
    document.getElementById('telp').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9+]/g, '');
    });
</script>
@endpush