<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BadanUsaha;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    // Tampilkan halaman pembayaran jika dokumen sudah terverifikasi
    public function show($id)
    {
        $usaha = BadanUsaha::findOrFail($id);
        if ($usaha->status_verifikasi !== 'Terverifikasi') {
            return redirect()->route('badan-usaha.index')->with('error', 'Dokumen belum terverifikasi');
        }
        $pembayaran = Pembayaran::where('badan_usaha_id', $id)->first();
        return view('pembayaran.show', compact('usaha', 'pembayaran'));
    }

    // Proses pembayaran
    public function store(Request $request, $id)
    {
        $usaha = BadanUsaha::findOrFail($id);
        if ($usaha->status_verifikasi !== 'Terverifikasi') {
            return redirect()->route('badan-usaha.index')->with('error', 'Dokumen belum terverifikasi');
        }
        $request->validate([
            'metode' => 'required',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf',
        ]);
        $data = [
            'badan_usaha_id' => $id,
            'user_id' => Auth::id(),
            'metode' => $request->metode,
            'bukti_pembayaran' => $request->file('bukti_pembayaran')->store('pembayaran','public'),
            'status' => 'Menunggu Verifikasi',
        ];
        Pembayaran::create($data);
        return redirect()->route('pembayaran.show', $id)->with('success', 'Pembayaran berhasil dikirim, menunggu verifikasi');
    }
}
