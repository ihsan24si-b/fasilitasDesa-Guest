@extends('layouts.guest.app')

@section('title', 'Sistem Management Warga')

@section('content')
<!-- Hero Start -->
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">We Make Your Community Better</h1>
                <p class="fs-4 text-white mb-4 animated slideInDown">Sistem Management Warga Terintegrasi Sejak 2024</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('warga.index') }}" class="btn btn-light py-3 px-5 animated slideInRight">
                        <i data-feather="users"></i> Kelola Data Warga
                    </a>
                    <a href="{{ route('fasilitas.index') }}" class="btn btn-outline-light py-3 px-5 animated slideInLeft">
                        <i data-feather="home"></i> Peminjaman Fasilitas
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->

<!-- Features Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="text-uppercase mb-4">Fitur Utama Sistem Kami</h1>
            <p class="mb-5">Solusi lengkap untuk mengelola data warga dan fasilitas secara digital</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item text-center pt-3 bg-light rounded shadow-sm">
                    <div class="p-4">
                        <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                            <i data-feather="users" class="text-white" style="width: 40px; height: 40px;"></i>
                        </div>
                        <h5 class="mb-3 text-dark">Data Warga Terkelola</h5>
                        <p class="text-dark">Kelola data warga secara digital dengan sistem yang terintegrasi dan aman</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item text-center pt-3 bg-light rounded shadow-sm">
                    <div class="p-4">
                        <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                            <i data-feather="home" class="text-white" style="width: 40px; height: 40px;"></i>
                        </div>
                        <h5 class="mb-3 text-dark">Peminjaman Fasilitas</h5>
                        <p class="text-dark">Permudah proses peminjaman fasilitas umum dengan sistem online</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item text-center pt-3 bg-light rounded shadow-sm">
                    <div class="p-4">
                        <div class="bg-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                            <i data-feather="user-check" class="text-white" style="width: 40px; height: 40px;"></i>
                        </div>
                        <h5 class="mb-3 text-dark">Akses Mudah</h5>
                        <p class="text-dark">Warga dapat mengakses sistem kapan saja dengan antarmuka yang user-friendly</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="service-item text-center pt-3 bg-light rounded shadow-sm">
                    <div class="p-4">
                        <div class="bg-info rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                            <i data-feather="shield" class="text-white" style="width: 40px; height: 40px;"></i>
                        </div>
                        <h5 class="mb-3 text-dark">Data Terproteksi</h5>
                        <p class="text-dark">Keamanan data warga terjamin dengan sistem enkripsi yang modern</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Features End -->

<!-- About Start -->
<div class="container-xxl py-5 bg-light">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-flex flex-column">
                 
                    <div class="w-50 bg-primary p-3 border shadow" style="margin-top: -15%;">
                        <h1 class="text-uppercase text-white mb-0">5+</h1>
                        <h6 class="text-uppercase text-white mb-0">Tahun Pengalaman</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="text-uppercase mb-4 text-dark">HISTORY of Our Creation</h1>
                <p class="mb-4 text-dark">Sistem Management Warga ini dikembangkan untuk menjawab tantangan pengelolaan data warga dan fasilitas publik yang semakin kompleks di era digital.</p>

                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <i data-feather="check-circle" class="text-primary me-2"></i>
                            <h6 class="mb-0 text-dark">Data Warga Terpusat</h6>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <i data-feather="check-circle" class="text-primary me-2"></i>
                            <h6 class="mb-0 text-dark">Peminjaman Online</h6>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <i data-feather="check-circle" class="text-primary me-2"></i>
                            <h6 class="mb-0 text-dark">Laporan Real-time</h6>
                        </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <i data-feather="check-circle" class="text-primary me-2"></i>
                            <h6 class="mb-0 text-dark">Multi-user Access</h6>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ url('/about') }}" class="btn btn-primary py-3 px-5 shadow">
                        <i data-feather="info"></i> Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Stats Start -->
<div class="container-fluid bg-primary facts py-5 mb-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                    <i data-feather="users" class="text-primary" style="width: 40px; height: 40px;"></i>
                </div>
                <h1 class="text-white mb-2" data-toggle="counter-up">150</h1>
                <p class="text-white text-uppercase">Warga Terdaftar</p>
            </div>
            <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                    <i data-feather="home" class="text-primary" style="width: 40px; height: 40px;"></i>
                </div>
                <h1 class="text-white mb-2" data-toggle="counter-up">12</h1>
                <p class="text-white text-uppercase">Fasilitas Tersedia</p>
            </div>
            <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                    <i data-feather="calendar" class="text-primary" style="width: 40px; height: 40px;"></i>
                </div>
                <h1 class="text-white mb-2" data-toggle="counter-up">45</h1>
                <p class="text-white text-uppercase">Peminjaman/Bulan</p>
            </div>
            <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                    <i data-feather="award" class="text-primary" style="width: 40px; height: 40px;"></i>
                </div>
                <h1 class="text-white mb-2" data-toggle="counter-up">3</h1>
                <p class="text-white text-uppercase">Penghargaan</p>
            </div>
        </div>
    </div>
</div>
<!-- Stats End -->
@endsection
