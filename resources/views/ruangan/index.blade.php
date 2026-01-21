<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Ruangan | E-Guestbook</title>
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
    </style>
</head>
<body>

<div class="sidebar">
    <a href="#" class="sidebar-brand"><i class="fa-solid fa-address-book"></i> E-GUESTBOOK</a>
    <nav class="nav flex-column mt-4">
        <a class="nav-link" href="{{ route('dashboard') }}"><i class="fa-solid fa-house me-2"></i> Dashboard</a>
        <a class="nav-link" href="{{ route('tamu.index') }}"><i class="fa-solid fa-users me-2"></i> Data Tamu</a>
        <a class="nav-link active" href="{{ route('ruangan.index') }}"><i class="fa-solid fa-door-open me-2"></i> Data Ruangan</a>
    </nav>
</div>

<div class="header shadow-sm">
    <h5 class="mb-0 fw-bold text-pink-main">Manajemen Data Ruangan</h5>
    <form action="{{ route('logout') }}" method="POST">@csrf <button class="btn btn-sm px-4 fw-bold rounded-pill shadow-sm" style="background-color: #f89494; color: white;">Logout</button></form>
</div>

<div class="main-content">
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card shadow-sm p-4 border-0" style="border-radius: 20px;">
                <h5 class="fw-bold mb-4 text-pink-main"><i class="fa-solid fa-circle-plus me-2"></i>Tambah Ruangan</h5>
                <form action="{{ route('ruangan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Ruangan</label>
                        <input type="text" name="nama_ruangan" class="form-control border-0 bg-light py-2">
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold">Lokasi / Lantai</label>
                        <input type="text" name="lokasi" class="form-control border-0 bg-light py-2">
                    </div>
                    <button class="btn w-100 fw-bold py-2 shadow" style="background-color: #f89494; color: white; border-radius: 12px;">SIMPAN RUANGAN</button>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm border-0" style="border-radius: 20px; overflow: hidden;">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light"><tr class="small">
                            <th class="ps-4 py-3">Nama Ruangan</th>
                            <th>Lokasi</th>
                            <th class="text-center">Aksi</th>
                        </tr></thead>
                        <tbody>
                            @forelse($ruangans as $r)
                            <tr>
                                <td class="ps-4 fw-bold">{{ $r->nama_ruangan }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $r->lokasi }}</span></td>
                                <td class="text-center">
                                    <form action="{{ route('ruangan.destroy', $r->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Hapus ruangan ini?')"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted small">Belum ada data ruangan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>