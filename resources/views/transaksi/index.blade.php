@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4">History Pembayaran / Transaksi</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>Tanggal</th>
                <th>Nama PJ</th>
                <th>Badan Usaha</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Bukti Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksiList as $trx)
            <tr>
                <td>{{ $trx->created_at->format('d-m-Y H:i') }}</td>
                <td>{{ $trx->user->name ?? '-' }}</td>
                <td>{{ $trx->badanUsaha->nama_pj ?? '-' }}</td>
                <td>{{ $trx->metode }}</td>
                <td>
                    <span class="badge {{ $trx->status == 'Terverifikasi' ? 'bg-success' : ($trx->status == 'Ditolak' ? 'bg-danger' : 'bg-warning text-dark') }}">{{ $trx->status }}</span>
                </td>
                <td>{{ $trx->keterangan_tolak ?? '-' }}</td>
                <td>
                    @if($trx->bukti_pembayaran)
                        <a href="{{ asset('storage/' . $trx->bukti_pembayaran) }}" target="_blank" class="btn btn-info btn-sm">Lihat Bukti</a>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
