@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0 mb-4" style="border-radius:18px; animation:fadeIn 0.7s; max-width:500px; margin:auto;">
        <div class="card-header text-white" style="background: linear-gradient(90deg,#43cea2,#185a9d); border-radius:18px 18px 0 0;">
            <h2 class="mb-0"><i class="bi bi-person-circle me-2"></i> Pengaturan Akun</h2>
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
            <form method="POST" action="{{ route('user.settings.update') }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}" required>
                </div>
                @if($user->role !== 'PJ')
                <div class="mb-3">
                    <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="PJ" {{ $user->role == 'PJ' ? 'selected' : '' }}>PJ</option>
                    </select>
                </div>
                @endif
                <div class="mb-3 position-relative">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" name="password" id="password" class="form-control" autocomplete="new-password">
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" onclick="togglePassword()">
                        <i class="bi bi-eye" id="togglePasswordIcon"></i>
                    </span>
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                </div>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Update</button>
            </form>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
.card { border-radius:18px; animation:fadeIn 0.7s; }
@keyframes fadeIn { from { opacity:0; transform:translateY(30px);} to { opacity:1; transform:translateY(0);} }
</style>
<script>
function togglePassword() {
    var input = document.getElementById('password');
    var icon = document.getElementById('togglePasswordIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}
</script>
@endsection
