@extends('layouts.app')

@section('title', 'FDPR - Data Fasilitas')

@section('content')
<!-- Data Fasilitas Start -->
<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Data Fasilitas</h2>
            <p class="mb-0">List data seluruh fasilitas desa</p>
        </div>
        <div>
            <a href="{{ route('pages.fasilitas.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-2"></i>Tambah Fasilitas
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="bg-light text-center rounded p-4">
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">No</th>
                        <th scope="col">Nama Fasilitas</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">RT/RW</th>
                        <th scope="col">Kapasitas</th>
                        <th scope="col">Jumlah Syarat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataFasilitas as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>
                            @if($item->jenis == 'aula')
                                <span class="badge bg-primary">Aula</span>
                            @elseif($item->jenis == 'lapangan')
                                <span class="badge bg-success">Lapangan</span>
                            @elseif($item->jenis == 'gedung')
                                <span class="badge bg-info">Gedung</span>
                            @elseif($item->jenis == 'taman')
                                <span class="badge bg-warning">Taman</span>
                            @else
                                <span class="badge bg-secondary">Lainnya</span>
                            @endif
                        </td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->rt }}/{{ $item->rw }}</td>
                        <td>{{ $item->kapasitas }} orang</td>
                        <td>
                            <span class="badge bg-info">{{ $item->syaratFasilitas->count() }} syarat</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('pages.fasilitas.show', $item->fasilitas_id) }}"
                                   class="btn btn-info btn-sm"
                                   title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('pages.fasilitas.edit', $item->fasilitas_id) }}"
                                   class="btn btn-warning btn-sm"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('pages.fasilitas.destroy', $item->fasilitas_id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus fasilitas ini?')"
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Data Fasilitas End -->
@endsection
