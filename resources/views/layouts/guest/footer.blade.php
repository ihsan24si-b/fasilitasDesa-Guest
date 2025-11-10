<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 footer pt-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                <a href="{{ route('homepage') }}" class="d-inline-block mb-3">
                    <h1 class="text-white">
                        <i data-feather="home" style="width: 32px; height: 32px;"></i> iSTUDIO
                    </h1>
                </a>
                <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                    amet diam et eos labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus
                    clita duo justo et tempor</p>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                <h5 class="text-white mb-4">Get In Touch</h5>
                <p><i data-feather="map-pin" style="width: 16px; height: 16px;"></i> 123 Street, New York, USA</p>
                <p><i data-feather="phone" style="width: 16px; height: 16px;"></i> +012 345 67890</p>
                <p><i data-feather="mail" style="width: 16px; height: 16px;"></i> info@example.com</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-primary btn-square border-2 me-2" href="">
                        <i data-feather="twitter" style="width: 16px; height: 16px;"></i>
                    </a>
                    <a class="btn btn-outline-primary btn-square border-2 me-2" href="">
                        <i data-feather="facebook" style="width: 16px; height: 16px;"></i>
                    </a>
                    <a class="btn btn-outline-primary btn-square border-2 me-2" href="">
                        <i data-feather="youtube" style="width: 16px; height: 16px;"></i>
                    </a>
                    <a class="btn btn-outline-primary btn-square border-2 me-2" href="">
                        <i data-feather="instagram" style="width: 16px; height: 16px;"></i>
                    </a>
                    <a class="btn btn-outline-primary btn-square border-2 me-2" href="">
                        <i data-feather="linkedin" style="width: 16px; height: 16px;"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                <h5 class="text-white mb-4">Popular Link</h5>
                <a class="btn btn-link" href="{{ url('/about') }}">
                    <i data-feather="info" style="width: 16px; height: 16px;"></i> About Us
                </a>
                <a class="btn btn-link" href="{{ route('contact') }}">
                    <i data-feather="phone" style="width: 16px; height: 16px;"></i> Contact Us
                </a>
                <a class="btn btn-link" href="">
                    <i data-feather="shield" style="width: 16px; height: 16px;"></i> Privacy Policy
                </a>
                <a class="btn btn-link" href="">
                    <i data-feather="file-text" style="width: 16px; height: 16px;"></i> Terms & Condition
                </a>
                <a class="btn btn-link" href="">
                    <i data-feather="briefcase" style="width: 16px; height: 16px;"></i> Career
                </a>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                <h5 class="text-white mb-4">Our Services</h5>
                <a class="btn btn-link" href="{{ route('services') }}">
                    <i data-feather="layout" style="width: 16px; height: 16px;"></i> Interior Design
                </a>
                <a class="btn btn-link" href="{{ route('services') }}">
                    <i data-feather="clipboard" style="width: 16px; height: 16px;"></i> Project Planning
                </a>
                <a class="btn btn-link" href="{{ route('services') }}">
                    <i data-feather="tool" style="width: 16px; height: 16px;"></i> Renovation
                </a>
                <a class="btn btn-link" href="{{ route('services') }}">
                    <i data-feather="check-square" style="width: 16px; height: 16px;"></i> Implement
                </a>
                <a class="btn btn-link" href="{{ route('services') }}">
                    <i data-feather="feather" style="width: 16px; height: 16px;"></i> Landscape Design
                </a>
            </div>
        </div>
    </div>
    <div class="container wow fadeIn" data-wow-delay="0.1s">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">{{ config('app.name', 'Your Site Name') }}</a>, All Right Reserved.
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="{{ route('homepage') }}">
                            <i data-feather="home" style="width: 14px; height: 14px;"></i> Home
                        </a>
                        <a href="">
                            <i data-feather="shield" style="width: 14px; height: 14px;"></i> Cookies
                        </a>
                        <a href="">
                            <i data-feather="help-circle" style="width: 14px; height: 14px;"></i> Help
                        </a>
                        <a href="">
                            <i data-feather="message-circle" style="width: 14px; height: 14px;"></i> FAQs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
