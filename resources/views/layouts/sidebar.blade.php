<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="{{ route('dashboard') }}" class="navbar-brand mx-4 mb-4 px-3">
    {{-- Sesuaikan path dan ukuran height sesuai kebutuhan --}}
    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo FDPR" style="height: 50px; width: auto;">
</a>

        <div class="d-flex align-items-center ms-4 mb-4 ps-2">
            <div class="position-relative">

                {{-- CARA BARU: Foto dari Auth --}}
                <img class="rounded-circle" src="{{ Auth::user()->getProfilePictureUrl() }}" alt="User"
                    style="width: 40px; height: 40px; object-fit: cover;">

                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                {{-- CARA BARU: Nama & Role dari Auth --}}
                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                <span>{{ Auth::user()->role }}</span> {{-- Menampilkan Role (Super Admin) --}}
            </div>
        </div>

        <div class="navbar-nav w-100 px-3">
            <a href="{{ route('dashboard') }}"
                class="nav-item nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>

            <a href="{{ route('pages.fasilitas.index') }}"
                class="nav-item nav-link {{ request()->routeIs('pages.fasilitas.*') ? 'active' : '' }}">
                <i class="fas fa-building me-2"></i>Data Fasilitas
            </a>

            <a href="{{ route('pages.warga.index') }}"
                class="nav-item nav-link {{ request()->routeIs('pages.warga.*') ? 'active' : '' }}">
                <i class="fas fa-users me-2"></i>Data Warga
            </a>

            <a href="{{ route('pages.user.index') }}"
                class="nav-item nav-link {{ request()->routeIs('pages.user.*') ? 'active' : '' }}">
                <i class="fas fa-user me-2"></i>Data User
            </a>
        </div>

        <!-- Tombol Logout -->
        {{-- <div class="logout-section">
            <form action="{{ route('pages.auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger logout-btn"
                    onclick="return confirm('Yakin ingin logout?')">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </button>
            </form>
        </div> --}}
    </nav>
</div>
