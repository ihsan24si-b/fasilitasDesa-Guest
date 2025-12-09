<!-- Navbar Start -->
<nav class="navbar navbar-expand bg-light navbar-dark sticky-top px-4 py-0">
    <a href="{{ route('homepage') }}" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i data-feather="home"></i></h2>
    </a>

    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i data-feather="menu"></i>
    </a>

    <!-- Search -->
    <form class="d-none d-md-flex ms-4">
        <input class="form-control border-0" type="search" placeholder="Search">
    </form>

    <div class="navbar-nav align-items-center ms-auto">

        <!-- MENU -->
        <div class="nav-item me-3">
            <div class="d-flex gap-3">

                <a href="{{ route('homepage') }}"
                   class="nav-link {{ request()->routeIs('homepage') ? 'text-primary' : '' }}">
                    <i data-feather="home" style="width:16px"></i> Home
                </a>

                <a href="{{ route('warga.index') }}"
                   class="nav-link {{ request()->routeIs('warga.*') ? 'text-primary' : '' }}">
                    <i data-feather="users" style="width:16px"></i> Data Warga
                </a>

                <a href="{{ route('user.index') }}"
                   class="nav-link {{ request()->routeIs('user.*') ? 'text-primary' : '' }}">
                    <i data-feather="users" style="width:16px"></i> Data User
                </a>

                <a href="{{ route('fasilitas.index') }}"
                   class="nav-link {{ request()->routeIs('fasilitas.*') ? 'text-primary' : '' }}">
                    <i data-feather="calendar" style="width:16px"></i> Peminjaman Fasilitas
                </a>

                <a href="{{ url('/about') }}"
                   class="nav-link {{ request()->is('about') ? 'text-primary' : '' }}">
                    <i data-feather="info" style="width:16px"></i> About
                </a>

            </div>
        </div>

        <!-- AUTH DROPDOWN (untuk semua user login) -->
        @if(Auth::check())

            <!-- MESSAGES -->
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                    <i data-feather="mail" style="width:16px"></i>
                    <span class="d-none d-lg-inline-flex">Message</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom">
                    <a href="#" class="dropdown-item text-center">See all messages</a>
                </div>
            </div>

            <!-- NOTIFICATIONS -->
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                    <i data-feather="bell" style="width:16px"></i>
                    <span class="d-none d-lg-inline-flex">Notification</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom">
                    <a href="#" class="dropdown-item text-center">See all notifications</a>
                </div>
            </div>

            <!-- USER PROFILE -->
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                    <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center me-lg-2"
                         style="width:40px; height:40px;">
                        <i data-feather="user" class="text-white" style="width:20px"></i>
                    </div>
                    <span class="d-none d-lg-inline-flex">
                        {{ Auth::user()->name }}
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-bottom">

                    @if(session('last_login'))
                        <a class="dropdown-item">
                            <i data-feather="clock" style="width:16px"></i>
                            {{ session('last_login') }}
                        </a>
                    @endif

                    <a class="dropdown-item" href="#">
                        <i data-feather="user" style="width:16px"></i> My Profile
                    </a>

                    <a class="dropdown-item" href="#">
                        <i data-feather="settings" style="width:16px"></i> Settings
                    </a>

                    <div class="dropdown-divider"></div>

                    <form method="POST" action="{{ route('auth.logout') }}">
                        @csrf
                        <button class="dropdown-item text-danger" onclick="return confirm('Yakin ingin logout?')">
                            <i data-feather="log-out" style="width:16px"></i> Log Out
                        </button>
                    </form>
                </div>
            </div>

        @else
            <!-- TIDAK LOGIN -->
            <div class="nav-item">
                <div class="d-flex gap-2">
                    <a href="{{ route('auth.index') }}" class="btn btn-outline-primary btn-sm">
                        <i data-feather="log-in" style="width:16px"></i> Login
                    </a>

                    <a href="{{ route('auth.register') }}" class="btn btn-primary btn-sm">
                        <i data-feather="user-plus" style="width:16px"></i> Register
                    </a>
                </div>
            </div>
        @endif

    </div>
</nav>
<!-- Navbar End -->
