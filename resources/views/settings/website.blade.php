@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Settings Website</h2>
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        </script>
    @endif
    <form method="POST" action="{{ route('admin.settings.website.update') }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_website" class="form-label">Nama Website</label>
            <input type="text" name="nama_website" id="nama_website" class="form-control" value="{{ old('nama_website', $settings->nama_website ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanda Tangan (Draw Area)</label>
            <div class="border rounded p-2 bg-light">
                <canvas id="signature-pad" width="400" height="120" style="border:1px solid #ccc;"></canvas>
                <input type="hidden" name="signature" id="signature" value="{{ old('signature', $settings->signature ?? '') }}">
                <div class="mt-2">
                    <button type="button" class="btn btn-secondary btn-sm" onclick="clearSignature()">Clear</button>
                </div>
                @if(!empty($settings->signature))
                    <div class="mt-2">
                        <label class="form-label">Tanda Tangan Tersimpan:</label><br>
                        <img src="{{ $settings->signature }}" alt="Signature" style="max-width:200px;max-height:80px;">
                    </div>
                @endif
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Informasi Rekening Pembayaran</label>
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="rekening_nama" class="form-control" placeholder="Nama Pemilik" value="{{ old('rekening_nama', $settings->rekening_nama ?? '') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="rekening_bank" class="form-control" placeholder="Bank" value="{{ old('rekening_bank', $settings->rekening_bank ?? '') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="rekening_nomor" class="form-control" placeholder="Nomor Rekening" value="{{ old('rekening_nomor', $settings->rekening_nomor ?? '') }}">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
let canvas = document.getElementById('signature-pad');
let signatureInput = document.getElementById('signature');
if(canvas) {
    let ctx = canvas.getContext('2d');
    let drawing = false;
    canvas.addEventListener('mousedown', function(e) {
        drawing = true;
        ctx.beginPath();
        ctx.moveTo(e.offsetX, e.offsetY);
    });
    canvas.addEventListener('mousemove', function(e) {
        if (drawing) {
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.stroke();
        }
    });
    canvas.addEventListener('mouseup', function(e) {
        drawing = false;
        signatureInput.value = canvas.toDataURL();
    });
    canvas.addEventListener('mouseleave', function(e) {
        drawing = false;
    });
}
function clearSignature() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    signatureInput.value = '';
}
</script>
@endsection
