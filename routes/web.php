<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BadanUsahaController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('login');
});

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Dashboard PJ
Route::get('/dashboard', function () {
    if (!Auth::check() || Auth::user()->role !== 'PJ') {
        abort(403, 'Unauthorized');
    }
    return view('dashboard-pj');
})->name('dashboard');

// Data Badan Usaha di PJ
Route::get('/badan-usaha', [BadanUsahaController::class, 'index'])->name('badan-usaha.index');
Route::get('/badan-usaha/create', [BadanUsahaController::class, 'create'])->name('badan-usaha.create');
Route::post('/badan-usaha', [BadanUsahaController::class, 'store'])->name('badan-usaha.store');
Route::get('/badan-usaha/{id}/edit', [BadanUsahaController::class, 'edit'])->name('badan-usaha.edit');
Route::put('/badan-usaha/{id}', [BadanUsahaController::class, 'update'])->name('badan-usaha.update');
Route::delete('/badan-usaha/{id}', [BadanUsahaController::class, 'destroy'])->name('badan-usaha.destroy');

// Pembayaran routes
Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show');
Route::post('/pembayaran/{id}', [PembayaranController::class, 'store'])->name('pembayaran.store');

// Invoice routes
Route::get('/invoice/{id}/create', [InvoiceController::class, 'create'])->name('invoice.create'); // admin
Route::post('/invoice/{id}', [InvoiceController::class, 'store'])->name('invoice.store'); // admin
Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show'); // pj

// User settings
Route::get('/settings', [UserController::class, 'editSettings'])->name('user.settings');
Route::put('/settings', [UserController::class, 'update'])->name('user.settings.update');

// Dashboard, Data Badan Usaha, Settings Akun (admin & staff)
Route::get('/admin/dashboard', function () {
    if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'staff'])) {
        abort(403, 'Unauthorized');
    }
    return view('dashboard-admin');
})->name('dashboard.admin');

Route::get('/admin/badan-usaha', function () {
    if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'staff'])) {
        abort(403, 'Unauthorized');
    }
    return app(App\Http\Controllers\BadanUsahaController::class)->index();
})->name('admin.badanusaha.index');

Route::get('/admin/settings', function () {
    if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'staff'])) {
        abort(403, 'Unauthorized');
    }
    return app(App\Http\Controllers\UserController::class)->settings();
})->name('admin.settings');

// Users & Settings Website (admin only)
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
Route::get('/admin/settings-website', [UserController::class, 'showSettingsWebsite'])->name('admin.settings.website');
Route::put('/admin/settings-website', [UserController::class, 'updateSettingsWebsite'])->name('admin.settings.website.update');

// ADMIN & STAFF
Route::get('/admin/badan-usaha', [BadanUsahaController::class, 'indexAdmin'])->name('admin.badanusaha.index');
Route::post('/admin/badan-usaha/{id}/verifikasi', [BadanUsahaController::class, 'verifikasi'])->name('admin.badanusaha.verifikasi');
Route::post('/admin/badan-usaha/{id}/tolak', [BadanUsahaController::class, 'tolak'])->name('admin.badanusaha.tolak');
Route::post('/admin/badan-usaha/{id}/invoice', [BadanUsahaController::class, 'invoice'])->name('admin.badanusaha.invoice');
Route::post('/admin/badan-usaha/pembayaran/{id}/verifikasi', [BadanUsahaController::class, 'verifikasiPembayaran'])->name('admin.badanusaha.verifikasiPembayaran');

// History Transaksi (admin)
Route::get('/admin/transaksi', [\App\Http\Controllers\TransaksiController::class, 'index'])->name('admin.transaksi.index');

// PJ
Route::get('/pj/badan-usaha', [BadanUsahaController::class, 'indexPJ'])->name('pj.badanusaha.index');
Route::get('/pj/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
Route::get('/pj/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show');

Route::post('/admin/badan-usaha/pembayaran/{id}/tolak', [BadanUsahaController::class, 'tolakPembayaran'])->name('admin.badanusaha.tolakPembayaran');

// KTA (Kartu Tanda Anggota)
Route::get('/kta/{id}', [BadanUsahaController::class, 'showKTA'])->name('kta.show');

// KTA Verifikasi QR
Route::get('/kta/{id}/verifikasi', function($id) {
    $usaha = \App\Models\BadanUsaha::findOrFail($id);
    // Logika verifikasi, misal tampilkan data usaha dan status KTA
    return view('kta.verifikasi', compact('usaha'));
})->name('kta.verifikasi');

// Login as admin
Route::post('/admin/users/{id}/loginas', [UserController::class, 'loginAs'])->name('admin.users.loginas');