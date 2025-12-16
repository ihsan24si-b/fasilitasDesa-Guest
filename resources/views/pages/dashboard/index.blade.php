@extends('layouts.app')

@section('title', 'Beranda - Sistem Fasilitas Desa')

@section('content')

{{--
    =======================================================
    SECTION 1: HERO & WELCOME (ID: home)
    =======================================================
--}}
<section id="home" class="position-relative overflow-hidden"
    style="margin-top: -25px; margin-left: -25px; margin-right: -25px; min-height: 550px;
           background: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.7)), url('{{ asset('assets/img/hero-bg.jpg') }}') center/cover;">

    <div class="container h-100 d-flex flex-column justify-content-center align-items-center text-center text-white py-5">
        <br>
        @auth
            <span class="badge bg-primary bg-opacity-75 px-3 py-2 rounded-pill mb-3 animate-entry">
                <i class="fas fa-user-circle me-2"></i> Halo, {{ Auth::user()->name }}
            </span>
            <h1 class="display-4 fw-bold mb-3 animate-entry">Dashboard Pengelolaan Desa</h1>
            <p class="lead opacity-75 mb-4 animate-entry delay-100" style="max-width: 700px;">
                Selamat datang kembali. Silakan akses menu layanan di bawah untuk mengelola data warga, fasilitas, dan transaksi.
            </p>
            <div class="d-flex gap-3 animate-entry delay-200">
                <a href="#layanan" class="btn btn-warning rounded-pill px-4 fw-bold shadow hover-up">
                    <i class="fas fa-th-large me-2"></i> Buka Menu Layanan
                </a>
            </div>
        @else
            <h1 class="display-4 fw-bold mb-3 animate-entry">Sistem Fasilitas Desa</h1>
            <p class="lead opacity-75 mb-4 animate-entry delay-100" style="max-width: 700px;">
                Wujudkan transparansi dan kemudahan akses fasilitas publik untuk seluruh warga.
                Ajukan peminjaman Balai, Lapangan, dan Aula dengan mudah.
            </p>
            <div class="d-flex gap-3 animate-entry delay-200">
                <a href="#layanan" class="btn btn-warning rounded-pill px-4 fw-bold shadow hover-up">
                    <i class="fas fa-search me-2"></i> Lihat Layanan
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-light rounded-pill px-4 fw-bold hover-up">
                    <i class="fas fa-sign-in-alt me-2"></i> Masuk Sekarang
                </a>
            </div>
        @endauth
    </div>

    {{-- Ombak Hiasan --}}
    <div class="position-absolute bottom-0 start-0 w-100" style="line-height: 0;">
        <svg viewBox="0 0 1440 320" style="width: 100%; height: auto;">
            <path fill="#ffffff" fill-opacity="1" d="M0,160L48,176C96,192,192,224,288,213.3C384,203,480,149,576,138.7C672,128,768,160,864,181.3C960,203,1056,213,1152,192C1248,171,1344,117,1392,90.7L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</section>

{{--
    =======================================================
    SECTION 2: STATISTIK (Melayang di atas Hero)
    =======================================================
--}}
<div class="container" style="margin-top: -100px; position: relative; z-index: 5;">
    @auth
        @if(in_array(Auth::user()->role, ['Super Admin', 'Admin', 'Petugas']))
            {{-- TAMPILAN STATISTIK ADMIN --}}
            <div class="row g-3 justify-content-center">
                <div class="col-md-3 col-6">
                    <div class="card border-0 shadow-sm h-100 text-center py-4 hover-up rounded-4">
                        <h6 class="text-muted small fw-bold">PENDING</h6>
                        <h3 class="fw-bold text-warning">{{ $adminStats['booking_pending'] ?? 0 }}</h3>
                        <small class="text-secondary">Verifikasi Booking</small>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card border-0 shadow-sm h-100 text-center py-4 hover-up rounded-4">
                        <h6 class="text-muted small fw-bold">AKTIF</h6>
                        <h3 class="fw-bold text-danger">{{ $peminjamanAktif ?? 0 }}</h3>
                        <small class="text-secondary">Fasilitas Dipakai</small>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card border-0 shadow-sm h-100 text-center py-4 hover-up rounded-4">
                        <h6 class="text-muted small fw-bold">WARGA</h6>
                        <h3 class="fw-bold text-primary">{{ $totalWarga ?? 0 }}</h3>
                        <small class="text-secondary">Terdaftar</small>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card border-0 shadow-sm h-100 text-center py-4 hover-up rounded-4">
                        <h6 class="text-muted small fw-bold">KAS MASUK</h6>
                        <h4 class="fw-bold text-success mb-0">Rp {{ number_format($adminStats['total_uang'] ?? 0) }}</h4>
                        <small class="text-secondary">Total Pendapatan</small>
                    </div>
                </div>
            </div>
        @endif
    @else
        {{-- TAMPILAN STATISTIK PUBLIK (GUEST) --}}
        <div class="row g-3 justify-content-center">
            <div class="col-md-4 col-12">
                <div class="card border-0 shadow-sm h-100 p-4 d-flex flex-row align-items-center hover-up rounded-4">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="fas fa-building text-primary fa-2x"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">{{ $totalFasilitas }}</h3>
                        <small class="text-muted">Aset Fasilitas</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="card border-0 shadow-sm h-100 p-4 d-flex flex-row align-items-center hover-up rounded-4">
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="fas fa-check-circle text-success fa-2x"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">{{ $fasilitasTersedia }}</h3>
                        <small class="text-muted">Siap Digunakan</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="card border-0 shadow-sm h-100 p-4 d-flex flex-row align-items-center hover-up rounded-4">
                    <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                        <i class="fas fa-users text-info fa-2x"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">{{ $totalWarga }}</h3>
                        <small class="text-muted">Warga Terdaftar</small>
                    </div>
                </div>
            </div>
        </div>
    @endauth
