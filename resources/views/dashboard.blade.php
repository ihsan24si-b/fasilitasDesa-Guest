<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fasilitas Desan dan Peminjaman Ruang</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/lib/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>
<style>
#jenis-fasilitas-chart,
#salse-revenue {
    height: 300px !important;
}
</style>
<script>
// Chart Jenis Fasilitas
const jenisFasilitasCtx = document.getElementById('jenis-fasilitas-chart').getContext('2d');
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

// Chart Peminjaman Bulanan
const peminjamanBulananCtx = document.getElementById('peminjaman-bulanan-chart').getContext('2d');
const peminjamanBulananChart = new Chart(peminjamanBulananCtx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
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
</script>
<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <<!-- Sidebar Start -->
            <div class="sidebar pe-4 pb-3">
                <nav class="navbar bg-light navbar-light">
                    <!-- Logo (pakai icon sesuai template) -->
                    <a href="{{ url('/dashboard') }}" class="navbar-brand mx-4 mb-3">
                        <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>FDPR</h3>
                    </a>

                    <!-- User Info -->
                    <div class="d-flex align-items-center ms-4 mb-4">
                        <div class="position-relative">
                            <img class="rounded-circle" src="{{ asset('assets/img/user.jpg') }}" alt="User"
                                style="width: 40px; height: 40px;">
                            <div
                                class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                            </div>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">Admin</h6>
                            <span>Admin</span>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <div class="navbar-nav w-100">
                        <a href="{{ url('/dashboard') }}" class="nav-item nav-link active">
                            <i class="fa fa-tachometer-alt me-2"></i>Dashboard
                        </a>

                        <li class="nav-item {{ Request::is('warga*') ? 'active' : '' }}">
                            <a href="{{ route('warga.index') }}" class="nav-link">
                                <span class="sidebar-icon">
                                    <i class="fas fa-users me-2"></i>
                                </span>
                                <span class="sidebar-text">Data Warga</span>
                            </a>
                        </li>

                         <li class="nav-item {{ Request::is('fasilitas*') ? 'active' : '' }}">
                            <a href="{{ route('fasilitas.index') }}" class="nav-link">
                                <span class="sidebar-icon">
                                    <i class="fas fa-users me-2"></i>
                                </span>
                                <span class="sidebar-text">Data Fasilitas</span>
                            </a>
                        </li>

                        {{-- <a href="{{ url('/forms') }}" class="nav-item nav-link">
                            <i class="fa fa-keyboard me-2"></i>Forms
                        </a>
                        <a href="{{ url('/tables') }}" class="nav-item nav-link">
                            <i class="fa fa-table me-2"></i>Tables
                        </a>
                        <a href="{{ url('/charts') }}" class="nav-item nav-link">
                            <i class="fa fa-chart-bar me-2"></i>Charts
                        </a>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="far fa-file-alt me-2"></i>Pages
                            </a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="{{ url('/signin') }}" class="dropdown-item">Sign In</a>
                                <a href="{{ url('/signup') }}" class="dropdown-item">Sign Up</a>
                                <a href="{{ url('/404') }}" class="dropdown-item">404 Error</a>
                                <a href="{{ url('/blank') }}" class="dropdown-item">Blank Page</a>
                            </div>
                        </div> --}}
                    </div>
                </nav>
            </div>
            <!-- Sidebar End -->



            <!-- Content Start -->
            <div class="content">
                <!-- Navbar Start -->
                <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                    </a>
                    <a href="#" class="sidebar-toggler flex-shrink-0">
                        <i class="fa fa-bars"></i>
                    </a>
                    <form class="d-none d-md-flex ms-4">
                        <input class="form-control border-0" type="search" placeholder="Search">
                    </form>
                    <div class="navbar-nav align-items-center ms-auto">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa fa-envelope me-lg-2"></i>
                                <span class="d-none d-lg-inline-flex">Message</span>
                            </a>
                            <div
                                class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                                <a href="#" class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle" src="{{ asset('assets/img/user.jpg') }}"
                                            alt="" style="width: 40px; height: 40px;">
                                        <div class="ms-2">
                                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                            <small>15 minutes ago</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle" src="{{ asset('assets/img/user.jpg') }}"
                                            alt="" style="width: 40px; height: 40px;">
                                        <div class="ms-2">
                                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                            <small>15 minutes ago</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle" src="{{ asset('assets/img/user.jpg') }}"
                                            alt="" style="width: 40px; height: 40px;">
                                        <div class="ms-2">
                                            <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                            <small>15 minutes ago</small>
                                        </div>
                                    </div>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item text-center">See all message</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa fa-bell me-lg-2"></i>
                                <span class="d-none d-lg-inline-flex">Notificatin</span>
                            </a>
                            <div
                                class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">Profile updated</h6>
                                    <small>15 minutes ago</small>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">New user added</h6>
                                    <small>15 minutes ago</small>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">Password changed</h6>
                                    <small>15 minutes ago</small>
                                </a>
                                <hr class="dropdown-divider">
                                <a href="#" class="dropdown-item text-center">See all notifications</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <img class="rounded-circle me-lg-2" src="{{ asset('assets/img/user.jpg') }}"
                                    alt="" style="width: 40px; height: 40px;">
                                <span class="d-none d-lg-inline-flex">John Doe</span>
                            </a>
                            <div
                                class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                                <a href="#" class="dropdown-item">My Profile</a>
                                <a href="#" class="dropdown-item">Settings</a>
                                <a href="#" class="dropdown-item">Log Out</a>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- Navbar End -->


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
  {{-- <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Peminjaman</h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="worldwide-sales"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0"></h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="salse-revenue"></canvas>
                        </div>
                    </div>
                </div>
            </div> --}}
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



                <!-- Footer Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div class="row">
                            <div class="col-12 col-sm-6 text-center text-sm-start">
                                &copy; <a href="#">FDPR-ADMIN</a>
                            </div>
                            <div class="col-12 col-sm-6 text-center text-sm-end">
                                <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                                {{-- Designed By <a href="https://htmlcodex.com">HTML Codex</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer End -->
            </div>
            <!-- Content End -->


            <!-- Back to Top -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
