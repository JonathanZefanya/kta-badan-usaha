@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0" style="border-radius:18px; animation:fadeIn 0.7s;">
        <div class="card-header text-white" style="background: linear-gradient(90deg,#4e54c8,#8f94fb); border-radius:18px 18px 0 0;">
            <h2 class="mb-0"><i class="bi bi-people me-2"></i> Daftar Users</h2>
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
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3 rounded-pill px-4"><i class="bi bi-person-plus me-1"></i> Tambah User</a>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr style="animation:fadeInRow 0.6s;">
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge bg-info text-dark">{{ $user->username }}</span></td>
                            <td>
                                @if($user->role=='admin')
                                    <span class="badge bg-danger">Admin</span>
                                @elseif($user->role=='staff')
                                    <span class="badge bg-primary">Staff</span>
                                @else
                                    <span class="badge bg-warning text-dark">PJ</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm rounded-pill px-3"><i class="bi bi-pencil-square"></i></a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada user</td>
                        </tr>
                        @endforelse
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
<script>
function confirmDelete(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Yakin hapus user?',
        text: 'Data user akan dihapus permanen!',
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
@endsection
