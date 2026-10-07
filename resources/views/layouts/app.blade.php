<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SOUND Entertainment') - SOUND Group</title>
    <meta name="description" content="@yield('meta_description', 'SOUND Entertainment - Your premier destination for Regional and English Music and Videos.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* ============================
           SOUND ENTERTAINMENT - 3D GLASSMOPHISM THEME
           ============================ */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg-dark:    #070a14;
            --bg-card:    rgba(18, 24, 43, 0.75);
            --bg-card2:   rgba(25, 33, 56, 0.85);
            --primary:    #6366f1;
            --primary-lt: #818cf8;
            --accent:     #ec4899;
            --emerald:    #10b981;
            --gold:       #f59e0b;
            --danger:     #ef4444;
            --text:       #f1f5f9;
            --text-muted: #94a3b8;
            --border:     rgba(255, 255, 255, 0.1);
            --radius:     14px;
            --radius-lg:  22px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-dark);
            background-image: 
                radial-gradient(at 10% 10%, rgba(99, 102, 241, 0.18) 0px, transparent 50%),
                radial-gradient(at 90% 80%, rgba(236, 72, 153, 0.15) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(7, 10, 20, 0.95) 0px, transparent 100%);
            background-attachment: fixed;
            color: var(--text);
            min-height: 100vh;
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }

        a { text-decoration: none; color: inherit; }
        img { max-width: 100%; }

        /* ---- NAVBAR ---- */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 36px;
            height: 72px;
            background: rgba(7, 10, 20, 0.9);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(20px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Outfit', sans-serif;
            font-weight: 900;
            font-size: 1.5rem;
            color: #fff;
            letter-spacing: -0.5px;
        }
        .navbar-brand .logo-icon {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, #6366f1, #ec4899);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.6);
            animation: pulse-glow 3s infinite alternate;
        }
        @keyframes pulse-glow {
            0% { box-shadow: 0 0 15px rgba(99, 102, 241, 0.5); }
            100% { box-shadow: 0 0 25px rgba(236, 72, 153, 0.7); }
        }

        .navbar-center {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
        }
        .navbar-nav a {
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-muted);
            transition: all 0.25s ease;
        }
        .navbar-nav a:hover,
        .navbar-nav a.active {
            color: #fff;
            background: rgba(99, 102, 241, 0.18);
            border: 1px solid rgba(99, 102, 241, 0.3);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        /* Nav Search Bar */
        .nav-search-wrap {
            position: relative;
            display: flex;
            align-items: center;
            width: 260px;
            transition: width 0.3s ease;
        }
        .nav-search-wrap:focus-within {
            width: 320px;
        }
        .nav-search-input {
            width: 100%;
            padding: 8px 16px 8px 38px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 50px;
            color: #fff;
            font-size: 0.85rem;
            outline: none;
            transition: all 0.25s ease;
        }
        .nav-search-input:focus {
            background: rgba(255, 255, 255, 0.12);
            border-color: var(--primary-lt);
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.3);
        }
        .nav-search-icon {
            position: absolute;
            left: 12px;
            font-size: 14px;
            color: #94a3b8;
            pointer-events: none;
        }

        .navbar-actions { display: flex; align-items: center; gap: 12px; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 9px 20px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            letter-spacing: 0.2px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }
        .btn-primary:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.6);
        }
        .btn-secondary {
            background: rgba(255, 255, 255, 0.08);
            color: #f1f5f9;
            border: 1px solid rgba(255, 255, 255, 0.12);
        }
        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }
        .btn-outline {
            background: transparent;
            color: var(--text);
            border: 1px solid var(--border);
        }
        .btn-outline:hover { background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.25); }
        .btn-danger { background: var(--danger); color: #fff; }
        .btn-danger:hover { background: #dc2626; }
        .btn-sm { padding: 6px 14px; font-size: 0.8rem; }

        /* Flash alerts */
        .alert {
            padding: 14px 22px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            font-size: 0.95rem;
            font-weight: 600;
            backdrop-filter: blur(10px);
        }
        .alert-success { background: rgba(16,185,129,0.15); border: 1px solid var(--emerald); color: #6ee7b7; }
        .alert-danger  { background: rgba(239,68,68,0.15); border: 1px solid var(--danger); color: #fca5a5; }

        /* Container */
        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Card 3D Aesthetics */
        .card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            backdrop-filter: blur(16px);
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .media-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 24px;
        }

        .category-pill {
            display: inline-flex;
            align-items: center;
            padding: 8px 18px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 50px;
            color: #cbd5e1;
            font-size: 0.88rem;
            font-weight: 600;
            transition: all 0.25s ease;
        }
        .category-pill:hover,
        .category-pill.active {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #fff;
            border-color: transparent;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
            transform: translateY(-2px);
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .badge-info { background: rgba(99, 102, 241, 0.2); color: #a5b4fc; border: 1px solid rgba(99, 102, 241, 0.3); }
        .badge-secondary { background: rgba(255, 255, 255, 0.1); color: #cbd5e1; }
        .badge-success { background: rgba(16, 185, 129, 0.2); color: #6ee7b7; }

        /* ========================================================
           PAGINATION FIX FOR HUGE ARROW GLITCH ACROSS ALL PAGES
           ======================================================== */
        .pagination, nav[role="navigation"] {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            gap: 10px !important;
            margin-top: 30px !important;
            flex-wrap: wrap !important;
        }
        .pagination svg, nav[role="navigation"] svg {
            width: 16px !important;
            height: 16px !important;
            max-width: 16px !important;
            max-height: 16px !important;
            fill: currentColor !important;
            display: inline-block !important;
            vertical-align: middle !important;
        }
        nav[role="navigation"] > div:first-child {
            display: none !important; /* Hide 'Showing 1 to 12 results' text overlay */
        }
        nav[role="navigation"] span, nav[role="navigation"] a {
            padding: 8px 16px !important;
            border-radius: 10px !important;
            background: rgba(255,255,255,0.06) !important;
            color: #cbd5e1 !important;
            border: 1px solid rgba(255,255,255,0.12) !important;
            font-size: 0.88rem !important;
            font-weight: 600 !important;
            text-decoration: none !important;
            transition: all 0.2s ease !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
        }
        nav[role="navigation"] a:hover {
            background: var(--primary) !important;
            color: #fff !important;
            border-color: transparent !important;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4) !important;
        }
        nav[role="navigation"] span[aria-current="page"] span {
            background: linear-gradient(135deg, #6366f1, #ec4899) !important;
            color: #fff !important;
            border-color: transparent !important;
        }

        /* ---- FOOTER ---- */
        .footer {
            background: rgba(5, 7, 15, 0.95);
            border-top: 1px solid rgba(255,255,255,0.08);
            padding: 60px 0 30px;
            margin-top: 80px;
        }
        .footer-inner {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 24px;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
        }
        .footer-brand p {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-top: 14px;
            line-height: 1.7;
        }
        .footer h4 {
            font-size: 1rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 18px;
            letter-spacing: 0.5px;
        }
        .footer ul { list-style: none; }
        .footer ul li { margin-bottom: 10px; }
        .footer ul li a {
            font-size: 0.88rem;
            color: var(--text-muted);
            transition: color 0.2s;
        }
        .footer ul li a:hover { color: var(--primary-lt); }
        .footer-bottom {
            text-align: center;
            margin-top: 40px;
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,0.06);
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        /* Form elements */
        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block;
            font-size: 0.88rem;
            font-weight: 700;
            color: #cbd5e1;
            margin-bottom: 8px;
        }
        .form-control {
            width: 100%;
            padding: 12px 16px;
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            color: var(--text);
            font-size: 0.95rem;
            font-family: inherit;
            outline: none;
            transition: all 0.25s ease;
        }
        .form-control:focus {
            border-color: var(--primary-lt);
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.35);
        }

        /* Global Entry Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(25px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* ============================
           GLOBAL MEDIA CARD SYSTEM
           Used on: music/index, video/index, search, show pages
           ============================ */
        .media-card {
            position: relative;
            background: rgba(18, 24, 43, 0.8);
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: pointer;
        }
        .media-card:hover {
            transform: translateY(-8px) scale(1.025);
            box-shadow: 0 20px 45px rgba(99, 102, 241, 0.38);
            border-color: rgba(99, 102, 241, 0.55);
        }

        /* Square thumbnail (1:1) for music */
        .media-card .thumb {
            width: 100%;
            aspect-ratio: 1 / 1;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
        }
        .media-card:hover .thumb {
            transform: scale(1.06);
        }

        /* 16:9 wrapper for video thumbnails */
        .video-thumb-wrap {
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 9;
            overflow: hidden;
            background: #0f172a;
        }
        .video-thumb-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .media-card:hover .video-thumb-wrap img {
            transform: scale(1.07);
        }

        /* Play overlay on video thumbnails */
        .play-overlay {
            position: absolute;
            inset: 0;
            background: rgba(5, 8, 18, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            backdrop-filter: blur(3px);
        }
        .media-card:hover .play-overlay { opacity: 1; }
        .play-btn-circle {
            width: 52px; height: 52px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.7);
            transition: transform 0.25s ease;
        }
        .play-btn-circle:hover { transform: scale(1.12); }

        /* Quick play audio button shown on music card hover */
        .card-play-btn {
            position: absolute;
            inset: 0;
            background: rgba(5, 8, 18, 0.45);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            backdrop-filter: blur(2px);
            z-index: 2;
        }
        .media-card:hover .card-play-btn { opacity: 1; }

        /* Card body text section */
        .card-body {
            padding: 14px 16px 16px;
        }
        .card-title {
            font-size: 0.95rem;
            font-weight: 800;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 3px;
        }
        .card-artist {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--primary-lt);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 6px;
        }

        /* NEW badge on card */
        .badge-new {
            display: inline-block;
            padding: 3px 9px;
            background: linear-gradient(135deg, var(--accent), #f59e0b);
            color: #fff;
            font-size: 0.68rem;
            font-weight: 800;
            border-radius: 6px;
            letter-spacing: 0.5px;
        }
        .card-badge-pos {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 3;
        }

        /* Gold stars display */
        .stars { color: var(--gold); font-size: 0.8rem; }

        /* Form Grid */
        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }
        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            color: #cbd5e1;
            margin-bottom: 7px;
        }
        .invalid-feedback {
            color: #fca5a5;
            font-size: 0.8rem;
            margin-top: 4px;
        }

        /* ============================
           RESPONSIVE — ALL SCREEN SIZES
           ============================ */

        /* Tablet (max 1024px) */
        @media (max-width: 1024px) {
            .navbar { padding: 0 20px; gap: 12px; }
            .navbar-center { gap: 14px; }
            .nav-search-wrap { width: 180px; }
            .nav-search-wrap:focus-within { width: 220px; }
            .footer-inner { grid-template-columns: 1fr 1fr; gap: 28px; }
            .container { padding: 0 18px; }
        }

        /* Mobile (max 768px) */
        @media (max-width: 768px) {
            /* Navbar — hide center nav & search on small screens */
            .navbar { padding: 0 16px; height: 60px; }
            .navbar-brand { font-size: 1.2rem; gap: 8px; }
            .navbar-brand .logo-icon { width: 36px; height: 36px; font-size: 17px; }
            .navbar-center { display: none; }
            .nav-search-wrap { display: none; }
            .navbar-actions { gap: 8px; }
            .btn-sm { padding: 6px 12px; font-size: 0.78rem; }

            /* Footer responsive */
            .footer { padding: 40px 0 20px; margin-top: 50px; }
            .footer-inner { grid-template-columns: 1fr 1fr; gap: 24px; padding: 0 16px; }

            /* Form grid stacks */
            .form-grid-2 { grid-template-columns: 1fr; }

            /* Media grid smaller */
            .media-grid { grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 16px; }

            /* Cards */
            .card { padding: 16px; }
        }

        /* Small Mobile (max 480px) */
        @media (max-width: 480px) {
            .navbar { padding: 0 12px; height: 56px; }
            .navbar-brand { font-size: 1.05rem; }

            .footer-inner { grid-template-columns: 1fr; gap: 20px; }
            .footer-bottom { font-size: 0.78rem; }

            .media-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }

            .btn { padding: 8px 16px; font-size: 0.85rem; }

            .category-pill { padding: 6px 12px; font-size: 0.82rem; }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- NAVBAR -->
@if(!request()->routeIs('login') && !request()->routeIs('register') && !request()->routeIs('admin.login'))
<nav class="navbar">
    <a href="{{ route('home') }}" class="navbar-brand">
        <div class="logo-icon">🎵</div>
        SOUND
    </a>

    <div class="navbar-center">
        <ul class="navbar-nav">
            <li><a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('music.index') }}" class="{{ request()->is('music*') ? 'active' : '' }}">Music</a></li>
            <li><a href="{{ route('albums.index') }}" class="{{ request()->is('albums*') ? 'active' : '' }}">Albums</a></li>
            <li><a href="{{ route('video.index') }}" class="{{ request()->is('video*') ? 'active' : '' }}">Video</a></li>
        </ul>

        <!-- Live Nav Search Bar -->
        <form method="GET" action="{{ route('search') }}" class="nav-search-wrap">
            <span class="nav-search-icon">🔍</span>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search music, artist..." class="nav-search-input">
        </form>
    </div>

    <div class="navbar-actions">
        @guest
            <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
        @else
            <a href="{{ route('profile') }}" class="btn btn-primary" style="border-radius:50px;">👤 {{ Auth::user()->name }}</a>
        @endguest
    </div>
</nav>
@endif

<!-- FLASH MESSAGES -->
@if(session('success'))
    <div class="container" style="padding-top:20px" id="flashMessageContainer">
        <div class="alert alert-success" style="display:flex; justify-content:space-between; align-items:center;">
            <span>✓ {{ session('success') }}</span>
            <button onclick="document.getElementById('flashMessageContainer').remove()" style="background:none; border:none; color:inherit; font-size:18px; cursor:pointer;">✕</button>
        </div>
    </div>
@endif
@if(session('error'))
    <div class="container" style="padding-top:20px" id="flashMessageContainer">
        <div class="alert alert-danger" style="display:flex; justify-content:space-between; align-items:center;">
            <span>✗ {{ session('error') }}</span>
            <button onclick="document.getElementById('flashMessageContainer').remove()" style="background:none; border:none; color:inherit; font-size:18px; cursor:pointer;">✕</button>
        </div>
    </div>
@endif

<!-- PAGE CONTENT -->
<main class="animate-fade-in">
    @yield('content')
</main>

<!-- GLOBAL AUDIO PLAYER MODAL -->
<div id="audioModal" style="display:none; position:fixed; bottom:24px; right:24px; z-index:9999;
     background:rgba(10,13,26,0.97); border:1px solid rgba(99,102,241,0.5);
     box-shadow:0 24px 60px rgba(0,0,0,0.85), 0 0 40px rgba(99,102,241,0.15);
     border-radius:22px; padding:0; width:360px;
     backdrop-filter:blur(24px);
     animation: slideUpModal 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;">

    <!-- Top gradient accent line -->
    <div style="height:3px; background:linear-gradient(90deg,#6366f1,#ec4899,#f59e0b); border-radius:22px 22px 0 0;"></div>

    <div style="padding:18px 20px 20px;">
        <!-- Header row -->
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:14px;">
            <div style="display:flex; align-items:center; gap:12px; min-width:0; flex:1;">
                <!-- Equalizer animation (shows while playing) -->
                <div id="audioEqAnim" style="display:flex; align-items:flex-end; gap:2.5px; height:24px; flex-shrink:0;">
                    <div style="width:3px; border-radius:2px; background:linear-gradient(to top,#6366f1,#ec4899); animation:eq-bounce 1.1s 0.0s infinite alternate ease-in-out;"></div>
                    <div style="width:3px; border-radius:2px; background:linear-gradient(to top,#6366f1,#ec4899); animation:eq-bounce 1.1s 0.2s infinite alternate ease-in-out;"></div>
                    <div style="width:3px; border-radius:2px; background:linear-gradient(to top,#6366f1,#ec4899); animation:eq-bounce 1.1s 0.1s infinite alternate ease-in-out;"></div>
                    <div style="width:3px; border-radius:2px; background:linear-gradient(to top,#6366f1,#ec4899); animation:eq-bounce 1.1s 0.3s infinite alternate ease-in-out;"></div>
                    <div style="width:3px; border-radius:2px; background:linear-gradient(to top,#6366f1,#ec4899); animation:eq-bounce 1.1s 0.15s infinite alternate ease-in-out;"></div>
                </div>
                <div style="min-width:0;">
                    <div style="font-size:0.65rem; font-weight:800; letter-spacing:1.5px; color:#6366f1; text-transform:uppercase; margin-bottom:2px;">Now Playing</div>
                    <div id="audioModalTitle" style="font-weight:800; color:#fff; font-size:0.95rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:220px;">Track Title</div>
                    <div id="audioModalArtist" style="color:#a5b4fc; font-size:0.78rem; font-weight:600; margin-top:1px;">Artist Name</div>
                </div>
            </div>
            <button onclick="closeAudioModal()" style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.12); color:#94a3b8; width:30px; height:30px; border-radius:50%; font-size:16px; cursor:pointer; display:flex; align-items:center; justify-content:center; flex-shrink:0; transition:all 0.2s ease;"
                    onmouseover="this.style.background='rgba(239,68,68,0.2)'; this.style.color='#fca5a5'"
                    onmouseout="this.style.background='rgba(255,255,255,0.08)'; this.style.color='#94a3b8'">✕</button>
        </div>

        <!-- Audio control -->
        <audio id="globalAudioPlayer" controls style="width:100%; height:36px; border-radius:8px;" autoplay>
            <source id="globalAudioSource" src="" type="audio/mpeg">
        </audio>
    </div>
