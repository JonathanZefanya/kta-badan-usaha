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
            <h2 class="fw-bold">{{ $totalUsers ?? 0 }}</h2>
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
            <h2 class="fw-bold">{{ $totalBadanUsaha ?? 0 }}</h2>
            <p class="card-text">Lihat semua data badan usaha.</p>
            <a href="{{ route('admin.badanusaha.index') }}" class="btn btn-light btn-sm rounded-pill px-4">Lihat Data</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card card-hover shadow-lg border-0 h-100" style="background: linear-gradient(135deg,#f7971e,#ffd200); color: #fff;">
          <div class="card-body text-center">
            <i class="bi bi-cash-coin display-3 mb-3"></i>
            <h5 class="card-title">Transaksi</h5>
            <h2 class="fw-bold">{{ $totalTransaksi ?? 0 }}</h2>
            <p class="card-text">Total transaksi pembayaran.</p>
            <a href="{{ route('admin.transaksi.index') }}" class="btn btn-light btn-sm rounded-pill px-4">Lihat Transaksi</a>
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
    <div class="row mt-5">
      <div class="col-12">
        <div class="card shadow-lg border-0" style="border-radius:18px; animation:fadeIn 1.3s;">
          <div class="card-header text-white" style="background: linear-gradient(90deg,#4e54c8,#8f94fb); border-radius:18px 18px 0 0;">
            <h4 class="mb-0"><i class="bi bi-bar-chart me-2"></i> Statistik Bulanan</h4>
          </div>
          <div class="card-body bg-light">
            <canvas id="dashboardChart" height="120"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <style>
    .text-gradient {
      background: linear-gradient(90deg,#4e54c8,#8f94fb);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .card-hover:hover {
      transform: translateY(-6px) scale(1.03);
      box-shadow: 0 8px 32px rgba(0,0,0,0.15);
      transition: all 0.2s;
    }
    .card { border-radius:18px; animation:fadeIn 0.7s; }
    @keyframes fadeIn { from { opacity:0; transform:translateY(30px);} to { opacity:1; transform:translateY(0);} }
    @keyframes fadeInRow { from { opacity:0; transform:translateY(20px);} to { opacity:1; transform:translateY(0);} }
  </style>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var ctx = document.getElementById('dashboardChart').getContext('2d');
      var dashboardChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: {!! json_encode($chartLabels ?? ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"]) !!},
          datasets: [
            {
              label: 'Badan Usaha',
              data: {!! json_encode($chartBadanUsaha ?? [0,0,0,0,0,0,0,0,0,0,0,0]) !!},
              backgroundColor: 'rgba(78,84,200,0.7)',
              borderRadius:8,
            },
            {
              label: 'Transaksi',
              data: {!! json_encode($chartTransaksi ?? [0,0,0,0,0,0,0,0,0,0,0,0]) !!},
              backgroundColor: 'rgba(67,206,162,0.7)',
              borderRadius:8,
            },
            {
              label: 'User',
              data: {!! json_encode($chartUsers ?? [0,0,0,0,0,0,0,0,0,0,0,0]) !!},
              backgroundColor: 'rgba(255,215,0,0.7)',
              borderRadius:8,
            }
          ]
        },
        options: {
          responsive: true,
          plugins: {
            legend: { display:true, position:'top' },
            title: { display:false }
          },
          scales: {
            x: { grid: { display:false } },
            y: { beginAtZero:true, grid: { color:'#eee' } }
          }
        }
      });
    });
  </script>
@endsection
