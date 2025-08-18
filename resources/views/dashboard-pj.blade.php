<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg,#43cea2,#185a9d);
            min-height: 100vh;
        }
        .card {
            border-radius: 18px;
            animation: fadeIn 0.7s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    @include('components.navbar-pj')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header text-white" style="background: linear-gradient(90deg,#4e54c8,#8f94fb); border-radius: 18px 18px 0 0;">
                        <h3 class="mb-0"><i class="bi bi-person-badge me-2"></i> Dashboard PJ</h3>
                    </div>
                    <div class="card-body bg-light">
                        <p class="lead mb-3">Selamat datang, <strong>{{ auth()->user()->name }}</strong> <span class="badge bg-primary">PJ</span></p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="card card-hover shadow-sm border-0 h-100" style="background: linear-gradient(135deg,#43cea2,#185a9d); color: #fff;">
                                    <div class="card-body text-center">
                                        <i class="bi bi-building display-5 mb-2"></i>
                                        <h5 class="card-title">Data Badan Usaha</h5>
                                        <a href="{{ route('badan-usaha.index') }}" class="btn btn-light btn-sm rounded-pill px-4">Kelola BU</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-hover shadow-sm border-0 h-100" style="background: linear-gradient(135deg,#ffb347,#ffcc33); color: #fff;">
                                    <div class="card-body text-center">
                                        <i class="bi bi-person-circle display-5 mb-2"></i>
                                        <h5 class="card-title">Settings Akun</h5>
                                        <a href="{{ route('user.settings') }}" class="btn btn-light btn-sm rounded-pill px-4">Settings Akun</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info mt-4 shadow-sm">Silakan pilih menu di atas untuk mengelola data badan usaha, pembayaran, invoice, atau settings.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
