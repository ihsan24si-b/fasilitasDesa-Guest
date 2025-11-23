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

    
    <div class="bg-light rounded p-4">
        <!-- Search & Filter Form -->
        <form method="GET" action="{{ route('pages.fasilitas.index') }}" class="mb-4">
            <div class="row g-3 align-items-center">
                <!-- Search -->
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               value="{{ request('search') }}" placeholder="Cari nama, alamat...">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Filters -->
                <div class="col-md-6">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <select name="jenis" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Jenis</option>
                                <option value="aula" {{ request('jenis') == 'aula' ? 'selected' : '' }}>Aula</option>
                                <option value="lapangan" {{ request('jenis') == 'lapangan' ? 'selected' : '' }}>Lapangan</option>
                                <option value="gedung" {{ request('jenis') == 'gedung' ? 'selected' : '' }}>Gedung</option>
                                <option value="taman" {{ request('jenis') == 'taman' ? 'selected' : '' }}>Taman</option>
                                <option value="lainnya" {{ request('jenis') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="rt" class="form-control"
                                   value="{{ request('rt') }}" placeholder="RT" onchange="this.form.submit()" maxlength="3">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="rw" class="form-control"
                                   value="{{ request('rw') }}" placeholder="RW" onchange="this.form.submit()" maxlength="3">
                        </div>
                    </div>
                </div>

                <!-- Show Entries & Reset -->
                <div class="col-md-2">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <select name="perPage" class="form-select" onchange="this.form.submit()">
                                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('pages.fasilitas.index') }}" class="btn btn-secondary w-100">Reset</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Info Showing -->
        <div class="mb-3 text-muted">
            Menampilkan {{ $dataFasilitas->firstItem() ?? 0 }} - {{ $dataFasilitas->lastItem() ?? 0 }} dari {{ $dataFasilitas->total() }} data
        </div>

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
                    @forelse ($dataFasilitas as $item)
                    <tr>
                        <td>{{ $loop->iteration + (($dataFasilitas->currentPage() - 1) * $dataFasilitas->perPage()) }}</td>
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
                        <td>{{ Str::limit($item->alamat, 50) }}</td>
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
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $dataFasilitas->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
<!-- Data Fasilitas End -->
@endsection
