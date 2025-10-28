<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'FDPR')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets/img/favicon.ico') }}" rel="icon">

    @include('layouts.css')
    @stack('styles')
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        @include('layouts.sidebar')

        <!-- Content Start -->
        <div class="content">
            @include('layouts.header')

            <!-- Main Content -->
            @yield('content')

            @include('layouts.footer')
        </div>
        <!-- Content End -->
    </div>

    @include('layouts.js')
    @stack('scripts')

    <!-- WhatsApp Bubble Button -->
    <div class="whatsapp-bubble">
        <a href="https://wa.me/6281378006219?text=Halo,%20saya%20ingin%20bertanya%20tentang%20fasilitas%20desa"
           target="_blank"
           class="whatsapp-link"
           title="Hubungi via WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <style>
        .whatsapp-bubble {
            position: fixed;
            bottom: 25px;
            right: 25px;
            z-index: 9999;
        }

        .whatsapp-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background: #25D366;
            border-radius: 50%;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.5);
            transition: all 0.3s ease;
            text-decoration: none;
            animation: pulse 2s infinite;
        }

        .whatsapp-link:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 25px rgba(37, 211, 102, 0.7);
            background: #128C7E;
        }

        .whatsapp-link i {
            font-size: 30px;
            color: white;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
            }
            70% {
                box-shadow: 0 0 0 15px rgba(37, 211, 102, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .whatsapp-bubble {
                bottom: 20px;
                right: 20px;
            }

            .whatsapp-link {
                width: 55px;
                height: 55px;
            }

            .whatsapp-link i {
                font-size: 28px;
            }
        }
    </style>
</body>

</html>
