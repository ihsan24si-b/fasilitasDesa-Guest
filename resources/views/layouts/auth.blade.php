<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FDPR Admin')</title>
    
    <link href="{{ asset('assets/img/favicon.ico') }}" rel="icon">
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* --- VARIABLES (BLUE THEME) --- */
        :root {
            /* Warna Biru Utama (Modern Blue) */
            --primary: #2563eb;          /* Blue 600 */
            --primary-hover: #1d4ed8;    /* Blue 700 */
            --primary-soft: rgba(37, 99, 235, 0.1); 
            
            /* Background */
            --bg-body: #eff6ff;          /* Blue 50 (Very light blue) */
            --input-bg: #f8fafc;         /* Slate 50 */
            
            /* Text & Borders */
            --text-main: #1e293b;        /* Slate 800 */
            --text-muted: #64748b;       /* Slate 500 */
            --border-color: #cbd5e1;
            
            /* Radius */
            --radius-md: 12px;
            --radius-lg: 24px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            background-color: var(--bg-body);
            display: flex;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-x: hidden;
        }

        /* Background Decoration (Blobs Biru) */
        .bg-decor { position: fixed; width: 100vw; height: 100vh; top: 0; left: 0; z-index: -1; overflow: hidden; }
        .blob { position: absolute; filter: blur(80px); opacity: 0.5; z-index: -1; }
        .blob-1 { top: -10%; left: -10%; width: 500px; height: 500px; background: #60a5fa; border-radius: 50%; animation: float 10s infinite alternate; }
        .blob-2 { bottom: -10%; right: -10%; width: 600px; height: 600px; background: #93c5fd; border-radius: 50%; animation: float 12s infinite alternate-reverse; }

        @keyframes float {
            0% { transform: translate(0, 0); }
            100% { transform: translate(30px, 50px); }
        }

        /* --- MAIN CONTAINER --- */
        .auth-container {
            background: rgba(255, 255, 255, 0.9);
            width: 100%;
            max-width: 1100px;
            border-radius: var(--radius-lg);
            box-shadow: 0 25px 50px -12px rgba(30, 64, 175, 0.15); /* Shadow agak biru */
            display: flex;
            overflow: hidden;
            position: relative;
            backdrop-filter: blur(20px); /* Efek kaca */
            border: 1px solid rgba(255,255,255,0.8);
        }

        /* --- LEFT SIDE (FORM) --- */
        .auth-left {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            z-index: 2;
        }

        .brand-logo { display: flex; align-items: center; gap: 12px; margin-bottom: 40px; }
        .brand-logo img { height: 40px; width: auto; }
.brand-text { 
            font-size: 16px;          /* Ukuran font diperkecil (dari 20px) */
            font-weight: 700;         /* Ketebalan font */
            color: var(--primary); 
            letter-spacing: normal;   /* Jarak antar huruf normal */
            text-transform: none;     /* INI KUNCINYA: Menghilangkan efek kapital semua */
            line-height: 1.4;         /* Jarak antar baris jika teks turun ke bawah */
        }
        .auth-header { margin-bottom: 30px; }
        .auth-title { font-size: 32px; font-weight: 800; color: var(--text-main); margin-bottom: 8px; line-height: 1.2; letter-spacing: -1px; }
        .auth-subtitle { color: var(--text-muted); font-size: 15px; font-weight: 500; }

        /* --- FORM ELEMENTS --- */
        .form-group { margin-bottom: 20px; position: relative; }
        .form-label { display: block; font-size: 14px; font-weight: 600; color: var(--text-main); margin-bottom: 8px; }

        /* Custom Input Wrapper */
        .input-wrapper { position: relative; }
        
        .input-wrapper i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
            transition: color 0.3s;
            z-index: 2;
        }

        .form-control {
            width: 100%;
            padding: 15px 16px 15px 50px; /* Space for icon */
            font-size: 15px;
            border: 2px solid #e2e8f0;
            border-radius: var(--radius-md);
            background-color: var(--input-bg);
            color: var(--text-main);
            transition: all 0.3s ease;
            outline: none;
            font-weight: 500;
        }

        .form-control::placeholder { color: #cbd5e1; font-weight: 400; }

        .form-control:focus {
            background-color: #fff;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-soft);
        }

        .form-control:focus + i, .input-wrapper:focus-within i {
            color: var(--primary);
        }

        /* Button */
        .btn-primary {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
            color: white;
            border: none;
            border-radius: var(--radius-md);
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 15px;
            box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.4);
            letter-spacing: 0.5px;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px -5px rgba(37, 99, 235, 0.5);
        }

        /* Footer Links */
        .auth-footer { margin-top: 30px; text-align: center; font-size: 14px; color: var(--text-muted); }
        .auth-footer a { color: var(--primary); text-decoration: none; font-weight: 700; }
        .auth-footer a:hover { text-decoration: underline; }

        /* Alerts */
        .alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 24px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            line-height: 1.5;
        }
        .alert-error, .alert-danger { background-color: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
        .alert-success { background-color: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; } /* Success jadi biru juga biar senada */
        
        .alert ul { margin: 0; padding-left: 20px; }
        .text-danger { font-size: 12px; color: #ef4444; margin-top: 6px; display: block; font-weight: 500; }

        /* --- RIGHT SIDE (IMAGE) --- */
        .auth-right {
            flex: 1.1;
            /* Background pattern garis-garis halus biru */
            background-color: #f8fafc;
            background-image:  linear-gradient(#e2e8f0 1px, transparent 1px), linear-gradient(to right, #e2e8f0 1px, transparent 1px);
            background-size: 40px 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 40px;
            overflow: hidden;
        }
        
        /* Overlay gradient biru biar patternnya ga terlalu tajam */
        .auth-right::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, transparent 0%, #f8fafc 100%);
        }

        .image-card {
            position: relative;
            width: 100%;
            max-width: 420px;
            aspect-ratio: 4/5;
            z-index: 2;
            transition: transform 0.5s;
        }
        
        .image-card:hover {
            transform: scale(1.02);
        }

        .image-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(30, 64, 175, 0.25); /* Bayangan biru */
            border: 8px solid #fff;
            position: relative;
            z-index: 2;
        }

        /* Decorative Elements di belakang gambar */
        .circle-decor {
            position: absolute;
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, var(--primary) 0%, #60a5fa 100%);
            border-radius: 50%;
            top: -30px;
            right: -30px;
            z-index: 1;
            opacity: 0.8;
        }
        
        .dots-decor {
            position: absolute;
            bottom: -40px;
            left: -40px;
            width: 150px;
            height: 150px;
            background-image: radial-gradient(var(--primary) 2px, transparent 2px);
            background-size: 20px 20px;
            opacity: 0.4;
            z-index: 1;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .auth-right { display: none; }
            .auth-container { max-width: 480px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
            .auth-left { padding: 40px 30px; }
            .blob { opacity: 0.8; } /* Lebih terlihat di mobile */
        }
    </style>
</head>
<body>

    <div class="bg-decor">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <div class="auth-container">
        <div class="auth-left">
            <div class="brand-logo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                <span class="brand-text">Fasilitas Desa dan Peminjaman Ruang</span>
            </div>
            
            @yield('content')

            <div class="auth-footer">
                &copy; {{ date('Y') }} Sistem Informasi Fasilitas Desa.
            </div>
        </div>

        <div class="auth-right">
            <div class="image-card">
                <div class="circle-decor"></div>
                <div class="dots-decor"></div>
                <img src="{{ asset('assets/img/gambar.png') }}" alt="Ilustrasi Desa">
            </div>
        </div>
    </div>

    <script>
        // Auto hide alerts logic
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>