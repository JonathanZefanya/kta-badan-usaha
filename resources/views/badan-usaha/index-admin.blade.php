@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Verifikasi Data Badan Usaha</h2>
    <table class="table table-bordered table-striped">
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
            <tr>
                <td>{{ $usaha->nama_pj }}</td>
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
                        <button type="submit" class="btn btn-success btn-sm">Verifikasi</button>
                    </form>
                    <!-- Tombol untuk buka modal penolakan -->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#tolakModal{{ $usaha->id }}">
                        Tolak
                    </button>

                    <!-- Modal Penolakan -->
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
                        <button type="submit" class="btn btn-warning btn-sm">Buat Invoice</button>
                    </form>
                    @endif
                    @php
                        $pembayaran = \App\Models\Pembayaran::where('badan_usaha_id', $usaha->id)->where('status', 'Menunggu Verifikasi')->first();
                    @endphp
                                        @if($pembayaran)
                                        <!-- Tombol untuk buka modal bukti pembayaran -->
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#buktiPembayaranModal{{ $pembayaran->id }}">
                                                Lihat Bukti Pembayaran
                                        </button>

                                        <!-- Modal Bukti Pembayaran -->
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
                                                                        <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-fluid mb-2" style="max-height:300px;">
                                                                </a>
                                                                <br>
                                                                <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="btn btn-secondary btn-sm">Download Bukti</a>
                                                        @else
                                                                <span class="text-danger">Bukti pembayaran tidak ditemukan.</span>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="POST" action="{{ route('admin.badanusaha.verifikasiPembayaran', $pembayaran->id) }}" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success">Terima Pembayaran</button>
                                                        </form>
                                                        <form method="POST" action="{{ route('admin.badanusaha.tolakPembayaran', $pembayaran->id) }}" class="d-inline" id="formTolakPembayaran{{ $pembayaran->id }}">
                                                                @csrf
                                                                <button type="button" class="btn btn-danger" id="btnTolakPembayaran{{ $pembayaran->id }}" onclick="document.getElementById('btnTolakPembayaran{{ $pembayaran->id }}').style.display='none';document.getElementById('textareaTolakPembayaran{{ $pembayaran->id }}').style.display='block';document.getElementById('submitTolakPembayaran{{ $pembayaran->id }}').style.display='inline-block';">Tolak Pembayaran</button>
                                                                <textarea name="keterangan_tolak" id="textareaTolakPembayaran{{ $pembayaran->id }}" class="form-control mb-2 mt-2" rows="2" placeholder="Keterangan penolakan pembayaran" style="display:none" required></textarea>
                                                                <button type="submit" class="btn btn-danger mt-2" style="display:none" id="submitTolakPembayaran{{ $pembayaran->id }}">Kirim Penolakan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <!-- Tombol untuk buka modal dokumen BU -->
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#dokumenModal{{ $usaha->id }}">
                        Lihat Dokumen
                    </button>
                    <!-- Modal Dokumen BU -->
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
                                                <a href="{{ asset('storage/' . $usaha->npwp_bu_file) }}" target="_blank" class="btn btn-outline-primary btn-sm mb-2">Lihat File</a>
                                            @else
                                                <span class="text-muted">Tidak ada file</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">NIB</label><br>
                                            @if($usaha->nib_file)
                                                <a href="{{ asset('storage/' . $usaha->nib_file) }}" target="_blank" class="btn btn-outline-primary btn-sm mb-2">Lihat File</a>
                                            @else
                                                <span class="text-muted">Tidak ada file</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">KTP PJBU</label><br>
                                            @if($usaha->ktp_pjbu_file)
                                                <a href="{{ asset('storage/' . $usaha->ktp_pjbu_file) }}" target="_blank" class="btn btn-outline-primary btn-sm mb-2">Lihat File</a>
                                            @else
                                                <span class="text-muted">Tidak ada file</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">NPWP PJBU</label><br>
                                            @if($usaha->npwp_pjbu_file)
                                                <a href="{{ asset('storage/' . $usaha->npwp_pjbu_file) }}" target="_blank" class="btn btn-outline-primary btn-sm mb-2">Lihat File</a>
                                            @else
                                                <span class="text-muted">Tidak ada file</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Foto PJBU</label><br>
                                            @if($usaha->photo_pjbu)
                                                <a href="{{ asset('storage/' . $usaha->photo_pjbu) }}" target="_blank" class="btn btn-outline-primary btn-sm mb-2">Lihat File</a>
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
@endsection
