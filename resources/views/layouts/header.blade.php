<header class="fixed-top bg-white shadow-sm" style="min-height: 80px;">
    <nav class="navbar navbar-expand-lg h-100" id="mainNavbar">
        <div class="container">
            
            {{-- 1. LOGO --}}
            <a class="navbar-brand py-0" href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/img/logo.png') }}" 
                     alt="Logo" 
                     style="height: 45px; width: auto;"> 
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                
                {{-- 2. MENU NAVIGASI (Scroll Down Logic) --}}
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 align-items-center gap-3">
                    
                    {{-- Deteksi URL: Jika di Dashboard pakai #id, jika tidak pakai /#id --}}
                    @php
                        $isHome = request()->routeIs('dashboard');
                        $prefix = $isHome ? '' : url('/');
                    @endphp

                    <li class="nav-item">
                        <a class="nav-link fw-bold text-uppercase text-secondary" href="{{ $prefix }}#home">Home</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-uppercase text-secondary" href="{{ $prefix }}#about">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-bold text-uppercase text-secondary" href="{{ $prefix }}#layanan">Layanan</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-uppercase text-secondary" href="{{ $prefix }}#dev">Dev</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-bold text-uppercase text-secondary" href="{{ $prefix }}#kontak">Kontak</a>
                    </li>
                </ul>

                {{-- 3. PROFIL KANAN & TOMBOL LOGIN --}}
                <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                    @auth
                        {{-- SUDAH LOGIN: Tampilkan Profil --}}
                        <div class="dropdown">
                            <a class="nav-link p-0 d-flex align-items-center gap-2" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <img src="{{ Auth::user()->getProfilePictureUrl() }}" 
                                     alt="Profile" 
                                     class="rounded-circle shadow-sm border border-2 border-white"
                                     style="width: 42px; height: 42px; object-fit: cover;">
                                
                                <div class="d-none d-lg-block text-start">
                                    <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ Auth::user()->name }}</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">{{ Auth::user()->role }}</div>
                                </div>
                            </a>
                            
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3 p-3 rounded-4" style="min-width: 220px;">
                                <li class="text-center mb-3">
                                    <img src="{{ Auth::user()->getProfilePictureUrl() }}" class="rounded-circle mb-2" style="width: 60px; height: 60px; object-fit: cover;">
                                    <h6 class="fw-bold mb-0 text-dark">{{ Auth::user()->name }}</h6>
                                    <span class="badge bg-primary rounded-pill">{{ Auth::user()->role }}</span>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item rounded py-2" href="{{ route('pages.profile.show', Auth::id()) }}"><i class="fas fa-user-circle me-2"></i> Edit Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('pages.auth.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item rounded py-2 text-danger fw-bold mt-1">
                                            <i class="fas fa-sign-out-alt me-2"></i> Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        {{-- BELUM LOGIN (GUEST): Tampilkan Tombol Masuk --}}
                        <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4 fw-bold">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-primary text-white rounded-pill px-4 fw-bold">Daftar</a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>
</header>

@push('styles')
<style>
    /* Agar header tidak menutupi judul section saat scroll */
    html { scroll-behavior: smooth; scroll-padding-top: 90px; }
    body { padding-top: 80px; }

    .navbar-nav .nav-link {
        font-family: 'Roboto', sans-serif;
        font-size: 0.9rem;
        padding: 8px 16px !important;
        transition: color 0.3s ease;
        letter-spacing: 0.5px;
    }
    .navbar-nav .nav-link:hover { color: #153f57ff !important; }
    .dropdown-item:hover { background-color: #f0f8ff; color: #153f57ff; }
</style>
@endpush