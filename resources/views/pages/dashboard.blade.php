@extends('layouts.app')

@section('title', 'Dashboard Admin')

@push('styles')
    <style>
        #jenis-fasilitas-chart,
        #peminjaman-bulanan-chart {
            height: 300px !important;
        }
    </style>
@endpush

@push('scripts')
    {{-- Script Chart.js --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // 1. CHART JENIS FASILITAS
            const labelJenis = @json($labelJenis ?? []);
            const dataJenis  = @json($dataJenis ?? []);

            const jenisFasilitasCtx = document.getElementById('jenis-fasilitas-chart');
            if (jenisFasilitasCtx) {
                new Chart(jenisFasilitasCtx, {
                    type: 'doughnut',
                    data: {
                        labels: labelJenis.length ? labelJenis : ['Kosong'],
                        datasets: [{
                            data: dataJenis.length ? dataJenis : [1], 
                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'],
                            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#be2617', '#60616f'],
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'bottom' },
                            title: {
                                display: dataJenis.length === 0,
                                text: 'Data fasilitas masih kosong',
                                position: 'top'
                            }
                        }
                    }
                });
            }

            // 2. CHART PEMINJAMAN BULANAN
            const dataBulanan = @json($dataBulanan ?? []);

            const peminjamanBulananCtx = document.getElementById('peminjaman-bulanan-chart');
            if (peminjamanBulananCtx) {
                new Chart(peminjamanBulananCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                        datasets: [{
                            label: 'Jumlah Peminjaman',
                            backgroundColor: '#4e73df',
                            hoverBackgroundColor: '#2e59d9',
                            borderColor: '#4e73df',
                            data: dataBulanan,
                            barPercentage: 0.6,
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { precision: 0 }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 shadow-sm">
                    <i class="fa fa-building fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2 text-muted">Total Fasilitas</p>
                        <h6 class="mb-0 fw-bold">{{ $totalFasilitas ?? 0 }} Unit</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 shadow-sm">
                    <i class="fa fa-calendar-check fa-3x text-success"></i>
                    <div class="ms-3">
                        <p class="mb-2 text-muted">Sedang Dipinjam</p>
                        <h6 class="mb-0 fw-bold">{{ $peminjamanAktif ?? 0 }} Sesi</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 shadow-sm">
                    <i class="fa fa-users fa-3x text-info"></i>
                    <div class="ms-3">
                        <p class="mb-2 text-muted">Warga Terdaftar</p>
                        <h6 class="mb-0 fw-bold">{{ $totalWarga ?? 0 }} Orang</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 shadow-sm">
                    <i class="fas fa-chair fa-3x text-warning"></i>
                    <div class="ms-3">
                        <p class="mb-2 text-muted">Total Kapasitas</p>
                        {{-- Menggunakan format angka ribuan --}}
                        <h6 class="mb-0 fw-bold">{{ number_format($totalKapasitas ?? 0) }} Org</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light text-center rounded p-4 shadow-sm h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Komposisi Jenis Fasilitas</h6>
                    </div>
                    <canvas id="jenis-fasilitas-chart"></canvas>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light text-center rounded p-4 shadow-sm h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Tren Peminjaman ({{ date('Y') }})</h6>
                    </div>
                    <canvas id="peminjaman-bulanan-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-4 px-4 pb-5">
        <div class="row g-4">
            
            {{-- TABEL KIRI: Fasilitas Terbaru (UPDATE: Kolom disesuaikan DB) --}}
            <div class="col-12 col-xl-6">
                <div class="bg-light text-center rounded p-4 shadow-sm h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Fasilitas Terbaru</h6>
                        <a href="{{ route('pages.fasilitas.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark bg-secondary bg-opacity-10">
                                    <th scope="col">Nama Fasilitas</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Kapasitas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($fasilitasTerbaru as $f)
                                <tr>
                                    <td class="fw-medium">{{ $f->nama }}</td>
                                    <td><span class="badge bg-info text-dark">{{ ucfirst($f->jenis) }}</span></td>
                                    <td>{{ $f->kapasitas }} Org</td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="text-center py-3 text-muted">Belum ada data fasilitas.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- TABEL KANAN: Peminjaman Terbaru --}}
            <div class="col-12 col-xl-6">
                <div class="bg-light text-center rounded p-4 shadow-sm h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Peminjaman Terkini</h6>
                        <a href="{{ route('pages.peminjaman.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark bg-secondary bg-opacity-10">
                                    <th scope="col">Peminjam</th>
                                    <th scope="col">Fasilitas</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($peminjamanTerbaru as $p)
                                <tr>
                                    <td class="fw-medium">{{ $p->warga->nama ?? 'Warga Dihapus' }}</td>
                                    <td>{{ $p->fasilitas->nama ?? 'Fasilitas Dihapus' }}</td>
                                    <td>
                                        @if($p->status == 'disetujui')
                                            <span class="badge bg-success">Disetujui</span>
                                        @elseif($p->status == 'pending')
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        @elseif($p->status == 'ditolak')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @elseif($p->status == 'selesai')
                                            <span class="badge bg-secondary text-white">Selesai</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($p->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="text-center py-3 text-muted">Belum ada transaksi.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endsection