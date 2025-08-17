@extends('layouts.app')
@section('content')
  <div class="container mt-4">
  <h2 class="mb-4 fw-bold text-gradient">Dashboard {{ ucfirst(auth()->user()->role) }}</h2>
    <div class="row g-4">
      <div class="col-md-3">
        <div class="card card-hover shadow-lg border-0 h-100" style="background: linear-gradient(135deg,#4e54c8,#8f94fb); color: #fff;">
          <div class="card-body text-center">
            <i class="bi bi-people display-3 mb-3"></i>
            <h5 class="card-title">Data User</h5>
            <p class="card-text">Kelola user aplikasi.</p>
            <a href="{{ route('admin.users.index') }}" class="btn btn-light btn-sm rounded-pill px-4">Lihat User</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card card-hover shadow-lg border-0 h-100" style="background: linear-gradient(135deg,#11998e,#38ef7d); color: #fff;">
          <div class="card-body text-center">
            <i class="bi bi-building display-3 mb-3"></i>
            <h5 class="card-title">Data Badan Usaha</h5>
            <p class="card-text">Lihat semua data badan usaha.</p>
            <a href="{{ route('admin.badanusaha.index') }}" class="btn btn-light btn-sm rounded-pill px-4">Lihat Data</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card card-hover shadow-lg border-0 h-100" style="background: linear-gradient(135deg,#f7971e,#ffd200); color: #fff;">
          <div class="card-body text-center">
            <i class="bi bi-gear display-3 mb-3"></i>
            <h5 class="card-title">Settings Website</h5>
            <p class="card-text">Pengaturan website aplikasi.</p>
            <a href="{{ route('admin.settings.website') }}" class="btn btn-light btn-sm rounded-pill px-4">Settings</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card card-hover shadow-lg border-0 h-100" style="background: linear-gradient(135deg,#43cea2,#185a9d); color: #fff;">
          <div class="card-body text-center">
            <i class="bi bi-person display-3 mb-3"></i>
            <h5 class="card-title">Settings Akun</h5>
            <p class="card-text">Ubah data akun Anda.</p>
            <a href="{{ route('admin.settings') }}" class="btn btn-light btn-sm rounded-pill px-4">Settings Akun</a>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-5">
      <div class="alert alert-info shadow-sm">Selamat datang di dashboard admin/staff. Silakan pilih menu di atas untuk mengelola data aplikasi.</div>
    </div>
  </div>
  <style>
    .text-gradient {
      background: linear-gradient(90deg,#4e54c8,#8f94fb);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      text-fill-color: transparent;
    }
    .card-hover:hover {
      transform: translateY(-6px) scale(1.03);
      box-shadow: 0 8px 32px rgba(0,0,0,0.15);
      transition: all 0.2s;
    }
  </style>
@endsection
