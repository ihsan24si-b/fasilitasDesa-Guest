<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> --}}
    <!-- Primary Meta Tags -->
    <meta charset="utf-8">
    <title>Guest - @yield ('title') </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta name="title" content="Dashboard - Kategori Pengaduan">
    <meta name="author" content="Themesberg">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets-admin/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets-admin/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets-admin/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets-admin/img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('assets-admin/img/favicon/safari-pinned-tab.svg') }}" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff"> --}}

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    {{-- <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet"> --}}

    @include('layouts.guest.js')


    {{-- start css  --}}
        @include('layouts.guest.css')
    {{-- end css  --}}
</head>

<body>
    {{-- navbar start --}}
    @include('layouts.guest.header')
    {{-- navbar end --}}

        {{-- di sini konten halaman lain akan muncul --}}
    <main class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>

    {{-- start footer  --}}
        @include('layouts.guest.footer')
    {{-- end footer  --}}

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

</main>
    <!-- START JAVASCRIPT -->
        @include('layouts.guest.js')
    <!-- END JAVASCRIPT -->
</body>

</html>
