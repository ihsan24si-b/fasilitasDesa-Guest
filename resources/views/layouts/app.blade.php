<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'FDPR Dashboard')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="{{ asset('assets/img/favicon.ico') }}" rel="icon">

    @include('layouts.css')
    @stack('styles')

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }

        /* === PERBAIKAN JARAK HEADER === */
        .main-content {
            min-height: 100vh;
            padding: 0;
            /* Jarak ini disesuaikan dengan tinggi Header (Top Bar + Navbar) */
            margin-top: 110px;
        }

        /* Wrapper Konten Putih */
        .content-wrapper {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            padding: 25px;
            min-height: 400px;
            margin-bottom: 40px;
        }

        /* Page Header Style */
        .page-header {
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 15px;
            margin-bottom: 25px;
            margin-top: 20px;
        }

        .page-header h1 {
            color: #2c3e50;
            font-weight: 700;
            font-size: 1.8rem;
            margin: 0;
        }

        .page-header .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 5px 0 0 0;
            font-size: 0.9rem;
        }

        /* Utilities */
        .card { border: none; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.05); margin-bottom: 25px; }
        .btn-primary { background-color: #009CFF; border-color: #009CFF; }
        .btn-primary:hover { background-color: #0081d6; border-color: #0081d6; }

        /* Responsive */
        @media (max-width: 991px) {
            .main-content {
                margin-top: 100px; /* Sedikit lebih kecil di layar tablet/mobile */
            }
            .content-wrapper { padding: 15px; }
        }
    </style>
</head>

<body>
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center" style="z-index: 9999;">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    @include('layouts.header')
    <div class="main-content">
        <div class="container-fluid px-0">

            {{-- Logika Tampilan: Dashboard Full Width vs Halaman Admin Container --}}
            @if(request()->routeIs('dashboard'))

                @yield('content')

            @else

                <div class="container">
                    {{-- Judul Halaman --}}
                    <div class="page-header">
                        <h1>@yield('page-title', 'Halaman')</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">@yield('page-title', 'Halaman')</li>
                            </ol>
                        </nav>
                    </div>

                    {{-- Konten Utama --}}
                    <div class="content-wrapper">
                        @yield('content')
                    </div>
                </div>

            @endif

        </div>
    </div>
    @include('layouts.footer')
    @include('layouts.js')
    @stack('scripts')

    <div class="whatsapp-bubble">
        <a href="https://wa.me/6285836124648x?text=Halo,%20saya%20ingin%20bertanya%20tentang%20fasilitas%20desa" target="_blank" class="whatsapp-link" title="Hubungi via WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <style>
        .whatsapp-bubble { position: fixed; bottom: 25px; right: 25px; z-index: 9999; }
        .whatsapp-link { display: flex; align-items: center; justify-content: center; width: 60px; height: 60px; background: #25D366; border-radius: 50%; box-shadow: 0 4px 20px rgba(37, 211, 102, 0.5); color: white; font-size: 30px; transition: all 0.3s ease; text-decoration: none; animation: pulse 2s infinite; }
        .whatsapp-link:hover { transform: scale(1.1); background: #128C7E; color: white; }
        @keyframes pulse { 0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); } 70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); } 100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); } }
    </style>

    <script>
        window.addEventListener('load', function() {
            const spinner = document.getElementById('spinner');
            if(spinner) spinner.style.display = 'none';
        });
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s'; alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>
