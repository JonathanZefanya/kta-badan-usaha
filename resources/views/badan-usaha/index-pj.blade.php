@extends('layouts.app')
@section('content')
@include('components.navbar-pj')
<div class="container mt-4">
    <h2 class="mb-4">Data Badan Usaha Saya</h2>
    <table class="table table-bordered table-striped">
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
                <td>{{ $usaha->nama_pj }}</td>
                <td>{{ $usaha->bentuk_badan_usaha }}</td>
                <td>
                    <span class="badge {{ $usaha->status_verifikasi == 'Terverifikasi' ? 'bg-success' : ($usaha->status_verifikasi == 'Ditolak' ? 'bg-danger' : 'bg-warning text-dark') }}">
                        {{ $usaha->status_verifikasi }}
                    </span>
                </td>
                <td>
                    @if($usaha->invoice)
                        <a href="{{ route('invoice.show', $usaha->id) }}" class="btn btn-info btn-sm">Lihat Invoice</a>
                        @php
                            $pembayaran = \App\Models\Pembayaran::where('badan_usaha_id', $usaha->id)->where('status', 'Terverifikasi')->first();
                        @endphp
                        @if($usaha->invoice->status == 'Sudah Dibayar' && $pembayaran)
                            <br>
                            <a href="{{ route('kta.show', $usaha->id) }}" class="btn btn-warning btn-sm mt-2">Show KTA</a>
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
                        <a href="{{ route('pembayaran.show', $usaha->id) }}" class="btn btn-success btn-sm">Bayar</a>
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
                                <a href="{{ route('kta.show', $usaha->id) }}" class="btn btn-warning btn-sm mt-2">Show KTA</a>
                            @endif
                        @endif
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>
                    @if($usaha->status_verifikasi != 'Terverifikasi')
                        <a href="{{ route('badan-usaha.edit', $usaha->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                        <form method="POST" action="{{ route('badan-usaha.destroy', $usaha->id) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </form>
                    @else
                        <span class="text-success">Sudah Diverifikasi</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
