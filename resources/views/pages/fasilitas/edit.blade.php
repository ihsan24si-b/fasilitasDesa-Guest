@extends('layouts.app')

@section('title', 'FDPR - Edit Fasilitas')
@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Edit Fasilitas</h2>
            <p class="mb-0">Form untuk mengubah data fasilitas</p>
        </div>
        <div>
            <a href="{{ route('pages.fasilitas.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="bg-light rounded p-4">
        <form action="{{ route('pages.fasilitas.update', $dataFasilitas->fasilitas_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    {{-- Input Nama, Jenis, Alamat sama seperti Create, ganti value="{{ old(..., $dataFasilitas->...) }}" --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Fasilitas</label>
                        <input type="text" class="form-control" name="nama" value="{{ old('nama', $dataFasilitas->nama) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis</label>
                        <select class="form-select" name="jenis" required>
                            @foreach(['aula','lapangan','gedung','taman','lainnya'] as $j)
                                <option value="{{ $j }}" {{ old('jenis', $dataFasilitas->jenis) == $j ? 'selected' : '' }}>{{ ucfirst($j) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3" required>{{ old('alamat', $dataFasilitas->alamat) }}</textarea>
                    </div>

                    {{-- MANAJEMEN FOTO --}}
                    <div class="card mb-3 border-secondary">
                        <div class="card-header">Kelola Foto</div>
                        <div class="card-body">
                            @if($dataFasilitas->media->count() > 0)
                                <p class="small text-muted mb-2">Centang kotak di bawah foto untuk menghapusnya:</p>
                                <div class="row g-2 mb-3">
                                    @foreach($dataFasilitas->media as $foto)
                                        <div class="col-4 col-sm-3 text-center">
                                            <div class="border p-1 rounded">
                                                <img src="{{ asset('storage/media/' . $foto->file_name) }}" class="img-fluid mb-2" style="height: 80px; object-fit: cover;">
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input bg-danger border-danger" type="checkbox" name="delete_photos[]" value="{{ $foto->media_id }}" id="del_{{ $foto->media_id }}">
                                                    <label class="form-check-label ms-1 small text-danger" for="del_{{ $foto->media_id }}">Hapus</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <label class="form-label fw-bold">Tambah Foto Baru</label>
                            <input type="file" class="form-control" name="photos[]" multiple accept="image/*">
                            <div class="form-text">Pilih file baru jika ingin menambah foto.</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6 mb-3"><label>RT</label><input type="text" class="form-control" name="rt" value="{{ $dataFasilitas->rt }}" required></div>
                        <div class="col-6 mb-3"><label>RW</label><input type="text" class="form-control" name="rw" value="{{ $dataFasilitas->rw }}" required></div>
                    </div>
                    <div class="mb-3"><label>Kapasitas</label><input type="number" class="form-control" name="kapasitas" value="{{ $dataFasilitas->kapasitas }}" required></div>
                    <div class="mb-3"><label>Deskripsi</label><textarea class="form-control" name="deskripsi">{{ $dataFasilitas->deskripsi }}</textarea></div>
                </div>
            </div>

            {{-- Script Syarat (Looping data lama) --}}
            <div class="card mt-3">
                <div class="card-header bg-primary text-white">Syarat Penggunaan</div>
                <div class="card-body">
                    <div id="syarat-container">
                        @php $cnt = 0; @endphp
                        @foreach($dataFasilitas->syaratFasilitas as $syarat)
                            @php $cnt++; @endphp
                            <div class="border rounded p-3 mb-3" id="syarat-{{ $cnt }}">
                                <div class="row">
                                    <div class="col-md-5"><input type="text" class="form-control" name="syarat_nama[]" value="{{ $syarat->nama_syarat }}" required></div>
                                    <div class="col-md-6"><textarea class="form-control" name="syarat_deskripsi[]" rows="1">{{ $syarat->deskripsi }}</textarea></div>
                                    <div class="col-md-1"><button type="button" class="btn btn-danger w-100" onclick="document.getElementById('syarat-{{ $cnt }}').remove()"><i class="fas fa-trash"></i></button></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="tambahSyarat()">Tambah Syarat</button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-4">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
let syaratCount = {{ $dataFasilitas->syaratFasilitas->count() }};
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
</script>
@endpush
