<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Buku Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #f08080 0%, #764ba2 100%); height: 100vh; display: flex; align-items: center; }
        .card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        .btn-primary { background: #f08080; border: none; padding: 12px; border-radius: 10px; }
        .btn-primary:hover { background: #f08080; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card p-4">
                <div class="card-body">
                    <h3 class="text-center fw-bold mb-4">LOGIN BUKU TAMU</h3>
                    
                    @if($errors->any())
                        <div class="alert alert-danger small">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="admin@mail.com" required autofocus>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold text-white">MASUK</button>
                    </form>
                </div>
            </div>
            <p class="text-center mt-4 text-white-50 small">&copy; 2026 Buku Tamu Digital</p>
        </div>
    </div>
</div>

</body>
</html>