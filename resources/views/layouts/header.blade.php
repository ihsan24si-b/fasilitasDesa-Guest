<!-- Navbar Start -->
<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="{{ route('homepage') }}" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>

    <!-- Search Form -->
    <form class="d-none d-md-flex ms-4">
        <input class="form-control border-0" type="search" placeholder="Search">
    </form>

    <div class="navbar-nav align-items-center ms-auto">
        <!-- Navigation Menu -->
        <div class="nav-item me-3">
            <div class="d-flex gap-3">
                <a href="{{ route('homepage') }}" class="nav-link {{ request()->routeIs('homepage') ? 'text-primary' : '' }}">Home</a>
                <a href="{{ route('warga.index') }}" class="nav-link {{ request()->routeIs('warga.*') ? 'text-primary' : '' }}">Data Warga</a>
                <a href="{{ route('fasilitas.index') }}" class="nav-link {{ request()->routeIs('fasilitas.*') ? 'text-primary' : '' }}">Data Fasilitas</a>
                <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.*') ? 'text-primary' : '' }}">Data User</a>

                <!-- Pages Dropdown -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        Pages
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="{{ route('features') }}" class="dropdown-item">Features</a>
                        <a href="{{ route('team') }}" class="dropdown-item">Our Team</a>
                        <a href="{{ route('testimonial') }}" class="dropdown-item">Testimonial</a>
                        <a href="{{ route('not-found') }}" class="dropdown-item">404 Page</a>
                    </div>
                </div>

                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'text-primary' : '' }}">Contact</a>
            </div>
        </div>

        @if(session('admin_logged_in'))
            <!-- User is LOGGED IN -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-envelope me-lg-2"></i>
                    <span class="d-none d-lg-inline-flex">Message</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <a href="#" class="dropdown-item text-center">See all message</a>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-bell me-lg-2"></i>
                    <span class="d-none d-lg-inline-flex">Notification</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <a href="#" class="dropdown-item text-center">See all notifications</a>
                </div>
            </div>

            <!-- User Profile Dropdown -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img class="rounded-circle me-lg-2" src="{{ asset('assets/img/user.jpg') }}" alt="User" style="width: 40px; height: 40px;">
                    <span class="d-none d-lg-inline-flex">{{ session('admin_username') ?? 'Admin' }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user me-2"></i>My Profile
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-cog me-2"></i>Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Yakin ingin logout?')">
                            <i class="fas fa-sign-out-alt me-2"></i>Log Out
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- User is NOT LOGGED IN -->
            <div class="nav-item">
                <div class="d-flex gap-2">
                    <a href="{{ route('auth.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-sign-in-alt me-1"></i>Login
                    </a>
                    <a href="{{ route('auth.register') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-user-plus me-1"></i>Register
                    </a>
                </div>
            </div>
        @endif
    </div>
</nav>
<!-- Navbar End -->
