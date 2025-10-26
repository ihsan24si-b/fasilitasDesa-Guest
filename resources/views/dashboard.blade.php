@extends('layouts.app')

@section('title', 'Fasilitas Desa dan Peminjaman Ruang')

@push('styles')
    <style>
        #jenis-fasilitas-chart,
        #peminjaman-bulanan-chart {
            height: 300px !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Chart Jenis Fasilitas
        document.addEventListener('DOMContentLoaded', function() {
            const jenisFasilitasCtx = document.getElementById('jenis-fasilitas-chart');
            if (jenisFasilitasCtx) {
                const jenisFasilitasChart = new Chart(jenisFasilitasCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Aula', 'Lapangan', 'Gedung', 'Taman', 'Lainnya'],
                        datasets: [{
                            data: [5, 3, 2, 2, 3],
                            backgroundColor: [
                                '#4e73df',
                                '#1cc88a',
                                '#36b9cc',
                                '#f6c23e',
                                '#e74a3b'
                            ],
                            hoverBackgroundColor: [
                                '#2e59d9',
                                '#17a673',
                                '#2c9faf',
                                '#dda20a',
                                '#be2617'
                            ],
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }

            // Chart Peminjaman Bulanan
            const peminjamanBulananCtx = document.getElementById('peminjaman-bulanan-chart');
            if (peminjamanBulananCtx) {
                const peminjamanBulananChart = new Chart(peminjamanBulananCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt',
                            'Nov', 'Des'
                        ],
                        datasets: [{
                            label: 'Jumlah Peminjaman',
                            backgroundColor: '#4e73df',
                            hoverBackgroundColor: '#2e59d9',
                            borderColor: '#4e73df',
                            data: [12, 15, 8, 10, 18, 22, 25, 20, 17, 14, 16, 19],
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush


@section('content')
    <!-- Statistik Fasilitas Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-building fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Fasilitas</p>
                        <h6 class="mb-0">15</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-calendar-check fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Peminjaman Aktif</p>
                        <h6 class="mb-0">8</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-users fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Warga Terdaftar</p>
                        <h6 class="mb-0">245</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-check-circle fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Tersedia</p>
                        <h6 class="mb-0">7 Fasilitas</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Statistik Fasilitas End -->

    <!-- Charts Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Jenis Fasilitas</h6>
                        <a href="">Show All</a>
                    </div>
                    <canvas id="jenis-fasilitas-chart"></canvas>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Peminjaman Bulanan</h6>
                        <a href="">Show All</a>
                    </div>
                    <canvas id="peminjaman-bulanan-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Charts End -->

    <!-- Daftar Fasilitas Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Daftar Fasilitas Desa</h6>
                <a href="">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            <th scope="col">Nama Fasilitas</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Lokasi (RT/RW)</th>
                            <th scope="col">Kapasitas</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Balai Desa Mekar Sari</td>
                            <td>Aula</td>
                            <td>01/01</td>
                            <td>100 orang</td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                                <a class="btn btn-sm btn-warning" href="">Pinjam</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Lapangan Serbaguna</td>
                            <td>Lapangan</td>
                            <td>02/01</td>
                            <td>200 orang</td>
                            <td><span class="badge bg-warning">Dipinjam</span></td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                                <a class="btn btn-sm btn-secondary" href="" disabled>Tidak
                                    Tersedia</a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Aula Pertemuan RW 03</td>
                            <td>Aula</td>
                            <td>03/01</td>
                            <td>80 orang</td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                                <a class="btn btn-sm btn-warning" href="">Pinjam</a>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Gedung Olahraga</td>
                            <td>Gedung</td>
                            <td>01/02</td>
                            <td>150 orang</td>
                            <td><span class="badge bg-success">Tersedia</span></td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                                <a class="btn btn-sm btn-warning" href="">Pinjam</a>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Taman Bermain Anak</td>
                            <td>Taman</td>
                            <td>02/02</td>
                            <td>50 anak</td>
                            <td><span class="badge bg-info">Perawatan</span></td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="">Detail</a>
                                <a class="btn btn-sm btn-secondary" href="" disabled>Dalam
                                    Perawatan</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Daftar Fasilitas End -->

    <!-- Peminjaman Terbaru Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Peminjaman Terbaru</h6>
                <a href="">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Peminjam</th>
                            <th scope="col">Fasilitas</th>
                            <th scope="col">Tgl Penggunaan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>15 Jan 2024</td>
                            <td>Budi Santoso</td>
                            <td>Balai Desa Mekar Sari</td>
                            <td>20 Jan 2024</td>
                            <td><span class="badge bg-success">Disetujui</span></td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>14 Jan 2024</td>
                            <td>Siti Rahayu</td>
                            <td>Aula Pertemuan RW 03</td>
                            <td>18 Jan 2024</td>
                            <td><span class="badge bg-warning">Menunggu</span></td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>13 Jan 2024</td>
                            <td>Ahmad Fauzi</td>
                            <td>Lapangan Serbaguna</td>
                            <td>22 Jan 2024</td>
                            <td><span class="badge bg-danger">Ditolak</span></td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>12 Jan 2024</td>
                            <td>Maya Sari</td>
                            <td>Gedung Olahraga</td>
                            <td>25 Jan 2024</td>
                            <td><span class="badge bg-success">Disetujui</span></td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>11 Jan 2024</td>
                            <td>Rudi Hermawan</td>
                            <td>Balai Desa Mekar Sari</td>
                            <td>28 Jan 2024</td>
                            <td><span class="badge bg-warning">Menunggu</span></td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Peminjaman Terbaru End -->
@endsection
