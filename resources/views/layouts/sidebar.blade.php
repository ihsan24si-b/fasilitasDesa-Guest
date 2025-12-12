<div class="sidebar pe-4 pb-3">
    {{-- Menggunakan navbar-dark agar tulisan putih kontras dengan background gelap --}}
    <nav class="navbar navbar-dark">
        
        {{-- 1. LOGO APLIKASI --}}
        <a href="{{ route('dashboard') }}" class="navbar-brand mx-4 mb-4 px-3">
            {{-- Pastikan file logo ada di public/assets/img/logo.png --}}
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo FDPR" style="height: 50px; width: auto;">
        </a>

        {{-- 2. PROFIL USER (Bulat & Rapi) --}}
        <div class="d-flex align-items-center ms-4 mb-4 ps-2">
            <div class="position-relative">
                <img class="rounded-circle" 
                     src="{{ Auth::user()->getProfilePictureUrl() }}" 
                     alt="User"
                     style="width: 40px; height: 40px; object-fit: cover;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0 text-black">{{ Auth::user()->name }}</h6>
                <span class="text-muted small">{{ Auth::user()->role }}</span>
            </div>
        </div>

        {{-- 3. MENU NAVIGASI UTAMA --}}
        <div class="navbar-nav w-100 px-3">
            
            {{-- GROUP: DASHBOARD --}}
            <a href="{{ route('dashboard') }}" class="nav-item nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>

            {{-- GROUP: MASTER DATA --}}
            <div class="nav-item small text-muted mt-3 mb-2 ms-2 text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">
                Master Data
            </div>

            <a href="{{ route('pages.warga.index') }}" class="nav-item nav-link {{ request()->routeIs('pages.warga.*') ? 'active' : '' }}">
                <i class="fas fa-users me-2"></i>Data Warga
            </a>

            <a href="{{ route('pages.fasilitas.index') }}" class="nav-item nav-link {{ request()->routeIs('pages.fasilitas.*') ? 'active' : '' }}">
                <i class="fas fa-building me-2"></i>Fasilitas Desa
            </a>

            <a href="{{ route('pages.petugas.index') }}" class="nav-item nav-link {{ request()->routeIs('pages.petugas.*') ? 'active' : '' }}">
                <i class="fas fa-id-badge me-2"></i>Petugas / PIC
            </a>

            {{-- Khusus Super Admin --}}
            @if(Auth::user()->role == 'Super Admin')
            <a href="{{ route('pages.user.index') }}" class="nav-item nav-link {{ request()->routeIs('pages.user.*') ? 'active' : '' }}">
                <i class="fas fa-user-shield me-2"></i>Manajemen User
            </a>
            @endif

            {{-- GROUP: SIRKULASI --}}
            <div class="nav-item small text-muted mt-3 mb-2 ms-2 text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">
                Sirkulasi
            </div>

            <a href="{{ route('pages.peminjaman.index') }}" class="nav-item nav-link {{ request()->routeIs('pages.peminjaman.*') ? 'active' : '' }}">
                <i class="far fa-calendar-alt me-2"></i>Booking / Sewa
            </a>

            <a href="{{ route('pages.pembayaran.index') }}" class="nav-item nav-link {{ request()->routeIs('pages.pembayaran.*') ? 'active' : '' }}">
                <i class="fas fa-money-bill-wave me-2"></i>Kas & Pembayaran
            </a>

            {{-- GROUP: TENTANG (Menu Baru) --}}
            <div class="nav-item small text-muted mt-3 mb-2 ms-2 text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">
                Tentang
            </div>

            <a href="{{ route('pages.developer.index') }}" class="nav-item nav-link {{ request()->routeIs('pages.developer.*') ? 'active' : '' }}">
                <i class="fas fa-code me-2"></i>Identitas Developer
            </a>

        </div>

        {{-- 4. TOMBOL LOGOUT (Di Bawah) --}}
        <div class="logout-section mt-4 pt-3 border-top border-secondary w-100 px-3">
            <form action="{{ route('pages.auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 py-2 logout-btn" onclick="return confirm('Yakin ingin logout?')">
                    <i class="fas fa-sign-out-alt me-2"></i>Keluar
                </button>
            </form>
        </div>

    </nav>
</div>