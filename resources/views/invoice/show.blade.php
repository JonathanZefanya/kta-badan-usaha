@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Invoice</h2>
    @if($invoice)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Nomor Invoice: {{ $invoice->nomor_invoice }}</h5>
                <p class="card-text">Nilai: <b>Rp {{ number_format($invoice->nilai, 2, ',', '.') }}</b></p>
                <p class="card-text">Status: <span class="badge {{ $invoice->status == 'Belum Dibayar' ? 'bg-warning text-dark' : 'bg-success' }}">{{ $invoice->status }}</span></p>
            </div>
        </div>
    @else
        <div class="alert alert-info">Belum ada invoice untuk data ini.</div>
    @endif
</div>
@endsection
