<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Tamu | E-Guestbook</title>
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
    <h5 class="mb-0 fw-bold text-pink-main">Manajemen Data Tamu</h5>
    <form action="{{ route('logout') }}" method="POST">
        @csrf 
        <button class="btn btn-sm px-4 fw-bold rounded-pill shadow-sm btn-pink">Logout</button>
    </form>
</div>

<div class="main-content">
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card shadow-sm p-4 border-0" style="border-radius: 20px;">
                <h5 class="fw-bold mb-4 text-pink-main"><i class="fa-solid fa-circle-plus me-2"></i>Tambah Tamu</h5>
                <form action="{{ route('tamu.store') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label small fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control border-0 bg-light py-2" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold">Alamat</label>
                        <input type="text" name="alamat" class="form-control border-0 bg-light py-2" required>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select border-0 bg-light py-2" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">No. Telp</label>
                            <input type="text" name="no_telp" class="form-control border-0 bg-light py-2" required>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold">Email</label>
                        <input type="email" name="email" class="form-control border-0 bg-light py-2" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold">Pilih Ruangan</label>
                        <select name="ruangan_id" class="form-select border-0 bg-light py-2" required>
                            <option value="" disabled selected>-- Pilih Ruangan --</option>
                            @foreach($ruangans as $ruangan)
                                <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold">Keperluan</label>
                        <textarea name="pesan" class="form-control border-0 bg-light" rows="2" required></textarea>
                    </div>
                    <button class="btn w-100 fw-bold py-2 shadow btn-pink" style="border-radius: 12px;">SIMPAN DATA</button>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-pink-main mb-0">Daftar Tamu</h5>
                <a href="{{ route('tamu.cetak') }}" class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm">
                    <i class="fa-solid fa-file-pdf me-1"></i> Cetak PDF
                </a>
            </div>

            <div class="card shadow-sm border-0" style="border-radius: 20px; overflow: hidden;">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr class="small text-muted">
                                <th class="ps-4 py-3">Nama & Kontak</th>
                                <th>Detail Pribadi</th>
                                <th>Keperluan & Ruangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tamus as $t)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold">{{ $t->nama }}</div>
                                    <div class="text-muted small">{{ $t->email }}</div>
                                </td>
                                <td>
                                    <div class="small fw-bold text-dark">{{ $t->no_telp }}</div>
                                    <div class="text-muted" style="font-size: 0.75rem;">{{ $t->jenis_kelamin }} | {{ $t->alamat }}</div>
                                </td>
                                <td>
                                    <div class="small">{{ \Illuminate\Support\Str::limit($t->pesan, 40) }}</div>
                                    <small class="text-pink-main fw-bold">
                                        <i class="fa-solid fa-location-dot me-1"></i> {{ $t->ruangan->nama_ruangan ?? 'Tanpa Ruangan' }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    @if(!$t->jam_keluar)
                                        <form action="{{ route('tamu.checkout', $t->id) }}" method="POST" class="d-inline">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-sm btn-outline-success border-0" title="Check-out" onclick="return confirm('Tamu ini sudah selesai berkunjung?')">
                                                <i class="fa-solid fa-right-from-bracket"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="badge bg-light text-muted small">Selesai</span>
                                    @endif

                                    <button class="btn btn-sm btn-outline-warning border-0" data-bs-toggle="modal" data-bs-target="#editModal{{ $t->id }}">
                                        <i class="fa-solid fa-edit"></i>
                                    </button>

                                    <form action="{{ route('tamu.destroy', $t->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Hapus data?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="editModal{{ $t->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content" style="border-radius: 20px;">
                                        <div class="modal-header border-0 bg-light">
                                            <h5 class="modal-title fw-bold">Edit Data Tamu</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('tamu.update', $t->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-2">
                                                    <label class="form-label small fw-bold">Nama Lengkap</label>
                                                    <input type="text" name="nama" class="form-control" value="{{ $t->nama }}" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label small fw-bold">Alamat</label>
                                                    <input type="text" name="alamat" class="form-control" value="{{ $t->alamat }}" required>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <label class="form-label small fw-bold">Jenis Kelamin</label>
                                                        <select name="jenis_kelamin" class="form-select" required>
                                                            <option value="Laki-laki" {{ $t->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                            <option value="Perempuan" {{ $t->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label small fw-bold">No. Telp</label>
                                                        <input type="text" name="no_telp" class="form-control" value="{{ $t->no_telp }}" required>
                                                    </div>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label small fw-bold">Pilih Ruangan</label>
                                                    <select name="ruangan_id" class="form-select" required>
                                                        @foreach($ruangans as $ruangan)
                                                            <option value="{{ $ruangan->id }}" {{ $t->ruangan_id == $ruangan->id ? 'selected' : '' }}>{{ $ruangan->nama_ruangan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label small fw-bold">Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $t->email }}" required>
                                                </div>
                                                <div class="mb-0">
                                                    <label class="form-label small fw-bold">Keperluan</label>
                                                    <textarea name="pesan" class="form-control" rows="2" required>{{ $t->pesan }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-pink text-white rounded-pill px-4">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr><td colspan="4" class="text-center py-4 text-muted small">Belum ada data tamu.</td></tr>
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