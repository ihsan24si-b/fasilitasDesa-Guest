<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded-top p-4">
        <div class="row align-items-center">
            
            {{-- BAGIAN KIRI: Copyright & Tahun Dinamis --}}
            <div class="col-12 col-sm-6 text-center text-sm-start">
                <span class="text-muted">
                    &copy; {{ date('Y') }} 
                    <a href="#" class="text-primary fw-bold text-decoration-none">FDPR-ADMIN</a>.
                </span>
                All Right Reserved. 
            </div>

            {{-- BAGIAN KANAN: Credit & Versi --}}
            <div class="col-12 col-sm-6 text-center text-sm-end mt-2 mt-sm-0">
                <span class="text-muted small">
                    Handcrafted </i> by 
                    <a href="https://github.com/farrel24si" target="_blank" class="fw-bold text-dark text-decoration-none">
                        Farrel
                    </a>
                </span>
                <span class="mx-2 text-muted">|</span>
                <span class="badge bg-primary rounded-pill">v1.0.0</span>
            </div>

        </div>
    </div>
</div>
{{-- CSS Tambahan Khusus Footer (Bisa ditaruh di style.css juga) --}}
<style>
    /* Efek detak jantung untuk icon love */
    @keyframes pulse-red {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }
    .animate-pulse {
        animation: pulse-red 2s infinite;
    }
</style>