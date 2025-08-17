@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Data Badan Usaha</h2>
    <form action="{{ route('badan-usaha.update', $usaha->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="true">Data Badan Usaha</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="file-tab" data-bs-toggle="tab" data-bs-target="#file" type="button" role="tab" aria-controls="file" aria-selected="false">Upload Files</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap PJ <span class="text-danger">*</span></label>
                        <input type="text" name="nama_pj" class="form-control" value="{{ $usaha->nama_pj }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Bentuk Badan Usaha <span class="text-danger">*</span></label>
                        <select name="bentuk_badan_usaha" class="form-select" required>
                            <option value="PT" {{ $usaha->bentuk_badan_usaha == 'PT' ? 'selected' : '' }}>PT</option>
                            <option value="CV" {{ $usaha->bentuk_badan_usaha == 'CV' ? 'selected' : '' }}>CV</option>
                            <option value="Koperasi" {{ $usaha->bentuk_badan_usaha == 'Koperasi' ? 'selected' : '' }}>Koperasi</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Jenis Badan Usaha <span class="text-danger">*</span></label>
                        <select name="jenis_badan_usaha" class="form-select" required>
                            <option value="BUJKN" {{ $usaha->jenis_badan_usaha == 'BUJKN' ? 'selected' : '' }}>BUJKN</option>
                            <option value="BUJKA" {{ $usaha->jenis_badan_usaha == 'BUJKA' ? 'selected' : '' }}>BUJKA</option>
                            <option value="BUJKPMA" {{ $usaha->jenis_badan_usaha == 'BUJKPMA' ? 'selected' : '' }}>BUJKPMA</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NPWP Badan Usaha <span class="text-danger">*</span></label>
                        <input type="text" name="npwp_bu" class="form-control" value="{{ $usaha->npwp_bu }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Email BU <span class="text-danger">*</span></label>
                        <input type="email" name="email_bu" class="form-control" value="{{ $usaha->email_bu }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Telepon BU <span class="text-danger">*</span></label>
                        <input type="text" name="telepon_bu" class="form-control" value="{{ $usaha->telepon_bu }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Kode Pos BU <span class="text-danger">*</span></label>
                        <input type="text" name="kode_pos_bu" class="form-control" value="{{ $usaha->kode_pos_bu }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Alamat BU <span class="text-danger">*</span></label>
                        <textarea name="alamat_bu" class="form-control" required>{{ $usaha->alamat_bu }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                        <input type="text" name="provinsi" class="form-control" value="{{ $usaha->provinsi }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kab/Kota <span class="text-danger">*</span></label>
                        <input type="text" name="kab_kota" class="form-control" value="{{ $usaha->kab_kota }}" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Penanggung Jawab (PJBU) <span class="text-danger">*</span></label>
                        <input type="text" name="pjbu" class="form-control" value="{{ $usaha->pjbu }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kualifikasi <span class="text-danger">*</span></label>
                        <select name="kualifikasi" class="form-select" required>
                            <option value="Kecil" {{ $usaha->kualifikasi == 'Kecil' ? 'selected' : '' }}>Kecil</option>
                            <option value="Menengah" {{ $usaha->kualifikasi == 'Menengah' ? 'selected' : '' }}>Menengah</option>
                            <option value="Besar" {{ $usaha->kualifikasi == 'Besar' ? 'selected' : '' }}>Besar</option>
                            <option value="Spesialis" {{ $usaha->kualifikasi == 'Spesialis' ? 'selected' : '' }}>Spesialis</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="file" role="tabpanel" aria-labelledby="file-tab">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Photo PJBU <span class="text-danger">*</span></label>
                        <input type="file" name="photo_pjbu" class="form-control">
                        @if($usaha->photo_pjbu)
                        <a href="{{ asset('storage/' . $usaha->photo_pjbu) }}" target="_blank">Lihat File</a>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NPWP BU <span class="text-danger">*</span></label>
                        <input type="file" name="npwp_bu_file" class="form-control">
                        @if($usaha->npwp_bu_file)
                        <a href="{{ asset('storage/' . $usaha->npwp_bu_file) }}" target="_blank">Lihat File</a>
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">NIB <span class="text-danger">*</span></label>
                        <input type="file" name="nib_file" class="form-control">
                        @if($usaha->nib_file)
                        <a href="{{ asset('storage/' . $usaha->nib_file) }}" target="_blank">Lihat File</a>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">KTP PJBU <span class="text-danger">*</span></label>
                        <input type="file" name="ktp_pjbu_file" class="form-control">
                        @if($usaha->ktp_pjbu_file)
                        <a href="{{ asset('storage/' . $usaha->ktp_pjbu_file) }}" target="_blank">Lihat File</a>
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">NPWP PJBU <span class="text-danger">*</span></label>
                        <input type="file" name="npwp_pjbu_file" class="form-control">
                        @if($usaha->npwp_pjbu_file)
                        <a href="{{ asset('storage/' . $usaha->npwp_pjbu_file) }}" target="_blank">Lihat File</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success mt-3">Update</button>
    </form>
</div>
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
