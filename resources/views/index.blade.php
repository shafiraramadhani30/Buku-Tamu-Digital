<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Guestbook | Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body { background-color: #fff5f5; font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }
        .sidebar { width: 260px; height: 100vh; position: fixed; top: 0; left: 0; background-color: #f89494; color: white; z-index: 1000; box-shadow: 4px 0 15px rgba(248, 148, 148, 0.2); }
        .header { margin-left: 260px; height: 70px; background-color: #ffffff; display: flex; align-items: center; justify-content: space-between; padding: 0 30px; border-bottom: 2px solid #fce8e8; }
        .main-content { margin-left: 260px; padding: 30px; }
        .sidebar-brand { padding: 25px; text-align: center; font-weight: 800; font-size: 1.3rem; display: block; color: white; text-decoration: none; letter-spacing: 2px; border-bottom: 1px solid rgba(255,255,255,0.2); }
        .nav-link { color: rgba(255,255,255,0.9); padding: 15px 25px; font-weight: 600; transition: 0.3s; border-radius: 10px; margin: 5px 15px; }
        .nav-link:hover, .nav-link.active { background: rgba(255,255,255,0.2); color: white; }
        .stat-card { background: white; border: none; border-radius: 20px; transition: transform 0.3s; }
        .stat-card:hover { transform: translateY(-5px); }
        .bg-pink-light { background-color: #fce8e8; }
        .text-pink-main { color: #f08080; }
        @media (max-width: 768px) { .sidebar { width: 0; visibility: hidden; } .header, .main-content { margin-left: 0; } }
    </style>
</head>
<body>

<div class="sidebar">
    <a href="#" class="sidebar-brand"><i class="fa-solid fa-address-book"></i> E-GUESTBOOK</a>
    <div class="mt-4">
        <nav class="nav flex-column">
            <a class="nav-link active" href="{{ route('dashboard') }}"><i class="fa-solid fa-house me-2"></i> Dashboard</a>
            <a class="nav-link" href="{{ route('tamu.index') }}"><i class="fa-solid fa-users me-2"></i> Data Tamu</a>
            <a class="nav-link" href="#"><i class="fa-solid fa-gear me-2"></i> Settings</a>
        </nav>
    </div>
</div>

<div class="header shadow-sm">
    <h5 class="mb-0 fw-bold text-pink-main">Ringkasan Statistik</h5>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-sm px-4 fw-bold rounded-pill shadow-sm" style="background-color: #f89494; color: white;">
            <i class="fa-solid fa-power-off me-2"></i>Logout
        </button>
    </form>
</div>

<div class="main-content">
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card stat-card shadow-sm p-4 text-center">
                <div class="bg-pink-light p-3 rounded-circle d-inline-block mb-3">
                    <i class="fa-solid fa-users fs-4 text-pink-main"></i>
                </div>
                <h6 class="text-muted fw-bold small">TOTAL TAMU</h6>
                <h2 class="fw-bold mb-0 text-pink-main">{{ $tamus->count() }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card shadow-sm p-4 text-center">
                <div class="bg-pink-light p-3 rounded-circle d-inline-block mb-3">
                    <i class="fa-solid fa-user-clock fs-4 text-pink-main"></i>
                </div>
                <h6 class="text-muted fw-bold small">TAMU HARI INI</h6>
                <h2 class="fw-bold mb-0 text-pink-main">{{ $tamus->where('created_at', '>=', now()->startOfDay())->count() }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card shadow-sm p-4 text-center border-bottom border-4 border-danger">
                <div class="bg-pink-light p-3 rounded-circle d-inline-block mb-3">
                    <i class="fa-solid fa-calendar-check fs-4 text-pink-main"></i>
                </div>
                <h6 class="text-muted fw-bold small">BULAN INI</h6>
                <h2 class="fw-bold mb-0 text-pink-main">{{ $tamus->where('created_at', '>=', now()->startOfMonth())->count() }}</h2>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>