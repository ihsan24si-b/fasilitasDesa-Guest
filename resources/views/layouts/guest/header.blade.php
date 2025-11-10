<!-- Navbar Start -->
<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="{{ route('homepage') }}" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i data-feather="home"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i data-feather="menu"></i>
    </a>

    <!-- Search Form -->
    <form class="d-none d-md-flex ms-4">
        <input class="form-control border-0" type="search" placeholder="Search">
    </form>

    <div class="navbar-nav align-items-center ms-auto">
        <!-- Navigation Menu -->
        <div class="nav-item me-3">
            <div class="d-flex gap-3">
                <a href="{{ route('homepage') }}" class="nav-link {{ request()->routeIs('homepage') ? 'text-primary' : '' }}">
                    <i data-feather="home" style="width: 16px; height: 16px;"></i> Home
                </a>
                <a href="{{ route('warga.index') }}" class="nav-link {{ request()->routeIs('warga.*') ? 'text-primary' : '' }}">
                    <i data-feather="users" style="width: 16px; height: 16px;"></i> Data Warga
                </a>
                <a href="{{ route('fasilitas.index') }}" class="nav-link {{ request()->routeIs('fasilitas.*') ? 'text-primary' : '' }}">
                    <i data-feather="calendar" style="width: 16px; height: 16px;"></i> Peminjaman Fasilitas
                </a>
                <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.*') ? 'text-primary' : '' }}">
                    <i data-feather="plus-circle" style="width: 16px; height: 16px;"></i> Tambah Data
                </a>
                <a href="{{ url('/about') }}" class="nav-link {{ request()->is('about') ? 'text-primary' : '' }}">
                    <i data-feather="info" style="width: 16px; height: 16px;"></i> About
                </a>
            </div>
        </div>

        @if(session('admin_logged_in'))
            <!-- User is LOGGED IN -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i data-feather="mail" style="width: 16px; height: 16px;"></i>
                    <span class="d-none d-lg-inline-flex">Message</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <a href="#" class="dropdown-item text-center">See all message</a>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i data-feather="bell" style="width: 16px; height: 16px;"></i>
                    <span class="d-none d-lg-inline-flex">Notification</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <a href="#" class="dropdown-item text-center">See all notifications</a>
                </div>
            </div>

            <!-- User Profile Dropdown -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center me-lg-2" style="width: 40px; height: 40px;">
                        <i data-feather="user" class="text-white" style="width: 20px; height: 20px;"></i>
                    </div>
                    <span class="d-none d-lg-inline-flex">{{ session('admin_username') ?? 'Admin' }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <a href="#" class="dropdown-item">
                        <i data-feather="user" style="width: 16px; height: 16px;"></i> My Profile
                    </a>
                    <a href="#" class="dropdown-item">
                        <i data-feather="settings" style="width: 16px; height: 16px;"></i> Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Yakin ingin logout?')">
                            <i data-feather="log-out" style="width: 16px; height: 16px;"></i> Log Out
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- User is NOT LOGGED IN -->
            <div class="nav-item">
                <div class="d-flex gap-2">
                    <a href="{{ route('auth.index') }}" class="btn btn-outline-primary btn-sm">
                        <i data-feather="log-in" style="width: 16px; height: 16px;"></i> Login
                    </a>
                    <a href="{{ route('auth.register') }}" class="btn btn-primary btn-sm">
                        <i data-feather="user-plus" style="width: 16px; height: 16px;"></i> Register
                    </a>
                </div>
            </div>
        @endif
    </div>
</nav>
<!-- Navbar End -->
