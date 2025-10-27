@extends('layouts.app')

@section('title', 'iSTUDIO - Interior Design Website Template Free')

@section('content')
    <!-- Hero Start -->
    <div class="container-fluid pb-5 hero-header bg-light mb-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center mb-5">
                <div class="col-lg-6">
                    <h1 class="display-1 mb-4 animated slideInRight">We Make Your <span class="text-primary">Home</span>
                        Better</h1>
                    <h5 class="d-inline-block border border-2 border-white py-3 px-5 mb-0 animated slideInRight">
                        An Award Winning Studio Since 1990</h5>
                </div>
                <div class="col-lg-6">
                    <div class="owl-carousel header-carousel animated fadeIn">
                        <img class="img-fluid" src="{{ asset('assets/img/hero-slider-1.jpg') }}" alt="">
                        <img class="img-fluid" src="{{ asset('assets/img/hero-slider-2.jpg') }}" alt="">
                        <img class="img-fluid" src="{{ asset('assets/img/hero-slider-3.jpg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row g-5 animated fadeIn">
                <div class="col-md-6 col-lg-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 btn-square border border-2 border-white me-3">
                            <i class="fa fa-robot text-primary"></i>
                        </div>
                        <h5 class="lh-base mb-0">Crafted Furniture</h5>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 btn-square border border-2 border-white me-3">
                            <i class="fa fa-robot text-primary"></i>
                        </div>
                        <h5 class="lh-base mb-0">Sustainable Material</h5>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 btn-square border border-2 border-white me-3">
                            <i class="fa fa-robot text-primary"></i>
                        </div>
                        <h5 class="lh-base mb-0">Innovative Architects</h5>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 btn-square border border-2 border-white me-3">
                            <i class="fa fa-robot text-primary"></i>
                        </div>
                        <h5 class="lh-base mb-0">Budget Friendly</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-6 wow fadeIn" data-wow-delay="0.1s">
                            <img class="img-fluid" src="{{ asset('assets/img/about-1.jpg') }}" alt="">
                        </div>
                        <div class="col-6 wow fadeIn" data-wow-delay="0.3s">
                            <img class="img-fluid h-75" src="{{ asset('assets/img/about-2.jpg') }}" alt="">
                            <div class="h-25 d-flex align-items-center text-center bg-primary px-4">
                                <h4 class="text-white lh-base mb-0">Award Winning Studio Since 1990</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="mb-5"><span class="text-uppercase text-primary bg-light px-2">History</span> of Our
                        Creation</h1>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                        amet diam et eos labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus
                        clita duo justo et tempor eirmod magna dolore erat amet</p>
                    <p class="mb-5">Aliqu diam amet diam et eos labore. Clita erat ipsum et lorem et sit, sed stet no
                        labore lorem sit. Sanctus clita duo justo et tempor.</p>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <h6 class="mb-3"><i class="fa fa-check text-primary me-2"></i>Award Winning</h6>
                            <h6 class="mb-0"><i class="fa fa-check text-primary me-2"></i>Professional Staff</h6>
                        </div>
                        <div class="col-sm-6">
                            <h6 class="mb-3"><i class="fa fa-check text-primary me-2"></i>24/7 Support</h6>
                            <h6 class="mb-0"><i class="fa fa-check text-primary me-2"></i>Fair Prices</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-5">
                        <a class="btn btn-primary px-4 me-2" href="">Read More</a>
                        <a class="btn btn-outline-primary btn-square border-2 me-2" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-primary btn-square border-2 me-2" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-primary btn-square border-2 me-2" href=""><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-outline-primary btn-square border-2" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Tambahkan section lainnya di sini -->
@endsection

@push('scripts')
<script>
    // Script khusus untuk homepage
    $(document).ready(function() {
        // Inisialisasi carousel, dll
    });
</script>
@endpush