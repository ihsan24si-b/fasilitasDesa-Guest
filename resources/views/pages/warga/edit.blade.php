@extends('layouts.app')

@section('title', 'FDPR - Edit Warga')

@section('content')
<div class="container-fluid pt-4 px-4">
    
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 text-primary fw-bold">Edit Warga</h2>
            <p class="mb-0 text-muted">Perbarui data penduduk yang sudah ada.</p>
        </div>
        <a href="{{ route('pages.warga.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    {{-- MAIN FORM CARD --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning bg-opacity-10 py-3 border-bottom">
            <h5 class="mb-0 text-dark"><i class="fas fa-user-edit me-2"></i>Edit Data: {{ $dataWarga->nama }}</h5>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('pages.warga.update', $dataWarga->warga_id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    {{-- KOLOM KIRI --}}
                    <div class="col-lg-6">
                        <h6 class="text-uppercase text-muted fw-bold mb-3 small border-bottom pb-2">Identitas Pribadi</h6>
                        
                        <div class="mb-3">
                            <label for="no_ktp" class="form-label fw-bold">No. KTP (NIK)</label>
                            <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="{{ old('no_ktp', $dataWarga->no_ktp) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $dataWarga->nama) }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="jenis_kelamin" class="form-label fw-bold">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $dataWarga->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $dataWarga->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="agama" class="form-label fw-bold">Agama</label>
                                <select class="form-select" id="agama" name="agama" required>
                                    @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                        <option value="{{ $agama }}" {{ old('agama', $dataWarga->agama) == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- KOLOM KANAN --}}
                    <div class="col-lg-6">
                        <h6 class="text-uppercase text-muted fw-bold mb-3 small border-bottom pb-2">Kontak & Pekerjaan</h6>

                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label fw-bold">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $dataWarga->pekerjaan) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="telp" class="form-label fw-bold">No. Telepon / WA</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control" id="telp" name="telp" value="{{ old('telp', $dataWarga->telp) }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $dataWarga->email) }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('pages.warga.index') }}" class="btn btn-light border px-4">Batal</a>
                    <button type="submit" class="btn btn-warning text-white px-4 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection