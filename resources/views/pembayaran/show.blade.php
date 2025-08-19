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
        <div class="alert alert-info">Status pembayaran: <b>{{ $pembayaran->status }}</b>
            @if($pembayaran->status === 'Ditolak')
                    <p>Keterangan: {{ $pembayaran->keterangan_tolak }}</p>
                @endif
        </div>
    <p>Metode: {{ $pembayaran->metode }}</p>
    <p>Bukti pembayaran: <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank">Lihat File</a></p>
    @else
    <form method="POST" action="{{ route('pembayaran.store', $usaha->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="metode" class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
            <select name="metode" id="metode" class="form-control" required onchange="toggleRekeningInfo()">
                <option value="">Pilih Metode</option>
                <option value="Transfer">Transfer</option>
                <option value="QRIS">QRIS</option>
            </select>
        </div>
        <div id="rekening-info" class="mb-3" style="display:none;">
            <div class="card card-body bg-light border">
                <h5 class="mb-2">Informasi Rekening Pembayaran</h5>
                <p class="mb-1"><b>Nama Pemilik:</b> {{ $settings->rekening_nama ?? '-' }}</p>
                <p class="mb-1"><b>Bank:</b> {{ $settings->rekening_bank ?? '-' }}</p>
                <p class="mb-1"><b>Nomor Rekening:</b> {{ $settings->rekening_nomor ?? '-' }}</p>
            </div>
        </div>
        <div class="mb-3">
            <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran <span class="text-danger">*</span></label>
            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control" required accept=".jpg,.jpeg,.png,.pdf">
        </div>
        <button type="submit" class="btn btn-primary">Kirim Pembayaran</button>
    </form>
    <script>
    function toggleRekeningInfo() {
        var metode = document.getElementById('metode').value;
        var rekeningInfo = document.getElementById('rekening-info');
        rekeningInfo.style.display = (metode === 'Transfer') ? 'block' : 'none';
    }
    document.getElementById('metode').addEventListener('change', toggleRekeningInfo);
    </script>
    @endif
</div>
@endsection
