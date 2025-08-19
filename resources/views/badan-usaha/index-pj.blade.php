@extends('layouts.app')
@section('content')
@include('components.navbar-pj')
<div class="container mt-4">
    <div class="card shadow-lg border-0 mb-4" style="border-radius:18px; animation:fadeIn 0.7s;">
        <div class="card-header text-white" style="background: linear-gradient(90deg,#4e54c8,#8f94fb); border-radius:18px 18px 0 0;">
            <h2 class="mb-0"><i class="bi bi-building me-2"></i> Data Badan Usaha Saya</h2>
        </div>
        <div class="card-body bg-light">
            <form method="GET" class="mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama PJ, bentuk usaha, status..." value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Cari</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="">Status Verifikasi</option>
                            <option value="Terverifikasi" {{ request('status')=='Terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="Ditolak" {{ request('status')=='Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="Proses" {{ request('status')=='Proses' ? 'selected' : '' }}>Proses</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="bentuk" class="form-select" onchange="this.form.submit()">
                            <option value="">Bentuk Badan Usaha</option>
                            <option value="PT" {{ request('bentuk')=='PT' ? 'selected' : '' }}>PT</option>
                            <option value="CV" {{ request('bentuk')=='CV' ? 'selected' : '' }}>CV</option>
                            <option value="Koperasi" {{ request('bentuk')=='Koperasi' ? 'selected' : '' }}>Koperasi</option>
                        </select>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 table-modern" style="min-width:700px;">
                    <thead class="table-modern-header">
                        <tr>
                            <th>Nama Lengkap PJ</th>
                            <th>Bentuk Badan Usaha</th>
                            <th>Status Verifikasi</th>
                            <th>Invoice</th>
                            <th>Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usahaList as $usaha)
                        <tr style="animation:fadeInRow 0.6s;">
                            <td class="fw-semibold">{{ $usaha->nama_pj }}</td>
                            <td>{{ $usaha->bentuk_badan_usaha }}</td>
                            <td>
                                <span class="badge {{ $usaha->status_verifikasi == 'Terverifikasi' ? 'bg-success' : ($usaha->status_verifikasi == 'Ditolak' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                    {{ $usaha->status_verifikasi }}
                                </span>
                            </td>
                            <td>
                                @if($usaha->invoice)
                                    <a href="{{ route('invoice.show', $usaha->id) }}" class="btn btn-info btn-sm mb-1"><i class="bi bi-file-earmark-text"></i> Invoice</a>
                                    @php
                                        $pembayaran = \App\Models\Pembayaran::where('badan_usaha_id', $usaha->id)->first();
                                    @endphp
                                    @if($usaha->invoice->status == 'Sudah Dibayar' && $pembayaran && $pembayaran->status == 'Terverifikasi')
                                        <a href="{{ route('kta.show', $usaha->id) }}" class="btn btn-warning btn-sm mt-1"><i class="bi bi-award"></i> Show KTA</a>
                                    @endif
                                @else
                                    <span class="text-muted">Belum ada invoice</span>
                                @endif
                            </td>
                            <td>
                                @if($usaha->status_verifikasi == 'Ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                    <div class="mt-2 text-danger">Data badan usaha ditolak saat verifikasi.<br>
                                    <strong>Keterangan:</strong> {{ $usaha->keterangan_tolak ?? '-' }}</div>
                                @elseif($usaha->invoice && $usaha->invoice->status == 'Belum Dibayar')
                                    <a href="{{ route('pembayaran.show', $usaha->id) }}" class="btn btn-success btn-sm"><i class="bi bi-credit-card"></i> Bayar</a>
                                @elseif($usaha->invoice && $usaha->invoice->status == 'Sudah Dibayar')
                                    @php
                                        $pembayaran = \App\Models\Pembayaran::where('badan_usaha_id', $usaha->id)->first();
                                    @endphp
                                    @if($pembayaran && $pembayaran->status == 'Ditolak')
                                        <span class="badge bg-danger">Pembayaran Ditolak</span>
                                        <div class="mt-2 text-danger">Pembayaran Anda ditolak.<br>
                                        <strong>Keterangan:</strong> {{ $pembayaran->keterangan_tolak ?? '-' }}</div>
                                    @else
                                        <span class="badge bg-success">Sudah Dibayar</span>
                                        @if($pembayaran && $pembayaran->status == 'Terverifikasi')
                                            <a href="{{ route('kta.show', $usaha->id) }}" class="btn btn-warning btn-sm mt-2"><i class="bi bi-award"></i> Show KTA</a>
                                        @endif
                                    @endif
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($usaha->status_verifikasi == 'Terverifikasi')
                                    <span class="text-success fw-bold">BU Terverifikasi</span>
                                @else
                                    <a href="{{ route('badan-usaha.edit', $usaha->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    <form method="POST" action="{{ route('badan-usaha.destroy', $usaha->id) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 d-flex justify-content-center">
                @if(method_exists($usahaList, 'links'))
                    {{ $usahaList->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
                @endif
            </div>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
.card { border-radius:18px; animation:fadeIn 0.7s; }
@keyframes fadeIn { from { opacity:0; transform:translateY(30px);} to { opacity:1; transform:translateY(0);} }
@keyframes fadeInRow { from { opacity:0; transform:translateY(20px);} to { opacity:1; transform:translateY(0);} }
.table-modern {
    background:#fff;
    border-radius:16px;
    box-shadow:0 4px 24px rgba(78,84,200,0.08);
    overflow:hidden;
    border-collapse:separate;
    border-spacing:0;
}
.table-modern-header th {
    background: linear-gradient(90deg,#4e54c8,#8f94fb);
    color:#fff;
    font-weight:600;
    border:none;
    font-size:1.08rem;
    padding-top:18px;
    padding-bottom:18px;
}
.table-modern td, .table-modern th {
    border:none;
    padding:0.85em 1em;
    vertical-align:middle;
}
.table-modern tbody tr {
    transition:background 0.2s;
}
.table-modern tbody tr:hover {
    background:rgba(78,84,200,0.07);
}
.badge {
    font-size:1rem;
    padding:0.5em 1em;
    border-radius:12px;
}
.btn-sm {
    font-size:0.97rem;
    padding:0.5em 1.1em;
    border-radius:8px;
}
.pagination {
    --bs-pagination-bg: #fff;
    --bs-pagination-border-radius: 12px;
    --bs-pagination-color: #4e54c8;
    --bs-pagination-hover-color: #fff;
    --bs-pagination-hover-bg: #4e54c8;
    --bs-pagination-active-bg: #8f94fb;
    --bs-pagination-active-color: #fff;
    font-size:1.05rem;
    box-shadow:0 2px 12px rgba(78,84,200,0.08);
}
.pagination .page-link {
    border-radius: 12px !important;
    margin:0 2px;
    transition:background 0.2s, color 0.2s;
}
@media (max-width: 768px) {
    .table-responsive { overflow-x:auto; }
    .table-modern { font-size:0.92rem; }
    .btn-sm { font-size:0.95rem; padding:0.5em 1em; }
    th, td { white-space:nowrap; }
}
</style>
@endsection
