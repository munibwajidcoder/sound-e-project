<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - SOUND Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg-dark: #070a14; --bg-card: rgba(18, 24, 43, 0.85); --bg-card2: rgba(25, 33, 56, 0.9);
            --primary: #6366f1; --primary-lt: #818cf8; --accent: #ec4899;
            --gold: #f59e0b; --danger: #ef4444; --text: #f1f5f9;
            --text-muted: #94a3b8; --border: rgba(255,255,255,0.08);
            --sidebar: 250px; --radius: 14px;
        }
        body { font-family:'Plus Jakarta Sans',sans-serif; background:var(--bg-dark); color:var(--text); display:flex; min-height:100vh; }
        a { text-decoration:none; color:inherit; }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar);
            background: rgba(10, 13, 24, 0.95);
            border-right: 1px solid var(--border);
            position: fixed; top:0; left:0; height:100vh;
            display: flex; flex-direction: column;
            overflow: hidden;
            backdrop-filter: blur(20px);
            z-index: 100;
        }
        .sidebar-brand {
            padding: 18px 20px;
            font-family: 'Outfit', sans-serif;
            font-weight: 900;
            font-size: 1.25rem;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; gap: 10px;
            color: #fff;
            flex-shrink: 0;
        }
        .sidebar-brand .icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
        }
        .sidebar-label {
            padding: 14px 20px 6px;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 1.5px;
            color: var(--text-muted);
            text-transform: uppercase;
            flex-shrink: 0;
        }
        .sidebar-nav { list-style: none; padding: 0 12px; flex-shrink: 0; }
        .sidebar-nav li { margin-bottom: 2px; }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            border-radius: 10px;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text-muted);
            transition: all 0.2s ease;
        }
        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: rgba(99,102,241,0.18);
            color: #fff;
            border: 1px solid rgba(99,102,241,0.35);
        }
        .sidebar-nav a .ico { font-size: 1.15rem; width: 22px; text-align: center; }
        .sidebar-footer {
            margin-top: auto;
            padding: 14px 18px;
            border-top: 1px solid var(--border);
            font-size: 0.82rem;
            color: var(--text-muted);
            background: rgba(18, 24, 43, 0.4);
            flex-shrink: 0;
        }

        /* Main content */
        .main-content {
            margin-left: var(--sidebar);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            overflow-x: hidden;
        }
        .top-bar {
            background: rgba(10, 13, 24, 0.9);
            border-bottom: 1px solid var(--border);
            padding: 0 24px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky; top: 0; z-index: 90;
            backdrop-filter: blur(16px);
        }
        .top-bar h1 { font-family: 'Outfit', sans-serif; font-size: 1.25rem; font-weight: 800; color: #fff; }
        .top-bar-right { display:flex; align-items:center; gap:12px; }
        .page-body { padding: 24px; flex: 1; }

        /* Buttons */
        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            padding: 10px 20px; border-radius: 10px; font-size: 0.88rem;
            font-weight: 700; border: none; cursor: pointer;
            transition: all 0.25s ease; text-decoration: none;
            white-space: nowrap;
        }
        .btn-primary { background:linear-gradient(135deg, #6366f1, #8b5cf6); color:#fff; box-shadow: 0 4px 15px rgba(99,102,241,0.3); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(99,102,241,0.5); }
        .btn-secondary { background:rgba(255,255,255,0.08); color:#f1f5f9; border:1px solid rgba(255,255,255,0.12); }
        .btn-secondary:hover { background:rgba(255,255,255,0.15); }
        .btn-outline { background:transparent; color:var(--text); border:1px solid var(--border); }
        .btn-outline:hover { background:rgba(255,255,255,0.08); }
        .btn-danger { background:var(--danger); color:#fff; }
        .btn-danger:hover { background:#dc2626; }
        .btn-sm { padding:7px 14px; font-size:0.8rem; border-radius:8px; }

        /* Cards & Table Framing */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 28px;
            margin-bottom: 28px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.35);
            backdrop-filter: blur(16px);
        }
        .card-title { font-family: 'Outfit', sans-serif; font-size:1.15rem; font-weight:800; color:#fff; margin-bottom:20px; }

        /* Table Spacing & Alignment Fix */
        .table-wrap {
            overflow-x: auto;
            border-radius: 14px;
            border: 1px solid var(--border);
            background: rgba(18, 24, 43, 0.4);
        }
        /* Generic table inside table-wrap (used by video/music/etc) */
        .table-wrap table, .admin-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 700px;
        }
        .table-wrap table th, .admin-table th {
            text-align: left;
            padding: 14px 18px;
            font-size: 0.76rem;
            font-weight: 800;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid var(--border);
            background: rgba(255, 255, 255, 0.03);
            white-space: nowrap;
        }
        .table-wrap table td, .admin-table td {
            padding: 14px 18px;
            font-size: 0.88rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: var(--text);
            vertical-align: middle;
        }
        .table-wrap table tr:last-child td, .admin-table tr:last-child td {
            border-bottom: none;
        }
        .table-wrap table tr:hover td, .admin-table tr:hover td {
            background: rgba(99, 102, 241, 0.06);
        }
        .btn-group {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: nowrap;
        }
        .table-img-thumb {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.12);
        }
        .video-img-thumb {
            width: 80px;
            height: 45px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        /* Form Controls */
        .form-group { margin-bottom:20px; }
        .form-label { display:block; font-size:0.88rem; font-weight:700; color:#cbd5e1; margin-bottom:8px; }
        .form-control {
            width:100%; padding:12px 16px;
            background:rgba(15, 23, 42, 0.8); border:1px solid rgba(255, 255, 255, 0.12);
            border-radius:12px; color:var(--text); font-size:0.92rem;
            font-family:inherit; outline:none; transition:all 0.25s ease;
        }
        .form-control:focus { border-color:var(--primary-lt); box-shadow:0 0 15px rgba(99,102,241,0.3); }

        /* Alert */
        .alert { padding:14px 22px; border-radius:12px; margin-bottom:24px; font-size:0.92rem; font-weight:600; }
        .alert-success { background:rgba(16,185,129,0.15); border:1px solid var(--accent); color:#6ee7b7; }
        .alert-danger  { background:rgba(239,68,68,0.15); border:1px solid var(--danger); color:#fca5a5; }

        /* Badge */
        .badge { display:inline-block; padding:5px 12px; border-radius:8px; font-size:0.75rem; font-weight:800; text-transform:uppercase; }
        .badge-info { background:rgba(99,102,241,0.2); color:#a5b4fc; border:1px solid rgba(99,102,241,0.35); }

        /* Pagination Arrow Fix */
        .pagination, nav[role="navigation"] {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            gap: 10px !important;
            margin-top: 24px !important;
        }
        .pagination svg, nav[role="navigation"] svg {
            width: 16px !important;
            height: 16px !important;
            max-width: 16px !important;
            fill: currentColor !important;
        }
        nav[role="navigation"] > div:first-child { display: none !important; }
        nav[role="navigation"] span, nav[role="navigation"] a {
            padding: 8px 14px !important;
            border-radius: 8px !important;
            background: rgba(255,255,255,0.06) !important;
            color: #cbd5e1 !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
            font-size: 0.85rem !important;
            font-weight: 600 !important;
            text-decoration: none !important;
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="icon">🎵</div> SOUND Admin
    </div>

    <p class="sidebar-label">Overview</p>
    <ul class="sidebar-nav">
        <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <span class="ico">📊</span> Dashboard
        </a></li>
    </ul>

    <p class="sidebar-label">Content Management</p>
    <ul class="sidebar-nav">
        <li><a href="{{ route('admin.music.index') }}" class="{{ request()->is('admin/music*') ? 'active' : '' }}">
            <span class="ico">🎵</span> Music Catalog
        </a></li>
        <li><a href="{{ route('admin.video.index') }}" class="{{ request()->is('admin/video*') ? 'active' : '' }}">
            <span class="ico">🎬</span> 4K Videos
        </a></li>
        <li><a href="{{ route('admin.categories.index') }}" class="{{ request()->is('admin/categories*') ? 'active' : '' }}">
            <span class="ico">🏷</span> Categories
        </a></li>
    </ul>

    <p class="sidebar-label">User Management</p>
    <ul class="sidebar-nav">
        <li><a href="{{ route('admin.users.index') }}" class="{{ request()->is('admin/users*') ? 'active' : '' }}">
            <span class="ico">👥</span> Users & Logins
        </a></li>
    </ul>

    <p class="sidebar-label">Website</p>
    <ul class="sidebar-nav">
        <li><a href="{{ route('home') }}" target="_blank">
            <span class="ico">🌐</span> View Public Site ↗
        </a></li>
    </ul>

    <div class="sidebar-footer">
        <div style="font-weight:700; color:#fff; margin-bottom:2px">{{ Auth::user()->name ?? 'Administrator' }}</div>
        <div style="font-size:0.8rem; margin-bottom:12px; word-break:break-all;">{{ Auth::user()->email ?? 'admin@sound.com' }}</div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline btn-sm" style="width:100%; justify-content:center">Logout Account</button>
        </form>
    </div>
</aside>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="top-bar">
        <h1>@yield('page-title', 'Admin Dashboard')</h1>
        <div class="top-bar-right">
            @yield('top-action')
        </div>
    </div>

    <div class="page-body">
        @if(session('success'))
            <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">✗ {{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $e) • {{ $e }}<br> @endforeach
            </div>
        @endif

        @yield('content')
    </div>
</div>

@stack('scripts')
</body>
</html>
