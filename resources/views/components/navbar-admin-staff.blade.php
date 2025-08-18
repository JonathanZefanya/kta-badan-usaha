@if(auth()->user() && in_array(auth()->user()->role, ['admin','staff']))
<nav class="navbar navbar-expand-lg mb-4 shadow-lg" style="background: linear-gradient(90deg,#4e54c8,#8f94fb); animation:fadeInDown 0.7s; border-radius:16px;">
  <div class="container">
    <a class="navbar-brand fw-bold text-white d-flex align-items-center" href="{{ route('dashboard.admin') }}">
      <i class="bi bi-speedometer2 me-2"></i> <span style="font-size:1.3rem;">Dashboard</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdminStaff" aria-controls="navbarAdminStaff" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarAdminStaff">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-white d-flex align-items-center" href="{{ route('admin.badanusaha.index') }}"><i class="bi bi-building me-2"></i> Data Badan Usaha</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white d-flex align-items-center" href="{{ route('admin.transaksi.index') }}">
                <i class="bi bi-clock-history me-2"></i> History Transaksi
            </a>
        </li>
  @if(auth()->user()->role === 'admin')
        <li class="nav-item">
          <a class="nav-link text-white d-flex align-items-center" href="{{ route('admin.users.index') }}"><i class="bi bi-people me-2"></i> Users</a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link text-white d-flex align-items-center" href="{{ route('admin.settings') }}"><i class="bi bi-person-circle me-2"></i> Settings Akun</a>
        </li>
  @if(auth()->user()->role === 'admin')
        <li class="nav-item">
          <a class="nav-link text-white d-flex align-items-center" href="{{ route('admin.settings.website') }}"><i class="bi bi-sliders me-2"></i> Settings Website</a>
        </li>
        @endif
      </ul>
      <form action="{{ route('logout') }}" method="POST" class="d-flex ms-auto">
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
    box-shadow:0 4px 24px rgba(78,84,200,0.15);
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
    background:#4e54c8;
    color:#fff;
    border-color:#4e54c8;
}
</style>
@endif
