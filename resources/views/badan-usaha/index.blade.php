@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Data Badan Usaha</h2>
    <div class="mb-3">
        <a href="{{ route('badan-usaha.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah Data Badan Usaha</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>Nama Lengkap PJ</th>
                <th>Bentuk Badan Usaha</th>
                <th>Jenis Badan Usaha</th>
                <th>NPWP Badan Usaha</th>
                <th>Email BU</th>
                <th>No. Telepon BU</th>
                <th>Kode Pos BU</th>
                <th>Alamat BU</th>
                <th>Provinsi</th>
                <th>Kab/Kota</th>
                <th>PJBU</th>
                <th>Kualifikasi</th>
                <th>Status Verifikasi</th>
                <th>Files</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usahaList as $usaha)
            <tr>
                <td>{{ $usaha->nama_pj }}</td>
                <td>{{ $usaha->bentuk_badan_usaha }}</td>
                <td>{{ $usaha->jenis_badan_usaha }}</td>
                <td>{{ $usaha->npwp_bu }}</td>
                <td>{{ $usaha->email_bu }}</td>
                <td>{{ $usaha->telepon_bu }}</td>
                <td>{{ $usaha->kode_pos_bu }}</td>
                <td>{{ $usaha->alamat_bu }}</td>
                <td>{{ $usaha->provinsi }}</td>
                <td>{{ $usaha->kab_kota }}</td>
                <td>{{ $usaha->pjbu }}</td>
                <td>{{ $usaha->kualifikasi }}</td>
                <td>
                    <span class="badge {{ $usaha->status_verifikasi == 'Terverifikasi' ? 'bg-success' : ($usaha->status_verifikasi == 'Ditolak' ? 'bg-danger' : 'bg-warning text-dark') }}">
                        {{ $usaha->status_verifikasi }}
                    </span>
                    @if($usaha->status_verifikasi == 'Terverifikasi')
                        @php
                            $invoice = \App\Models\Invoice::where('badan_usaha_id', $usaha->id)->first();
                        @endphp
                        @if($invoice)
                            <a href="{{ route('invoice.show', $usaha->id) }}" class="btn btn-info btn-sm mt-2">
                                <i class="bi bi-file-earmark-text"></i> Invoice
                            </a>
                            @if($invoice->status == 'Belum Dibayar')
                                <a href="{{ route('pembayaran.show', $usaha->id) }}" class="btn btn-success btn-sm mt-2">
                                    <i class="bi bi-credit-card"></i> Pembayaran
                                </a>
                            @endif
                        @else
                            <span class="text-muted d-block mt-2">Menunggu invoice dari admin</span>
                        @endif
                    @endif
                </td>
                <td>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalFiles{{ $usaha->id }}">
                        <i class="bi bi-folder2-open"></i> Selengkapnya
                    </button>
                    @include('badan-usaha.modal-files', ['usaha' => $usaha])
                </td>
                <td>
                    <a href="{{ route('badan-usaha.edit', $usaha->id) }}" class="btn btn-warning btn-sm mb-1" title="Edit">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form action="{{ route('badan-usaha.destroy', $usaha->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event)">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="13" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            function confirmDelete(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: 'Data yang dihapus tidak dapat dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.target.submit();
                    }
                });
                return false;
            }
            </script>
        </tbody>
    </table>
</div>
@endsection
