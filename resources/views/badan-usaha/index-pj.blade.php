@extends('layouts.app')
@section('content')
@include('components.navbar-pj')
<div class="container mt-4">
    <div class="card shadow-lg border-0 mb-4" style="border-radius:18px; animation:fadeIn 0.7s;">
        <div class="card-header text-white" style="background: linear-gradient(90deg,#4e54c8,#8f94fb); border-radius:18px 18px 0 0;">
            <h2 class="mb-0"><i class="bi bi-building me-2"></i> Data Badan Usaha Saya</h2>
        </div>
        <div class="card-body bg-light">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
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
                        <tr>
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
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
.card { border-radius:18px; animation:fadeIn 0.7s; }
@keyframes fadeIn { from { opacity:0; transform:translateY(30px);} to { opacity:1; transform:translateY(0);} }
</style>
@endsection
