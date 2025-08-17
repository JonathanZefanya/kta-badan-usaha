@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Buat Invoice untuk {{ $usaha->nama_pj }}</h2>
    <form method="POST" action="{{ route('invoice.store', $usaha->id) }}">
        @csrf
        <div class="mb-3">
            <label for="nomor_invoice" class="form-label">Nomor Invoice <span class="text-danger">*</span></label>
            <input type="text" name="nomor_invoice" id="nomor_invoice" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nilai" class="form-label">Nilai Invoice (Rp) <span class="text-danger">*</span></label>
            <input type="number" name="nilai" id="nilai" class="form-control" required min="0">
        </div>
        <button type="submit" class="btn btn-primary">Kirim Invoice</button>
    </form>
</div>
@endsection
