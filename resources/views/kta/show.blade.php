@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="card shadow-lg mx-auto" style="max-width: 400px;">
        <div class="card-header bg-primary text-white text-center">
            <h4>Kartu Tanda Anggota</h4>
        </div>
        <div class="card-body text-center">
            <h5 class="mb-2">{{ $usaha->nama_pj }}</h5>
            <p class="mb-1"><strong>Badan Usaha:</strong> {{ $usaha->bentuk_badan_usaha }}</p>
            <p class="mb-1"><strong>NPWP:</strong> {{ $usaha->npwp_bu }}</p>
            <p class="mb-1"><strong>Email:</strong> {{ $usaha->email_bu }}</p>
            <p class="mb-1"><strong>Status:</strong> <span class="badge bg-success">Aktif</span></p>
            <hr>
            <div class="mb-2">
                <strong>QR Code Verifikasi</strong>
                <br>
                {!! QrCode::size(120)->generate(route('kta.verifikasi', $usaha->id)) !!}
            </div>
        </div>
    </div>
</div>
@endsection
