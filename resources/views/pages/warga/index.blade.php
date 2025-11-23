@extends('layouts.app')

@section('title', 'FDPR - Data Warga')

@section('content')
<!-- Data Warga Start -->
<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Data Warga</h2>
            <p class="mb-0">List data seluruh warga desa</p>
        </div>
        <div>
            <a href="{{ route('pages.warga.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-2"></i>Tambah Warga
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
        <form method="GET" action="{{ route('pages.warga.index') }}" class="mb-4">
            <div class="row g-3 align-items-center">
                <!-- Search -->
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               value="{{ request('search') }}" placeholder="Cari nama, no KTP, email...">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Filters -->
                <div class="col-md-6">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Jenis Kelamin</option>
                                <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="agama" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Agama</option>
                                <option value="Islam" {{ request('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ request('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ request('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ request('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ request('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ request('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="pekerjaan" class="form-control"
                                   value="{{ request('pekerjaan') }}" placeholder="Pekerjaan" onchange="this.form.submit()">
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
                            <a href="{{ route('pages.warga.index') }}" class="btn btn-secondary w-100">Reset</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Info Showing -->
        <div class="mb-3 text-muted">
            Menampilkan {{ $dataWarga->firstItem() ?? 0 }} - {{ $dataWarga->lastItem() ?? 0 }} dari {{ $dataWarga->total() }} data
        </div>

        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">No</th>
                        <th scope="col">No KTP</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Agama</th>
                        <th scope="col">Pekerjaan</th>
                        <th scope="col">Telp</th>
                        <th scope="col">Email</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataWarga as $item)
                    <tr>
                        <td>{{ $loop->iteration + (($dataWarga->currentPage() - 1) * $dataWarga->perPage()) }}</td>
                        <td>{{ $item->no_ktp }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jenis_kelamin }}</td>
                        <td>{{ $item->agama }}</td>
                        <td>{{ $item->pekerjaan }}</td>
                        <td>{{ $item->telp }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('pages.warga.edit', $item->warga_id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('pages.warga.destroy', $item->warga_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">Tidak ada data ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $dataWarga->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
<!-- Data Warga End -->
@endsection
