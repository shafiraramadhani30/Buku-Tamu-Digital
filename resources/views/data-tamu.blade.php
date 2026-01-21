<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Guestbook | Data Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* CSS Sama seperti di atas agar konsisten */
        body { background-color: #fff5f5; font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar { width: 260px; height: 100vh; position: fixed; background-color: #f89494; color: white; z-index: 1000; }
        .header { margin-left: 260px; height: 70px; background-color: #ffffff; display: flex; align-items: center; justify-content: space-between; padding: 0 30px; border-bottom: 2px solid #fce8e8; }
        .main-content { margin-left: 260px; padding: 30px; }
        .nav-link { color: rgba(255,255,255,0.9); padding: 15px 25px; margin: 5px 15px; border-radius: 10px; text-decoration: none; display: block; font-weight: 600; }
        .nav-link.active { background: rgba(255,255,255,0.2); color: white; }
        .sidebar-brand { padding: 25px; text-align: center; font-weight: 800; display: block; color: white; text-decoration: none; border-bottom: 1px solid rgba(255,255,255,0.2); }
        .text-pink-main { color: #f08080; }
        .bg-pink-light { background-color: #fce8e8; }
    </style>
</head>
<body>

<div class="sidebar">
    <a href="#" class="sidebar-brand"><i class="fa-solid fa-address-book"></i> E-GUESTBOOK</a>
    <div class="mt-4">
        <nav class="nav flex-column">
            <a class="nav-link" href="{{ route('dashboard') }}"><i class="fa-solid fa-house me-2"></i> Dashboard</a>
            <a class="nav-link active" href="{{ route('tamu.index') }}"><i class="fa-solid fa-users me-2"></i> Data Tamu</a>
        </nav>
    </div>
</div>

<div class="header shadow-sm">
    <h5 class="mb-0 fw-bold text-pink-main">Kelola Data Tamu</h5>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-sm px-4 fw-bold rounded-pill shadow-sm" style="background-color: #f89494; color: white;">Logout</button>
    </form>
</div>

<div class="main-content">
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card shadow-sm p-4 border-0" style="border-radius: 20px;">
                <h5 class="fw-bold mb-4 text-pink-main"><i class="fa-solid fa-circle-plus me-2"></i>Tambah Tamu</h5>
                <form action="{{ route('tamu.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control border-0 bg-light py-2" placeholder="Masukkan Nama..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Email</label>
                        <input type="email" name="email" class="form-control border-0 bg-light py-2" placeholder="Email@contoh.com" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold">Keperluan</label>
                        <textarea name="pesan" class="form-control border-0 bg-light" rows="3" placeholder="Tujuan kunjungan..." required></textarea>
                    </div>
                    <button class="btn w-100 fw-bold py-2 shadow" style="background-color: #f89494; color: white; border-radius: 12px;">SIMPAN DATA</button>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm border-0" style="border-radius: 20px; overflow: hidden;">
                <div class="p-4 bg-white border-bottom">
                    <h6 class="fw-bold mb-0">DAFTAR KUNJUNGAN TERBARU</h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr class="small text-uppercase">
                                <th class="ps-4 py-3">Nama</th>
                                <th>Keperluan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tamus as $t)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold">{{ $t->nama }}</div>
                                    <div class="text-muted small" style="font-size: 0.75rem;">{{ $t->email }}</div>
                                </td>
                                <td><span class="text-muted small">{{ $t->pesan }}</span></td>
                                <td class="text-center">
                                    <div class="btn-group gap-2">
                                        <button class="btn btn-sm btn-outline-warning border-0 rounded-circle" data-bs-toggle="modal" data-bs-target="#editModal{{ $t->id }}"><i class="fa-solid fa-edit"></i></button>
                                        <form action="{{ route('tamu.destroy', $t->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger border-0 rounded-circle" onclick="return confirm('Hapus data?')"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="editModal{{ $t->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content" style="border-radius: 20px; border: none;">
                                        <div class="modal-header border-0" style="background-color: #fce8e8;">
                                            <h5 class="modal-title fw-bold text-pink-main">Edit Data Tamu</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('tamu.update', $t->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <div class="modal-body p-4">
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold">Nama Lengkap</label>
                                                    <input type="text" name="nama" class="form-control border-0 bg-light py-2" value="{{ $t->nama }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold">Email</label>
                                                    <input type="email" name="email" class="form-control border-0 bg-light py-2" value="{{ $t->email }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small fw-bold">Keperluan</label>
                                                    <textarea name="pesan" class="form-control border-0 bg-light" rows="3" required>{{ $t->pesan }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0 p-4 pt-0">
                                                <button type="submit" class="btn fw-bold rounded-pill px-4" style="background-color: #f89494; color: white;">SIMPAN PERUBAHAN</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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