<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Bina Desa - Website Resmi Desa')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    @include('layouts.css')
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    @include('layouts.header')

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- Floating WhatsApp Button -->
    <div class="whatsapp-float">
        <div class="whatsapp-btn" id="whatsappBtn">
            <i class="fab fa-whatsapp"></i>
        </div>
        <div class="whatsapp-tooltip">
            Hubungi Kami via WhatsApp
        </div>
    </div>

    <!-- WhatsApp Modal -->
    <div class="whatsapp-modal" id="whatsappModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Hubungi Kami via WhatsApp</h3>
                <span class="close-btn" id="closeModal">&times;</span>
            </div>
            <div class="modal-body">
                <p>Pilih nomor yang ingin dihubungi:</p>
                <div class="contact-options">
                    <button class="contact-btn" data-number="6281234567890">
                        <i class="fab fa-whatsapp"></i>
                        Customer Service
                    </button>
                    <button class="contact-btn" data-number="6289876543210">
                        <i class="fab fa-whatsapp"></i>
                        Sales Team
                    </button>
                </div>

                <div class="custom-message">
                    <label for="message">Pesan Kustom (Opsional):</label>
                    <textarea id="message" placeholder="Tulis pesan Anda di sini..."></textarea>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.js')

    <!-- WhatsApp Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const whatsappBtn = document.getElementById('whatsappBtn');
            const whatsappModal = document.getElementById('whatsappModal');
            const closeModal = document.getElementById('closeModal');
            const contactBtns = document.querySelectorAll('.contact-btn');
            const messageTextarea = document.getElementById('message');

            // Buka modal
            whatsappBtn.addEventListener('click', function() {
                whatsappModal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            });

            // Tutup modal
            closeModal.addEventListener('click', function() {
                whatsappModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            });

            // Tutup modal ketika klik di luar
            window.addEventListener('click', function(event) {
                if (event.target === whatsappModal) {
                    whatsappModal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });

            // Fungsi buka WhatsApp
            function openWhatsApp(phoneNumber, message = '') {
                const formattedNumber = phoneNumber.replace(/\D/g, '');
                const encodedMessage = encodeURIComponent(message);
                const whatsappUrl = `https://wa.me/${formattedNumber}?text=${encodedMessage}`;

                window.open(whatsappUrl, '_blank');
                whatsappModal.style.display = 'none';
                document.body.style.overflow = 'auto';
                messageTextarea.value = '';
            }

            // Event listener untuk tombol kontak
            contactBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const phoneNumber = this.getAttribute('data-number');
                    const customMessage = messageTextarea.value;
                    const defaultMessage = 'Halo, saya tertarik dengan layanan Anda. Bisa beri informasi lebih lanjut?';
                    const finalMessage = customMessage.trim() || defaultMessage;

                    openWhatsApp(phoneNumber, finalMessage);
                });
            });
        });
    </script>
</body>

</html>
