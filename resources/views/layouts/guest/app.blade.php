<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'iSTUDIO - Interior Design Website Template Free')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    @include('layouts.guest.css')

    <!-- Pagination Fix Styles -->
    <style>
        /*** Pagination Fix ***/
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 4px;
            margin: 0;
            padding: 0;
            list-style: none;
            flex-wrap: wrap;
        }

        .page-item {
            margin: 0;
        }

        .page-link {
            display: block;
            padding: 8px 12px;
            border: 1px solid #dee2e6;
            background: white;
            color: #0d6b68;
            text-decoration: none;
            border-radius: 4px;
            min-width: 40px;
            text-align: center;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .page-link:hover {
            background: #e6f0ef;
            border-color: #0d6b68;
            color: #0d6b68;
        }

        .page-item.active .page-link {
            background: #0d6b68 !important;
            color: white !important;
            border-color: #0d6b68 !important;
        }

        .page-item.disabled .page-link {
            color: #6c757d !important;
            background: #f8f9fa !important;
            border-color: #dee2e6 !important;
            pointer-events: none;
        }

        .pagination-info {
            color: #666;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .pagination {
                gap: 2px;
            }
            .page-link {
                padding: 6px 8px;
                min-width: 35px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    @include('layouts.guest.header')

    <!-- Content -->
    @yield('content')

    @include('layouts.guest.footer')

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    @include('layouts.guest.js')

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6285836124648?text=Halo%20admin,%20saya%20ingin%20bertanya%20tentang%20sistem%20management%20warga%20ini"
       class="whatsapp-float"
       target="_blank"
       title="Hubungi kami via WhatsApp">
        <i data-feather="message-circle"></i>
    </a>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
</body>
</html>
