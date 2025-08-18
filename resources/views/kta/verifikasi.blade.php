@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="card shadow-lg mx-auto" style="max-width: 500px;">
        <div class="card-header bg-primary text-white text-center">
            <h4>Verifikasi KTA</h4>
        </div>
        <div class="card-body text-center">
            <h5 class="mb-2">{{ $usaha->nama_pj }}</h5>
            <p class="mb-1"><strong>Badan Usaha:</strong> {{ $usaha->bentuk_badan_usaha }}</p>
            <p class="mb-1"><strong>NPWP:</strong> {{ $usaha->npwp_bu }}</p>
            <p class="mb-1"><strong>Email:</strong> {{ $usaha->email_bu }}</p>
            <p class="mb-1"><strong>Status Verifikasi:</strong> <span class="badge bg-success">{{ $usaha->status_verifikasi }}</span></p>
            <hr>
            <div class="mb-2">
                <strong>ID KTA:</strong> {{ $usaha->id }}
            </div>
            @php
                $settings = \App\Models\SettingsWebsite::first();
            @endphp
            @if($settings && $settings->signature)
            <div class="mt-3">
                <label class="form-label">Tanda Tangan Platform:</label><br>
                <img src="{{ $settings->signature }}" alt="Signature" style="max-width:200px;max-height:80px;">
                <div class="mt-2 text-success fw-bold">Tanda tangan platform sudah diverifikasi secara digital.</div>
            </div>
            @endif
            <div class="mt-3">
                <span class="text-muted">Scan QR code pada KTA untuk sampai ke halaman ini dan cek keaslian data.</span>
            </div>
        </div>
    </div>
</div>
@endsection
