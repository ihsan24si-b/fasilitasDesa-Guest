@extends('layouts.app')

@section('title', 'Edit Petugas')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4" style="max-width: 800px; margin: 0 auto;">
        <div class="d-flex justify-content-between mb-4">
            <h4 class="mb-0">Edit Data Petugas</h4>
            <a href="{{ route('pages.petugas.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>

        <form action="{{ route('pages.petugas.update', $petugas->petugas_id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label fw-bold">Fasilitas</label>
                <select class="form-select" name="fasilitas_id" required>
                    @foreach ($fasilitas as $f)
                        <option value="{{ $f->fasilitas_id }}" {{ $petugas->fasilitas_id == $f->fasilitas_id ? 'selected' : '' }}>
                            {{ $f->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Warga (Petugas)</label>
                <select class="form-select" name="warga_id" required>
                    @foreach ($warga as $w)
                        <option value="{{ $w->warga_id }}" {{ $petugas->warga_id == $w->warga_id ? 'selected' : '' }}>
                            {{ $w->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Peran / Jabatan</label>
                <select class="form-select" name="peran" required>
                    @foreach(['Penanggung Jawab', 'Operasional', 'Keamanan', 'Kebersihan'] as $role)
                        <option value="{{ $role }}" {{ $petugas->peran == $role ? 'selected' : '' }}>
                            {{ $role }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-warning text-white w-100 py-2 fw-bold">
                <i class="fas fa-edit me-2"></i>Update Data
            </button>
        </form>
    </div>
</div>
@endsection