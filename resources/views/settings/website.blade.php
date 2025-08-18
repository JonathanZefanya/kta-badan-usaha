@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0" style="border-radius:18px; animation:fadeIn 0.7s; max-width:700px; margin:auto;">
        <div class="card-header text-white" style="background: linear-gradient(90deg,#4e54c8,#8f94fb); border-radius:18px 18px 0 0;">
            <h2 class="mb-0"><i class="bi bi-sliders me-2"></i> Settings Website</h2>
        </div>
        <div class="card-body bg-light">
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
                    <label for="nama_website" class="form-label"><i class="bi bi-globe me-1"></i> Nama Website</label>
                    <input type="text" name="nama_website" id="nama_website" class="form-control" value="{{ old('nama_website', $settings->nama_website ?? '') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-pencil me-1"></i> Tanda Tangan (Draw Area)</label>
                    <div class="border rounded p-2 bg-light" style="border-radius:12px;">
                        <canvas id="signature-pad" width="400" height="120" style="border:1px solid #ccc; border-radius:8px;"></canvas>
                        <input type="hidden" name="signature" id="signature" value="{{ old('signature', $settings->signature ?? '') }}">
                        <div class="mt-2">
                            <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" onclick="clearSignature()">Clear</button>
                        </div>
                        @if(!empty($settings->signature))
                            <div class="mt-2">
                                <label class="form-label">Tanda Tangan Tersimpan:</label><br>
                                <img src="{{ $settings->signature }}" alt="Signature" style="max-width:200px;max-height:80px; border-radius:8px; box-shadow:0 2px 12px rgba(0,0,0,0.08);">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-credit-card me-1"></i> Informasi Rekening Pembayaran</label>
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
                <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan</button>
            </form>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
.card { border-radius:18px; animation:fadeIn 0.7s; }
@keyframes fadeIn { from { opacity:0; transform:translateY(30px);} to { opacity:1; transform:translateY(0);} }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
let canvas = document.getElementById('signature-pad');
let signatureInput = document.getElementById('signature');
if(canvas) {
    let ctx = canvas.getContext('2d');
    let drawing = false;
    let lastPos = {x:0, y:0};
    canvas.addEventListener('mousedown', function(e){ drawing=true; lastPos={x:e.offsetX, y:e.offsetY}; });
    canvas.addEventListener('mouseup', function(){ drawing=false; signatureInput.value=canvas.toDataURL(); });
    canvas.addEventListener('mousemove', function(e){
        if(drawing){
            ctx.beginPath();
            ctx.moveTo(lastPos.x, lastPos.y);
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.strokeStyle = '#4e54c8';
            ctx.lineWidth = 2;
            ctx.stroke();
            lastPos={x:e.offsetX, y:e.offsetY};
        }
    });
}
function clearSignature(){
    if(canvas){
        ctx.clearRect(0,0,canvas.width,canvas.height);
        signatureInput.value='';
    }
}
</script>
@endsection
