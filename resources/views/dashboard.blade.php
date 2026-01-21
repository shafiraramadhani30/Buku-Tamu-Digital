<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | E-Guestbook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { background-color: #fff5f5; font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar { width: 260px; height: 100vh; position: fixed; background-color: #f89494; color: white; z-index: 1000; }
        .header { margin-left: 260px; height: 70px; background-color: #ffffff; display: flex; align-items: center; justify-content: space-between; padding: 0 30px; border-bottom: 2px solid #fce8e8; }
        .main-content { margin-left: 260px; padding: 30px; }
        .sidebar-brand { padding: 25px; text-align: center; font-weight: 800; display: block; color: white; text-decoration: none; border-bottom: 1px solid rgba(255,255,255,0.2); }
        .nav-link { color: rgba(255,255,255,0.9); padding: 15px 25px; font-weight: 600; border-radius: 10px; margin: 5px 15px; text-decoration: none; display: block; transition: 0.3s; }
        .nav-link:hover { background: rgba(255,255,255,0.1); color: white; }
        .nav-link.active { background: rgba(255,255,255,0.2); color: white; }
        .stat-card { border: none; border-radius: 20px; transition: transform 0.3s; }
        .stat-card:hover { transform: translateY(-5px); }
        .bg-pink-light { background-color: #fce8e8; }
        .text-pink-main { color: #f08080; }
        
        /* Gaya khusus untuk menu rating agar mencolok */
        .nav-link.rating-link { color: #fff3cd; font-style: italic; border: 1px dashed rgba(255,255,255,0.4); }
        .nav-link.rating-link:hover { background: #f08080; color: #ffffff; }
    </style>
</head>
<body>

<div class="sidebar">
    <a href="#" class="sidebar-brand"><i class="fa-solid fa-address-book"></i> E-GUESTBOOK</a>
    <nav class="nav flex-column mt-4">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="fa-solid fa-house me-2"></i> Dashboard
        </a>
        <a class="nav-link {{ request()->routeIs('tamu.index') ? 'active' : '' }}" href="{{ route('tamu.index') }}">
            <i class="fa-solid fa-users me-2"></i> Data Tamu
        </a>
        <a class="nav-link {{ request()->routeIs('tamu.monitoring') ? 'active' : '' }}" href="{{ route('tamu.monitoring') }}">
            <i class="fa-solid fa-desktop me-2"></i> Monitoring Tamu
        </a>
        <a class="nav-link {{ request()->is('ruangan*') ? 'active' : '' }}" href="{{ route('ruangan.index') }}">
            <i class="fa-solid fa-door-open me-2"></i> Data Ruangan
        </a>
        
        <hr class="mx-4 opacity-25">
    </nav>
</div>

<div class="header shadow-sm">
    <h5 class="mb-0 fw-bold text-pink-main">Selamat Datang Admin</h5>
    <form action="{{ route('logout') }}" method="POST">
        @csrf 
        <button class="btn btn-sm px-4 fw-bold rounded-pill shadow-sm" style="background-color: #f89494; color: white;">Logout</button>
    </form>
</div>

<div class="main-content">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card stat-card shadow-sm p-4 text-center">
                <div class="bg-pink-light p-3 rounded-circle d-inline-block mb-3"><i class="fa-solid fa-users fs-4 text-pink-main"></i></div>
                <h6 class="text-muted fw-bold small">TOTAL TAMU</h6>
                <h2 class="fw-bold mb-0 text-pink-main">{{ $tamus->count() }}</h2>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card stat-card shadow-sm p-4 text-center">
                <div class="bg-pink-light p-3 rounded-circle d-inline-block mb-3"><i class="fa-solid fa-user-clock fs-4 text-pink-main"></i></div>
                <h6 class="text-muted fw-bold small">TAMU HARI INI</h6>
                <h2 class="fw-bold mb-0 text-pink-main">{{ $tamus->where('created_at', '>=', now()->startOfDay())->count() }}</h2>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card stat-card shadow-sm p-4 text-center border-bottom border-4 border-danger">
                <div class="bg-pink-light p-3 rounded-circle d-inline-block mb-3"><i class="fa-solid fa-calendar-check fs-4 text-pink-main"></i></div>
                <h6 class="text-muted fw-bold small">BULAN INI</h6>
                <h2 class="fw-bold mb-0 text-pink-main">{{ $tamus->where('created_at', '>=', now()->startOfMonth())->count() }}</h2>
            </div>
        </div>
    </div>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>