</div>

{{--
    =======================================================
    SECTION 3: ABOUT (ID: about)
    =======================================================
--}}
<section id="about" class="py-5 mt-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="position-relative">
                    <img src="{{ asset('assets/img/about-img.jpg') }}" alt="Tentang Kami"
                         class="img-fluid rounded-4 shadow-lg w-100"
                         onerror="this.src='https://via.placeholder.com/600x400?text=About+Image'">

                    {{-- Badge Melayang --}}
                    <div class="position-absolute bottom-0 end-0 bg-white p-3 rounded-3 shadow-lg m-3 d-none d-md-block">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-star text-warning fa-2x me-2"></i>
                            <div>
                                <h6 class="fw-bold m-0">Terpercaya</h6>
                                <small class="text-muted">Pelayanan Terbaik</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 ps-lg-5">
                <h6 class="text-primary fw-bold text-uppercase mb-2">Tentang Sistem</h6>
                <h2 class="fw-bold mb-4">Transparansi & Kemudahan Akses Fasilitas Desa</h2>
                <p class="text-muted lead fs-6 mb-4">
                    Sistem ini hadir sebagai solusi digital untuk memudahkan warga desa dalam meminjam fasilitas umum seperti balai desa, lapangan, dan peralatan lainnya secara online, transparan, dan terjadwal.
                </p>

                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i> <span>Jadwal Real-time</span>
                        </div>
                        <p class="small text-muted ms-4">Cek ketersediaan langsung.</p>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i> <span>Akses Mudah</span>
                        </div>
                        <p class="small text-muted ms-4">Bisa dari HP dimana saja.</p>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i> <span>Data Transparan</span>
                        </div>
                        <p class="small text-muted ms-4">Pengelolaan aset terbuka.</p>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i> <span>Pelayanan Cepat</span>
                        </div>
                        <p class="small text-muted ms-4">Persetujuan admin responsif.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{--
    =======================================================
    SECTION 4: LAYANAN / MENU UTAMA (ID: layanan)
    =======================================================
--}}
<section id="layanan" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-primary fw-bold text-uppercase">Menu Layanan</h6>
            <h2 class="fw-bold">Pusat Fitur & Navigasi</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">
                Silakan pilih menu di bawah ini untuk mengakses fitur pengelolaan data.
            </p>
        </div>

        @php
            $menus = [
                ['title' => 'Data Warga', 'desc' => 'Manajemen data kependudukan.', 'icon' => 'fa-users', 'route' => 'pages.warga.index', 'role' => ['Super Admin', 'Admin', 'Petugas']],
                ['title' => 'Fasilitas Desa', 'desc' => 'Katalog aset & fasilitas umum.', 'icon' => 'fa-building', 'route' => 'pages.fasilitas.index', 'role' => 'all'],
                ['title' => 'Data Petugas', 'desc' => 'Admin pengelola fasilitas.', 'icon' => 'fa-user-shield', 'route' => 'pages.petugas.index', 'role' => ['Super Admin', 'Admin']],
                ['title' => 'Booking Ruang', 'desc' => 'Formulir peminjaman aset.', 'icon' => 'fa-calendar-alt', 'route' => 'pages.peminjaman.index', 'role' => 'all'],
                ['title' => 'Pembayaran', 'desc' => 'Riwayat & bukti transaksi.', 'icon' => 'fa-file-invoice-dollar', 'route' => 'pages.pembayaran.index', 'role' => ['Super Admin', 'Admin', 'Petugas']],
                ['title' => 'Data User', 'desc' => 'Manajemen akun pengguna.', 'icon' => 'fa-user-cog', 'route' => 'pages.user.index', 'role' => ['Super Admin']]
            ];
        @endphp

        <div class="row g-4 justify-content-center">
            @foreach($menus as $menu)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm hover-card text-center p-4">
                        <div class="mb-3">
                            <div class="bg-primary bg-opacity-10 d-inline-block p-3 rounded-circle">
                                <i class="fas {{ $menu['icon'] }} fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold text-dark">{{ $menu['title'] }}</h5>
                        <p class="text-muted small mb-4">{{ $menu['desc'] }}</p>

                        @auth
                            {{-- LOGIKA TOMBOL SAAT LOGIN --}}
                            @if($menu['role'] == 'all' || in_array(Auth::user()->role, (array)$menu['role']))
                                <a href="{{ route($menu['route']) }}" class="btn btn-primary w-100 fw-bold py-2 rounded-pill shadow-sm">
                                    Buka Fitur
                                </a>
                            @else
                                <button class="btn btn-secondary w-100 py-2 rounded-pill disabled opacity-50">
                                    <i class="fas fa-lock me-1"></i> Terkunci
                                </button>
                            @endif
                        @else
                            {{-- LOGIKA TOMBOL SAAT GUEST --}}
                            <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 fw-bold py-2 rounded-pill shadow-sm">
                                <i class="fas fa-sign-in-alt me-1"></i> Login Akses
                            </a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{--
    =======================================================
    SECTION 5: DEV TEAM (ID: dev)
    =======================================================
--}}
<section id="dev" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-primary fw-bold text-uppercase">Tim Kami</h6>
            <h2 class="fw-bold">Developer</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card border-0 shadow rounded-4 overflow-hidden text-center hover-up">
                    <div style="height: 100px; background: linear-gradient(135deg, #153f57 0%, #1e577a 100%);"></div>
                    <div class="card-body pt-0 position-relative">
                        <div style="margin-top: -50px;">
                            <img src="{{ asset('assets/img/dev.jpg') }}" class="rounded-circle shadow border border-4 border-white"
                                 style="width: 100px; height: 100px; object-fit: cover;"
                                 onerror="this.src='https://via.placeholder.com/150'">
                        </div>
                        <h4 class="mt-3 fw-bold text-dark"> Muhammad Ihsan Yazid</h4>
                        <p class="text-muted small mb-3">Fullstack Web Developer</p>
                        <p class="text-secondary px-4 small">
                            Mahasiswa Sistem Informasi Politeknik Caltex Riau.
                        </p>
                        <div class="d-flex justify-content-center gap-2 mb-3">
                            <a href="#" class="btn btn-light btn-sm rounded-circle border text-dark"><i class="fab fa-github"></i></a>
                            <a href="#" class="btn btn-light btn-sm rounded-circle border text-primary"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="btn btn-light btn-sm rounded-circle border text-danger"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{--
    =======================================================
    SECTION 6: KONTAK (ID: kontak)
    =======================================================
--}}
<section id="kontak" class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg p-4 p-md-5 rounded-4 bg-white">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Hubungi Admin</h2>
                        <p class="text-muted">Punya pertanyaan seputar fasilitas atau kendala peminjaman? Kirim pesan langsung ke WhatsApp kami.</p>
                    </div>
                    <form action="https://wa.me/6285836124648" method="GET" target="_blank">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Nama Lengkap</label>
                                <input type="text" class="form-control bg-light border-0 py-2" placeholder="Nama Anda...">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">No. WhatsApp</label>
                                <input type="text" class="form-control bg-light border-0 py-2" placeholder="08...">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small">Pesan / Kendala</label>
                                <textarea class="form-control bg-light border-0 py-2" rows="4" name="text" placeholder="Tulis pesan Anda disini..."></textarea>
                            </div>
                            <div class="col-12 text-center mt-3">
                                <button type="submit" class="btn btn-success px-5 rounded-pill fw-bold hover-up shadow">
                                    <i class="fab fa-whatsapp me-2"></i> Kirim Pesan WA
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* Animasi Hover */
    .hover-card { transition: all 0.3s ease; border-radius: 16px; background: #fff; }
    .hover-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important; border-color: #cfe2ff !important; }

    .hover-up { transition: transform 0.3s; }
    .hover-up:hover { transform: translateY(-3px); }

    /* Animasi Entry */
    .animate-entry { animation: fadeInUp 1s ease-out forwards; opacity: 0; }
    .delay-100 { animation-delay: 0.2s; }
    .delay-200 { animation-delay: 0.4s; }

    @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endpush
