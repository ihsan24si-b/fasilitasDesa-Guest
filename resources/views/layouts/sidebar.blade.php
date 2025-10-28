<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="{{ route('dashboard') }}" class="navbar-brand mx-4 mb-4 px-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>FDPR</h3>
        </a>

        <div class="d-flex align-items-center ms-4 mb-4 ps-2">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('assets/img/user.jpg') }}" alt="User"
                    style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ session('admin_username', 'Admin') }}</h6>
                <span>{{ session('admin_email', 'Admin') }}</span>
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
        <div class="mt-4 pt-3 border-top">
            <form action="{{ route('pages.auth.logout') }}" method="POST" class="w-100 px-3">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100"
                    onclick="return confirm('Yakin ingin logout?')">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </button>
            </form>
        </div>
    </nav>
</div>
