@if(auth()->user() && auth()->user()->role === 'PJ')
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPJ" aria-controls="navbarPJ" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarPJ">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('badan-usaha.index') }}"><i class="bi bi-building"></i> Data Badan Usaha</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.settings') }}"><i class="bi bi-person"></i> Settings Akun</a>
                </li>
            </ul>
            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                @csrf
                <button type="submit" class="btn btn-outline-light"><i class="bi bi-box-arrow-right"></i>Logout</button>
            </form>
        </div>
    </div>
</nav>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endif