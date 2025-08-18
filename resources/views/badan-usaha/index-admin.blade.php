@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0" style="border-radius:18px; animation:fadeIn 0.7s;">
        <div class="card-header text-white" style="background: linear-gradient(90deg,#4e54c8,#8f94fb); border-radius:18px 18px 0 0;">
            <h2 class="mb-0"><i class="bi bi-building me-2"></i> Verifikasi Data Badan Usaha</h2>
        </div>
        <div class="card-body bg-light">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>Nama Lengkap PJ</th>
                            <th>Bentuk Badan Usaha</th>
                            <th>Status Verifikasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usahaList as $usaha)
                        <tr style="animation:fadeInRow 0.6s;">
                            <td class="fw-semibold">{{ $usaha->nama_pj }}</td>
                            <td>{{ $usaha->bentuk_badan_usaha }}</td>
                            <td>
                                <span class="badge {{ $usaha->status_verifikasi == 'Terverifikasi' ? 'bg-success' : ($usaha->status_verifikasi == 'Ditolak' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                    {{ $usaha->status_verifikasi }}
                                </span>
                            </td>
                            <td>
                                @if($usaha->status_verifikasi != 'Terverifikasi')
                                <form method="POST" action="{{ route('admin.badanusaha.verifikasi', $usaha->id) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm rounded-pill px-3"><i class="bi bi-check-circle me-1"></i> Verifikasi</button>
                                </form>
                                <button type="button" class="btn btn-danger btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#tolakModal{{ $usaha->id }}">
                                    <i class="bi bi-x-circle me-1"></i> Tolak
                                </button>
                                <div class="modal fade" id="tolakModal{{ $usaha->id }}" tabindex="-1" aria-labelledby="tolakModalLabel{{ $usaha->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('admin.badanusaha.tolak', $usaha->id) }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="tolakModalLabel{{ $usaha->id }}">Keterangan Penolakan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <textarea name="keterangan_tolak" class="form-control mb-2" rows="3" placeholder="Keterangan penolakan" required></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if($usaha->status_verifikasi == 'Terverifikasi' && !$usaha->invoice)
                                <form method="POST" action="{{ route('admin.badanusaha.invoice', $usaha->id) }}" class="d-inline">
                                    @csrf
                                    <input type="number" name="nilai" class="form-control d-inline w-auto" placeholder="Total Bayar" required>
                                    <button type="submit" class="btn btn-warning btn-sm rounded-pill px-3"><i class="bi bi-receipt me-1"></i> Buat Invoice</button>
                                </form>
                                @endif
                                @php
                                    $pembayaran = \App\Models\Pembayaran::where('badan_usaha_id', $usaha->id)->where('status', 'Menunggu Verifikasi')->first();
                                @endphp
                                @if($pembayaran)
                                <button type="button" class="btn btn-info btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#buktiPembayaranModal{{ $pembayaran->id }}">
                                    <i class="bi bi-file-earmark-image me-1"></i> Bukti Pembayaran
                                </button>
                                <div class="modal fade" id="buktiPembayaranModal{{ $pembayaran->id }}" tabindex="-1" aria-labelledby="buktiPembayaranLabel{{ $pembayaran->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="buktiPembayaranLabel{{ $pembayaran->id }}">Bukti Pembayaran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                @if($pembayaran->bukti_pembayaran)
                                                    <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank">
                                                        <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-fluid mb-2" style="max-height:300px; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,0.08);">
                                                    </a>
                                                    <br>
                                                    <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="btn btn-secondary btn-sm rounded-pill px-3">Download Bukti</a>
                                                @else
                                                    <span class="text-danger">Bukti pembayaran tidak ditemukan.</span>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <form method="POST" action="{{ route('admin.badanusaha.verifikasiPembayaran', $pembayaran->id) }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success rounded-pill px-3"><i class="bi bi-check-circle me-1"></i> Terima Pembayaran</button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.badanusaha.tolakPembayaran', $pembayaran->id) }}" class="d-inline" id="formTolakPembayaran{{ $pembayaran->id }}">
                                                    @csrf
                                                    <button type="button" class="btn btn-danger rounded-pill px-3" id="btnTolakPembayaran{{ $pembayaran->id }}" onclick="document.getElementById('btnTolakPembayaran{{ $pembayaran->id }}').style.display='none';document.getElementById('textareaTolakPembayaran{{ $pembayaran->id }}').style.display='block';document.getElementById('submitTolakPembayaran{{ $pembayaran->id }}').style.display='inline-block';"><i class="bi bi-x-circle me-1"></i> Tolak Pembayaran</button>
                                                    <textarea name="keterangan_tolak" id="textareaTolakPembayaran{{ $pembayaran->id }}" class="form-control mb-2 mt-2" rows="2" placeholder="Keterangan penolakan pembayaran" style="display:none" required></textarea>
                                                    <button type="submit" class="btn btn-danger mt-2 rounded-pill px-3" style="display:none" id="submitTolakPembayaran{{ $pembayaran->id }}">Kirim Penolakan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#dokumenModal{{ $usaha->id }}">
                                    <i class="bi bi-folder2-open me-1"></i> Dokumen
                                </button>
                                <div class="modal fade" id="dokumenModal{{ $usaha->id }}" tabindex="-1" aria-labelledby="dokumenModalLabel{{ $usaha->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="dokumenModalLabel{{ $usaha->id }}">Dokumen Badan Usaha</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">NPWP BU</label><br>
                                                        @if($usaha->npwp_bu_file)
                                                            <a href="{{ asset('storage/' . $usaha->npwp_bu_file) }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3 mb-2">Lihat File</a>
                                                        @else
                                                            <span class="text-muted">Tidak ada file</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">NIB</label><br>
                                                        @if($usaha->nib_file)
                                                            <a href="{{ asset('storage/' . $usaha->nib_file) }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3 mb-2">Lihat File</a>
                                                        @else
                                                            <span class="text-muted">Tidak ada file</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">KTP PJBU</label><br>
                                                        @if($usaha->ktp_pjbu_file)
                                                            <a href="{{ asset('storage/' . $usaha->ktp_pjbu_file) }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3 mb-2">Lihat File</a>
                                                        @else
                                                            <span class="text-muted">Tidak ada file</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">NPWP PJBU</label><br>
                                                        @if($usaha->npwp_pjbu_file)
                                                            <a href="{{ asset('storage/' . $usaha->npwp_pjbu_file) }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3 mb-2">Lihat File</a>
                                                        @else
                                                            <span class="text-muted">Tidak ada file</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Foto PJBU</label><br>
                                                        @if($usaha->photo_pjbu)
                                                            <a href="{{ asset('storage/' . $usaha->photo_pjbu) }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3 mb-2">Lihat File</a>
                                                        @else
                                                            <span class="text-muted">Tidak ada file</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
.card { border-radius:18px; animation:fadeIn 0.7s; }
@keyframes fadeIn { from { opacity:0; transform:translateY(30px);} to { opacity:1; transform:translateY(0);} }
@keyframes fadeInRow { from { opacity:0; transform:translateY(20px);} to { opacity:1; transform:translateY(0);} }
.table th, .table td { vertical-align:middle; }
.badge { font-size:1rem; padding:0.5em 1em; border-radius:12px; }
.btn { transition:background 0.2s, color 0.2s; }
.btn:hover { filter:brightness(1.08); }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Data wajib diisi',
        text: 'Silakan lengkapi semua data yang bertanda *',
    });
</script>
@endif
@endsection
