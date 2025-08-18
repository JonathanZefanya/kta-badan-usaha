@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="card shadow-lg mx-auto border border-3 border-primary" style="max-width: 600px; background: #f9f9f9;">
        <div class="card-body p-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <img src="{{ asset('favicon.ico') }}" alt="Logo" style="height: 60px;">
                <div class="text-end">
                    <h4 class="fw-bold mb-0" style="color: #4e54c8;">{{ $platform }}</h4>
                    <span class="text-muted">Kartu Tanda Anggota</span>
                </div>
            </div>
            <hr>
            <div class="row mb-4">
                <div class="col-md-7">
                    <h5 class="fw-bold">Nomor Seri: <span class="text-primary">{{ $nomorSeri }}</span></h5>
                    <p class="mb-1"><strong>Nama:</strong> {{ $usaha->nama_pj }}</p>
                    <p class="mb-1"><strong>Badan Usaha:</strong> {{ $usaha->bentuk_badan_usaha }}</p>
                    <p class="mb-1"><strong>NPWP:</strong> {{ $usaha->npwp_bu }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $usaha->email_bu }}</p>
                    <p class="mb-1"><strong>Status:</strong> <span class="badge bg-success">Aktif</span></p>
                    <p class="mb-1"><strong>Berlaku:</strong> {{ $tanggalDibuat }} s/d {{ $tanggalBerakhir }}</p>
                </div>
                <div class="col-md-5 d-flex flex-column align-items-center justify-content-center">
                    <div class="mb-2">
                        <strong>QR Code Signature</strong>
                        <br>
                        {!! QrCode::size(120)->generate(route('kta.verifikasi', $usaha->id)) !!}
                    </div>
                    <div class="mt-2 text-center">
                        <span class="text-muted" style="font-size: 12px;">Scan untuk verifikasi keaslian</span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div>
                    <span class="text-muted" style="font-size: 13px;">Diterbitkan oleh {{ $platform }}</span>
                </div>
                <div class="text-end">
                    <span class="fw-bold" style="font-size: 13px;">{{ $tanggalDibuat }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
