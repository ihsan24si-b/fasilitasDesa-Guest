<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Ihsan Admin')</title>
    <style>
        /* ---------- Variables ---------- */
        :root{
            --primary: #0f766e;        /* teal dark */
            --primary-2: #1fb6a0;      /* teal light */
            --accent: #0b6b61;
            --bg: #e9f5f2;             /* pale seafoam */
            --card-bg: rgba(255,255,255,0.95);
            --muted: #5b6b66;
            --danger: #e74c3c;
            --success: #28a745;
            --radius: 14px;
            --container-width: 1100px;
            --shadow-lg: 0 18px 50px rgba(4,20,30,0.15);
        }

        /* ---------- Reset ---------- */
        *{box-sizing:border-box;margin:0;padding:0}
        html,body{height:100%}
        body{
            font-family: "Segoe UI", "Helvetica Neue", Arial, sans-serif;
            background: linear-gradient(135deg, #eaf6f3 0%, var(--bg) 100%);
            color: #113;
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
            padding: 36px;
            display:flex;
            align-items:center;
            justify-content:center;
            min-height:100vh;
        }

        /* Decorative background circles (like screenshot) */
        .bg-decor {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }
        .bg-decor::before,
        .bg-decor::after{
            content: "";
            position: absolute;
            border-radius: 50%;
            opacity: 0.06;
            background: radial-gradient(circle at center, #fff 0%, #cfe9e4 60%);
            transform: translate(-10%, -10%);
        }
        .bg-decor::before{
            width: 720px;
            height: 720px;
            left: -180px;
            top: -120px;
        }
        .bg-decor::after{
            width: 680px;
            height: 680px;
            right: -220px;
            bottom: -120px;
        }

        /* ---------- Main card (hero style) ---------- */
        .auth-container{
            width:100%;
            max-width:var(--container-width);
            background: var(--card-bg);
            border-radius: calc(var(--radius) + 6px);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 480px; /* two-column hero: content | image */
            gap: 28px;
            position: relative;
            padding: 44px;
            z-index: 2;
        }

        /* left content */
        .left {
            padding-right: 12px;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        .app-title {
            color: var(--primary);
            font-size: 22px;
            font-weight: 800;
            letter-spacing: .6px;
            margin-bottom: 6px;
            text-transform: uppercase;
        }

        .app-subtitle{
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 18px;
            font-weight:600;
        }

        /* Hero headline like screenshot */
        h2{
            font-size: 44px;
            line-height: 1;
            margin-bottom: 22px;
            color: #083532;
            font-weight: 800;
            letter-spacing: -0.6px;
        }
        h2 .accent {
            display:block;
            color: var(--primary);
            font-weight: 900;
            font-size: 52px;
            margin-top: 4px;
        }

        /* small tagline box */
        .tagline {
            display:inline-block;
            padding: 12px 18px;
            border: 2px solid rgba(11,107,97,0.12);
            border-radius: 10px;
            color: var(--muted);
            font-weight:600;
            margin-bottom: 22px;
            background: rgba(255,255,255,0.7);
        }

        /* form area sits under headline */
        form {
            margin-top: 8px;
            width: 100%;
        }

        .form-group { margin-bottom: 14px; }
        label{display:block;font-weight:700;color: #123; margin-bottom:6px;font-size:13px}
        input{
            width:100%;
            padding:12px 14px;
            border-radius:10px;
            border:1px solid rgba(6,20,18,0.06);
            background: rgba(245,250,249,0.9);
            font-size:14px;
            transition: box-shadow .18s ease, transform .12s ease;
        }
        input:focus{
            outline:none;
            box-shadow: 0 10px 30px rgba(12,115,102,0.08);
            transform: translateY(-1px);
            border-color: var(--primary-2);
            background: #fff;
        }
        .input-error{ border-color: rgba(231,76,60,0.9); background: rgba(231,76,60,0.03); }

        small{ display:block; color:var(--muted); margin-top:6px; font-size:12px }

        .text-danger{ color:var(--danger); margin-top:6px; font-size:13px }

        /* Buttons */
        .btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:12px 16px;
            border-radius:12px;
            border:none;
            cursor:pointer;
            font-weight:800;
            letter-spacing:.2px;
            font-size:15px;
            transition: transform .12s ease, box-shadow .15s ease;
        }
        .btn-login{
            width:100%;
            background: linear-gradient(180deg,var(--primary),var(--accent));
            color:#fff;
            box-shadow: 0 14px 40px rgba(11,107,97,0.14);
            margin-top:8px;
        }
        .btn-login:hover{ transform: translateY(-2px); }

        .btn-register{
            width:100%;
            background: linear-gradient(180deg,#22c1a8,#0aa185);
            color:#fff;
            box-shadow: 0 10px 28px rgba(12,160,140,0.12);
        }

        /* alerts */
        .alert{
            padding:12px 16px;
            border-radius:10px;
            margin-bottom:12px;
            font-weight:600;
            font-size:14px;
        }
        .alert-success{ background: rgba(40,167,69,0.07); color:var(--success); border:1px solid rgba(40,167,69,0.12) }
        .alert-error{ background: rgba(231,76,60,0.06); color:var(--danger); border:1px solid rgba(231,76,60,0.12) }

        /* ---------- Right image card (hero image like screenshot) ---------- */
        .visual {
            display:flex;
            align-items:center;
            justify-content:center;
            position:relative;
        }

        .visual .image-wrap {
            width:100%;
            max-width:360px;
            height:260px;
            background: var(--primary);
            border-radius:8px;
            box-shadow: 0 18px 40px rgba(2,40,35,0.12);
            position:relative;
            overflow:visible;
        }

        /* the framed photo */
        .visual .image {
            position:absolute;
            right: -28px;
            top: -32px;
            width:320px;
            height:220px;
            object-fit:cover;
            border-radius:6px;
            box-shadow: 0 18px 40px rgba(10,20,20,0.18);
            border: 10px solid rgba(255,255,255,0.85);
            background-size:cover;
            background-position:center;
        }

        /* small carousel bullets vertical */
        .visual .dots {
            position:absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            display:flex;
            flex-direction:column;
            gap:8px;
        }
        .visual .dots span{
            width:12px;height:12px;border-radius:3px;background:rgba(255,255,255,0.9);display:block;
            box-shadow: 0 6px 18px rgba(2,40,35,0.08);
        }

        /* auth-link footer */
        .auth-link{ margin-top:20px;padding-top:18px;border-top:1px solid rgba(6,20,18,0.03); text-align:left }
        .auth-link p{ color:var(--muted); font-size:13px }
        .auth-link a{ color:var(--primary); font-weight:800; text-decoration:none }
        .auth-link a:hover{ text-decoration:underline }

        /* responsive: stack columns on small screens */
        @media (max-width: 980px){
            .auth-container{
                grid-template-columns: 1fr;
                padding:28px;
            }
            .visual{ order:-1; margin-bottom: 12px; justify-content:center }
            .visual .image { position:relative; right:auto; top:auto; width:100%; height:220px; border-width:12px; }
            h2{ font-size:32px }
            h2 .accent{ font-size:36px }
        }

        @media (max-width:480px){
            body{ padding:18px }
            .auth-container{ padding:18px }
            h2{ font-size:26px }
            .visual .image{ height:180px }
        }

    </style>
</head>
<body>
    <div class="bg-decor" aria-hidden="true"></div>

    <div class="auth-container">
        <div class="left">
            <div class="app-title">Fasilitas Desa</div>
            <div class="app-subtitle"></div>

            <!-- Hero style heading: keep original h2 in views; but many of your forms already use h2 -->
            @yield('content')
        </div>

        <div class="visual" aria-hidden="true">
            <div class="image-wrap" role="presentation">
                <!-- replace the URL below with any image path you like; this is decorative only -->
                <div class="image" style="background-image: url('/img/hero-kitchen.jpg');"></div>
                <div class="dots">
                    <span></span><span></span><span></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Note: spinner kept out but not required -->
</body>
</html>
