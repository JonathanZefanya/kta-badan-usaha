@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Pembayaran untuk {{ $usaha->nama_pj }}</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if($pembayaran)
        <div class="alert alert-info">Status pembayaran: <b>{{ $pembayaran->status }}</b></div>
        <p>Metode: {{ $pembayaran->metode }}</p>
        <p>Bukti pembayaran: <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank">Lihat File</a></p>
    @else
    <form method="POST" action="{{ route('pembayaran.store', $usaha->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="metode" class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
            <select name="metode" id="metode" class="form-control" required>
                <option value="">Pilih Metode</option>
                <option value="Transfer">Transfer</option>
                <option value="QRIS">QRIS</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran <span class="text-danger">*</span></label>
            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control" required accept=".jpg,.jpeg,.png,.pdf">
        </div>
        <button type="submit" class="btn btn-primary">Kirim Pembayaran</button>
    </form>
    @endif
</div>
@endsection