</div>

<style>
@keyframes slideUpModal {
    from { opacity:0; transform: translateY(20px); }
    to   { opacity:1; transform: translateY(0); }
}
@keyframes eq-bounce {
    0%   { height: 4px; }
    100% { height: 22px; }
}
</style>

<!-- FOOTER -->
@if(!request()->routeIs('login') && !request()->routeIs('register') && !request()->routeIs('admin.login'))
<footer class="footer">
    <div class="footer-inner">
        <div class="footer-brand">
            <div class="navbar-brand">
                <div class="logo-icon">🎵</div>
                SOUND Entertainment
            </div>
            <p>Your premier destination for Regional (Tamil, Telugu, Hindi, Malayalam, Punjabi, Bengali) and English Music & Videos. Experience high fidelity audio and cinema without boundaries.</p>
        </div>
        <div>
            <h4>Browse</h4>
            <ul>
                <li><a href="{{ route('music.index') }}">All Music</a></li>
                <li><a href="{{ route('albums.index') }}">Music Albums</a></li>
                <li><a href="{{ route('video.index') }}">All Videos</a></li>
                <li><a href="{{ route('search') }}">Advanced Search</a></li>
            </ul>
        </div>
        <div>
            <h4>Genres</h4>
            <ul>
                <li><a href="{{ route('music.index') }}?genre=Pop">Pop</a></li>
                <li><a href="{{ route('music.index') }}?genre=Classical+Fusion">Classical Fusion</a></li>
                <li><a href="{{ route('music.index') }}?genre=Rock">Rock</a></li>
                <li><a href="{{ route('music.index') }}?genre=Folk">Folk</a></li>
            </ul>
        </div>
        <div>
            <h4>Account</h4>
            <ul>
                @guest
                    <li><a href="{{ route('register') }}">Create Account</a></li>
                    <li><a href="{{ route('login') }}">Member Login</a></li>
                @else
                    <li><a href="{{ route('profile') }}">My Profile</a></li>
                @endguest
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; {{ date('Y') }} SOUND Entertainment Group. All rights reserved.
    </div>
</footer>
@endif

<script>
    function openAudioModal(title, artist, url) {
        document.getElementById('audioModalTitle').innerText = title;
        document.getElementById('audioModalArtist').innerText = artist;
        const player = document.getElementById('globalAudioPlayer');
        const source = document.getElementById('globalAudioSource');
        source.src = url;
        player.load();
        player.play();
        document.getElementById('audioModal').style.display = 'block';
    }

    function closeAudioModal() {
        const player = document.getElementById('globalAudioPlayer');
        player.pause();
        document.getElementById('audioModal').style.display = 'none';
    }

    // Auto-dismiss flash notifications after 4 seconds
    setTimeout(function() {
        const flash = document.getElementById('flashMessageContainer');
        if (flash) {
            flash.style.transition = 'opacity 0.5s ease';
            flash.style.opacity = '0';
            setTimeout(function() { flash.remove(); }, 500);
        }
    }, 4000);
</script>

@stack('scripts')
</body>
</html>
