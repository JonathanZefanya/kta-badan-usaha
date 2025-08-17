@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Settings Website</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('admin.settings.website.update') }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="site_name" class="form-label">Nama Website</label>
            <input type="text" name="site_name" id="site_name" class="form-control" value="{{ config('app.name') }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
