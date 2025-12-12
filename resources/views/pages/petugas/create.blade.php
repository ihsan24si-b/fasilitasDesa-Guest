@extends('layouts.app')

@section('title', 'Tambah Petugas')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4" style="max-width: 800px; margin: 0 auto;">
        <div class="d-flex justify-content-between mb-4">
            <h4 class="mb-0">Assign Petugas Baru</h4>
            <a href="{{ route('pages.petugas.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('pages.petugas.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Fasilitas</label>
                <select class="form-select" name="fasilitas_id" required>
                    <option value="">-- Pilih Fasilitas --</option>
                    @foreach ($fasilitas as $f)
                        <option value="{{ $f->fasilitas_id }}">{{ $f->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Warga (Petugas)</label>
                <select class="form-select" name="warga_id" required>
                    <option value="">-- Pilih Warga --</option>
                    @foreach ($warga as $w)
                        <option value="{{ $w->warga_id }}">{{ $w->nama }} ({{ $w->pekerjaan }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Peran / Jabatan</label>
                <div class="row g-3">
                    @foreach(['Penanggung Jawab', 'Operasional', 'Keamanan', 'Kebersihan'] as $role)
                    <div class="col-md-6">
                        <div class="form-check p-3 border rounded bg-white">
                            <input class="form-check-input" type="radio" name="peran" id="role_{{ $loop->index }}" value="{{ $role }}" required>
                            <label class="form-check-label w-100 stretched-link fw-bold" for="role_{{ $loop->index }}">
                                {{ $role }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2"><i class="fas fa-save me-2"></i>Simpan Data Petugas</button>
        </form>
    </div>
</div>
@endsection