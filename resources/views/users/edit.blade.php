@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Edit User</h2>
    @if ($errors->any())
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal update user',
                html: `{!! implode('<br>', $errors->all()) !!}`,
            });
        </script>
    @endif
    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="admin" @if($user->role=='admin') selected @endif>Admin</option>
                <option value="staff" @if($user->role=='staff') selected @endif>Staff</option>
                <option value="PJ" @if($user->role=='PJ') selected @endif>PJ</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password (opsional)</label>
            <input type="password" name="password" id="password" class="form-control" minlength="6">
            <small class="text-muted">Isi jika ingin mengganti password. Minimal 6 karakter.</small>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
