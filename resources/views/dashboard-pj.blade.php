<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PJ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('components.navbar-pj')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Dashboard PJ</h3>
                    </div>
                    <div class="card-body">
                        <p class="lead">Selamat datang, <strong>{{ auth()->user()->name }}</strong> (PJ)</p>
                        <!-- Konten khusus PJ bisa ditambahkan di sini -->
                        <div class="alert alert-info mt-4">Silakan pilih menu di atas untuk mengelola data badan usaha, pembayaran, invoice, atau settings.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
