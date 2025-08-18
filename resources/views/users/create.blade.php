@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0" style="border-radius:18px; animation:fadeIn 0.7s; max-width:600px; margin:auto;">
        <div class="card-header text-white" style="background: linear-gradient(90deg,#4e54c8,#8f94fb); border-radius:18px 18px 0 0;">
            <h2 class="mb-0"><i class="bi bi-person-plus me-2"></i> Tambah User</h2>
        </div>
        <div class="card-body bg-light">
            @if ($errors->any())
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal menambah user',
                        html: `{!! implode('<br>', $errors->all()) !!}`,
                    });
                </script>
            @endif
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label"><i class="bi bi-person me-1"></i> Nama</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label"><i class="bi bi-envelope me-1"></i> Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label"><i class="bi bi-person-badge me-1"></i> Username</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label"><i class="bi bi-person-gear me-1"></i> Role</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                        <option value="PJ">PJ</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label"><i class="bi bi-key me-1"></i> Password</label>
                    <input type="password" name="password" id="password" class="form-control" required minlength="6">
                    <small class="text-muted">Minimal 6 karakter</small>
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
@endsection
