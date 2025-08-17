@if(auth()->user() && in_array(auth()->user()->role, ['admin','staff']))
<nav class="navbar navbar-expand-lg mb-4 shadow" style="background: linear-gradient(90deg,#4e54c8,#8f94fb);">
  <div class="container">
    <a class="navbar-brand fw-bold text-white" href="{{ route('dashboard.admin') }}">
      <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdminStaff" aria-controls="navbarAdminStaff" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarAdminStaff">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('admin.badanusaha.index') }}"><i class="bi bi-building"></i> Data Badan Usaha</a>
        </li>
  @if(auth()->user()->role === 'admin')
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('admin.users.index') }}"><i class="bi bi-people"></i> Users</a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('admin.settings') }}"><i class="bi bi-person-circle"></i> Settings Akun</a>
        </li>
  @if(auth()->user()->role === 'admin')
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('admin.settings.website') }}"><i class="bi bi-sliders"></i> Settings Website</a>
        </li>
        @endif
      </ul>
      <form action="{{ route('logout') }}" method="POST" class="d-flex ms-auto">
        @csrf
        <button type="submit" class="btn btn-outline-light rounded-pill"><i class="bi bi-box-arrow-right"></i> Logout</button>
      </form>
    </div>
  </div>
</nav>
@endif
