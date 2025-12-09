<!-- Navbar Start -->
<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="{{ route('dashboard') }}" class="navbar-brand d-flex d-lg-none me-4">
    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo FDPR" style="height: 40px; width: auto;">
</a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    {{-- <form class="d-none d-md-flex ms-4">
        <input class="form-control border-0" type="search" placeholder="Search">
    </form> --}}
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-envelope me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Message</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Pesan baru</h6>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item text-center">See all message</a>
            </div>
        </div>

        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-bell me-lg-2"></i>
                <span class="d-none d-lg-inline-flex">Notification</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item">
                    <h6 class="fw-normal mb-0">Notifikasi baru</h6>
                </a>
                <hr class="dropdown-divider">
                <a href="#" class="dropdown-item text-center">See all notifications</a>
            </div>
        </div>

        <div class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">

        {{-- CARA BARU: Ambil foto langsung dari Auth User --}}
        <img class="rounded-circle me-lg-2"
             src="{{ Auth::user()->getProfilePictureUrl() }}"
             alt="User"
             style="width: 40px; height: 40px; object-fit: cover;">

        {{-- CARA BARU: Ambil nama langsung dari Auth User --}}
        <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
        <a href="{{ route('pages.profile.show') }}" class="dropdown-item">
            <i class="fas fa-user me-2"></i>My Profile
        </a>

                {{-- ... menu lainnya ... --}}
                <a href="#" class="dropdown-item">
                    <i class="fas fa-cog me-2"></i>Settings
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('pages.auth.logout') }}" method="POST" class="d-inline w-100">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger w-100 border-0 bg-transparent"
                        onclick="return confirm('Yakin ingin logout?')">
                        <i class="fas fa-sign-out-alt me-2"></i>Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->
