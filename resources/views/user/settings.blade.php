@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Pengaturan Akun</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
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
