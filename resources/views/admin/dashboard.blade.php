@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-lg border-0" style="border-radius:18px; animation:fadeInCard 0.7s;">
                <div class="card-body text-center" style="background: linear-gradient(135deg,#43cea2,#185a9d); color:#fff; border-radius:18px;">
                    <i class="bi bi-building display-4 mb-2"></i>
                    <h4 class="fw-bold">Total Badan Usaha</h4>
                    <h2 class="fw-bold">{{ $totalBadanUsaha ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg border-0" style="border-radius:18px; animation:fadeInCard 0.9s;">
                <div class="card-body text-center" style="background: linear-gradient(135deg,#4e54c8,#8f94fb); color:#fff; border-radius:18px;">
                    <i class="bi bi-clock-history display-4 mb-2"></i>
                    <h4 class="fw-bold">Transaksi</h4>
                    <h2 class="fw-bold">{{ $totalTransaksi ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg border-0" style="border-radius:18px; animation:fadeInCard 1.1s;">
                <div class="card-body text-center" style="background: linear-gradient(135deg,#ff512f,#dd2476); color:#fff; border-radius:18px;">
                    <i class="bi bi-people display-4 mb-2"></i>
                    <h4 class="fw-bold">Total Users</h4>
                    <h2 class="fw-bold">{{ $totalUsers ?? 0 }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-lg border-0" style="border-radius:18px; animation:fadeIn 1.3s;">
                <div class="card-header text-white" style="background: linear-gradient(90deg,#4e54c8,#8f94fb); border-radius:18px 18px 0 0;">
                    <h4 class="mb-0"><i class="bi bi-list-task me-2"></i> Aktivitas Terbaru</h4>
                </div>
                <div class="card-body bg-light">
                    <ul class="list-group list-group-flush">
                        @forelse($recentActivities as $activity)
                        <li class="list-group-item d-flex align-items-center" style="animation:fadeInRow 0.6s;">
                            <i class="bi bi-arrow-right-circle me-2 text-primary"></i>
                            <span>{{ $activity }}</span>
                        </li>
                        @empty
                        <li class="list-group-item text-muted">Belum ada aktivitas terbaru.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
.card { border-radius:18px; animation:fadeIn 0.7s; }
@keyframes fadeInCard { from { opacity:0; transform:scale(0.95);} to { opacity:1; transform:scale(1);} }
@keyframes fadeInRow { from { opacity:0; transform:translateY(20px);} to { opacity:1; transform:translateY(0);} }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
