<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\BadanUsaha;
use App\Models\User;

class TransaksiController extends Controller
{
    // Menampilkan history pembayaran/transaksi untuk admin
    public function index()
    {
        $transaksiList = Pembayaran::with(['badanUsaha', 'user'])->orderBy('created_at', 'desc')->get();
        return view('transaksi.index', compact('transaksiList'));
    }
}
