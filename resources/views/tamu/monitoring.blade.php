<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoring Tamu | E-Guestbook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { background-color: #fff5f5; font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar { width: 260px; height: 100vh; position: fixed; background-color: #f89494; color: white; z-index: 1000; }
        .header { margin-left: 260px; height: 70px; background-color: #ffffff; display: flex; align-items: center; justify-content: space-between; padding: 0 30px; border-bottom: 2px solid #fce8e8; }
        .main-content { margin-left: 260px; padding: 30px; }
        .sidebar-brand { padding: 25px; text-align: center; font-weight: 800; display: block; color: white; text-decoration: none; border-bottom: 1px solid rgba(255,255,255,0.2); }
        .nav-link { color: rgba(255,255,255,0.9); padding: 15px 25px; font-weight: 600; border-radius: 10px; margin: 5px 15px; text-decoration: none; display: block; }
        .nav-link.active { background: rgba(255,255,255,0.2); color: white; }
        .text-pink-main { color: #f08080; }
        .btn-pink { background-color: #f89494; color: white; }
        .btn-pink:hover { background-color: #f08080; color: white; }
        
        /* Monitoring Specific Styles */
        .stat-card { border-radius: 20px; border: none; transition: transform 0.3s; }
        .stat-card:hover { transform: translateY(-5px); }
        .tamu-card { border-radius: 20px; border: none; border-left: 6px solid #f89494; transition: all 0.3s; }
        .tamu-card.checkout { border-left: 6px solid #dee2e6; opacity: 0.8; }
        .status-dot { height: 10px; width: 10px; border-radius: 50%; display: inline-block; margin-right: 5px; }
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
        <a class="nav-link {{ request()->routeIs('ruangan.index') ? 'active' : '' }}" href="{{ route('ruangan.index') }}">
            <i class="fa-solid fa-door-open me-2"></i> Data Ruangan
        </a>
    </nav>
</div>

<div class="header shadow-sm">
    <h5 class="mb-0 fw-bold text-pink-main">Live Monitoring Tamu</h5>
    <div class="d-flex align-items-center">
        <span class="badge bg-light text-pink-main border me-3"><i class="fa-solid fa-calendar-day me-1"></i> {{ date('d M Y') }}</span>
        <form action="{{ route('logout') }}" method="POST">@csrf <button class="btn btn-sm px-4 fw-bold rounded-pill shadow-sm btn-pink">Logout</button></form>
    </div>
</div>

<div class="main-content">
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card stat-card shadow-sm p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle p-3 bg-light text-pink-main me-3"><i class="fa-solid fa-users fa-xl"></i></div>
                    <div>
                        <h6 class="text-muted mb-0 small fw-bold">TOTAL HADIR</h6>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalHadir }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card shadow-sm p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle p-3 bg-success-subtle text-success me-3"><i class="fa-solid fa-user-clock fa-xl"></i></div>
                    <div>
                        <h6 class="text-muted mb-0 small fw-bold">DI DALAM KANTOR</h6>
                        <h3 class="fw-bold mb-0 text-success">{{ $diDalam }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card shadow-sm p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle p-3 bg-secondary-subtle text-secondary me-3"><i class="fa-solid fa-user-check fa-xl"></i></div>
                    <div>
                        <h6 class="text-muted mb-0 small fw-bold">SUDAH PULANG</h6>
                        <h3 class="fw-bold mb-0 text-secondary">{{ $sudahPulang }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h5 class="fw-bold text-pink-main mb-4"><i class="fa-solid fa-clock-rotate-left me-2"></i>Status Kunjungan Real-time</h5>

    <div class="row g-4">
        @forelse($tamus as $t)
        <div class="col-md-6 col-xl-4">
            <div class="card tamu-card shadow-sm h-100 {{ $t->jam_keluar ? 'checkout' : '' }}">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="fw-bold mb-1">{{ $t->nama }}</h5>
                            <span class="text-muted small"><i class="fa-solid fa-building me-1"></i> {{ $t->ruangan->nama_ruangan ?? 'Umum' }}</span>
                        </div>
                        @if(!$t->jam_keluar)
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">
                                <span class="status-dot bg-success"></span> Aktif
                            </span>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill">
                                Selesai
                            </span>
                        @endif
                    </div>
                    
                    <div class="bg-light p-3 rounded-4 mb-3">
                        <div class="small text-muted mb-1">Keperluan:</div>
                        <div class="small fw-semibold text-dark">{{ $t->pesan }}</div>
                    </div>

                    <div class="row text-center g-0 border-top pt-3">
                        <div class="col-6 border-end">
                            <div class="small text-muted">Jam Masuk</div>
                            <div class="fw-bold text-pink-main">{{ $t->created_at->format('H:i') }}</div>
                        </div>
                        <div class="col-6">
                            <div class="small text-muted">Jam Keluar</div>
                            <div class="fw-bold text-secondary">{{ $t->jam_keluar ? \Carbon\Carbon::parse($t->jam_keluar)->format('H:i') : '--:--' }}</div>
                        </div>
                    </div>

                    @if(!$t->jam_keluar)
                    <form action="{{ route('tamu.checkout', $t->id) }}" method="POST" class="mt-4">
                        @csrf @method('PATCH')
                        <button class="btn btn-pink w-100 fw-bold rounded-pill shadow-sm py-2">
                            <i class="fa-solid fa-right-from-bracket me-2"></i> CHECK-OUT TAMU
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <img src="https://illustrations.popsy.co/pink/waiting-list.svg" alt="No data" style="width: 200px;" class="mb-3">
            <p class="text-muted">Belum ada tamu yang berkunjung hari ini.</p>
        </div>
        @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>