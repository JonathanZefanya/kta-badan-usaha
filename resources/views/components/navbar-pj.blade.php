@if(auth()->user() && auth()->user()->role === 'PJ')
<nav class="navbar navbar-expand-lg navbar-dark mb-4 shadow-lg" style="background: linear-gradient(90deg,#43cea2,#185a9d); animation:fadeInDown 0.7s; border-radius:16px;">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2 me-2"></i>
            <span style="font-size:1.3rem;">Dashboard</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPJ" aria-controls="navbarPJ" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarPJ">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('badan-usaha.index') }}">
                        <i class="bi bi-building me-2"></i> <span>Data Badan Usaha</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('user.settings') }}">
                        <i class="bi bi-person me-2"></i> <span>Settings Akun</span>
                    </a>
                </li>
            </ul>
            <form action="{{ route('logout') }}" method="POST" class="d-flex ms-lg-3">
                @csrf
                <button type="submit" class="btn btn-outline-light rounded-pill px-3 py-1" style="transition:background 0.3s;">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>
</nav>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
.navbar {
    border-radius:16px;
    box-shadow:0 4px 24px rgba(67,206,162,0.15);
}
@keyframes fadeInDown { from { opacity:0; transform:translateY(-30px);} to { opacity:1; transform:translateY(0);} }
.nav-link {
    font-weight:500;
    font-size:1.08rem;
    transition: color 0.2s, background 0.2s;
    border-radius:8px;
}
.nav-link:hover {
    background:rgba(255,255,255,0.12);
    color:#fff;
}
.btn-outline-light:hover {
    background:#43cea2;
    color:#fff;
    border-color:#43cea2;
}
</style>
@endif