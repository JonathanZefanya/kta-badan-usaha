<?php
namespace App\Http\Controllers;

use App\Models\BadanUsaha;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BadanUsahaController extends Controller
{
    // ADMIN: Tolak pembayaran PJ
    public function tolakPembayaran($id, Request $request)
    {
        $pembayaran = \App\Models\Pembayaran::findOrFail($id);
        $pembayaran->status = 'Ditolak';
        $pembayaran->keterangan_tolak = $request->input('keterangan_tolak');
        $pembayaran->save();
        return redirect()->back()->with('success', 'Pembayaran berhasil ditolak');
    }
    // Tampilkan halaman KTA dengan QR code
    public function showKTA($id)
    {
        $usaha = \App\Models\BadanUsaha::findOrFail($id);
        $pembayaran = \App\Models\Pembayaran::where('badan_usaha_id', $id)->where('status', 'Terverifikasi')->first();
        $invoice = \App\Models\Invoice::where('badan_usaha_id', $id)->first();
        // Nomor seri KTA bisa dari id atau kombinasi waktu dan id
        $nomorSeri = 'KTA-' . str_pad($usaha->id, 6, '0', STR_PAD_LEFT);
        $platform = config('app.name', 'Platform');
        $tanggalDibuat = $pembayaran ? $pembayaran->updated_at->format('d-m-Y') : date('d-m-Y');
    $tanggalBerakhir = $pembayaran ? $pembayaran->updated_at->addYears(3)->format('d-m-Y') : date('d-m-Y', strtotime('+3 year'));
        return view('kta.show', compact('usaha', 'nomorSeri', 'platform', 'tanggalDibuat', 'tanggalBerakhir', 'invoice'));
    }
    // ADMIN: Verifikasi pembayaran PJ
    public function verifikasiPembayaran($id)
    {
        $pembayaran = \App\Models\Pembayaran::findOrFail($id);
        $pembayaran->status = 'Terverifikasi';
        $pembayaran->save();

        // Update invoice status to 'Sudah Dibayar'
        $invoice = \App\Models\Invoice::where('badan_usaha_id', $pembayaran->badan_usaha_id)->first();
        if ($invoice) {
            $invoice->status = 'Sudah Dibayar';
            $invoice->save();
        }

        // Generate KTA (Kartu Tanda Anggota) dengan QR code
        $usaha = $pembayaran->badanUsaha;
        $ktaUrl = route('kta.show', $usaha->id);
        // Simpan/Update data KTA di database jika perlu
        // ...
        // QR code bisa digenerate di view menggunakan package seperti simplesoftwareio/simple-qrcode

        return redirect()->back()->with('success', 'Pembayaran diverifikasi dan KTA siap dicetak');
    }
    // ADMIN/STAF: Verifikasi dokumen BU
    public function verifikasi($id)
    {
        $usaha = BadanUsaha::findOrFail($id);
        $usaha->status_verifikasi = 'Terverifikasi';
        $usaha->save();
        return redirect()->back()->with('success', 'Dokumen berhasil diverifikasi');
    }

    // ADMIN/STAF: Tolak dokumen BU
    public function tolak($id, Request $request)
    {
        $usaha = BadanUsaha::findOrFail($id);
        $usaha->status_verifikasi = 'Ditolak';
        $usaha->keterangan_tolak = $request->input('keterangan_tolak');
        $usaha->save();
        return redirect()->back()->with('success', 'Dokumen berhasil ditolak');
    }

    // ADMIN/STAF: Buat invoice setelah verifikasi
    public function invoice(Request $request, $id)
    {
        $usaha = BadanUsaha::findOrFail($id);
        if ($usaha->status_verifikasi != 'Terverifikasi') {
            return redirect()->back()->with('error', 'Dokumen belum terverifikasi');
        }
        $request->validate([
            'nilai' => 'required|numeric|min:0',
        ]);
        Invoice::create([
            'badan_usaha_id' => $usaha->id,
            'user_id' => $usaha->user_id,
            'nomor_invoice' => 'INV-' . time(),
            'nilai' => $request->nilai,
            'status' => 'Belum Dibayar',
        ]);
        return redirect()->back()->with('success', 'Invoice berhasil dibuat');
    }

    public function destroy($id)
    {
        $usaha = BadanUsaha::findOrFail($id);
        // Jika BU sudah terverifikasi, PJ tidak bisa hapus
        if (Auth::user()->role === 'PJ' && $usaha->status_verifikasi === 'Terverifikasi') {
            return redirect()->route('badan-usaha.index')->with('error', 'BU ini sudah terverifikasi');
        }
        $usaha->delete();
        return redirect()->route('badan-usaha.index')->with('success','Data badan usaha berhasil dihapus');
    }

    public function edit($id)
    {
        $usaha = BadanUsaha::findOrFail($id);
        // Jika BU sudah terverifikasi, PJ tidak bisa edit
        if (Auth::user()->role === 'PJ' && $usaha->status_verifikasi === 'Terverifikasi') {
            return redirect()->route('badan-usaha.index')->with('error', 'BU ini sudah terverifikasi');
        }
        return view('badan-usaha.edit', compact('usaha'));
    }

    public function update(Request $request, $id)
    {
        $usaha = BadanUsaha::findOrFail($id);
        // Jika BU sudah terverifikasi, PJ tidak bisa update
        if (Auth::user()->role === 'PJ' && $usaha->status_verifikasi === 'Terverifikasi') {
            return redirect()->route('badan-usaha.index')->with('error', 'BU ini sudah terverifikasi');
        }
        $request->validate([
            'nama_pj' => 'required',
            'bentuk_badan_usaha' => 'required',
            'jenis_badan_usaha' => 'required',
            'npwp_bu' => 'required',
            'email_bu' => 'required|email',
            'telepon_bu' => 'required',
            'kode_pos_bu' => 'required',
            'alamat_bu' => 'required',
            'provinsi' => 'required',
            'kab_kota' => 'required',
            'pjbu' => 'required',
            'kualifikasi' => 'required',
        ]);

        $data = $request->except(['photo_pjbu','npwp_bu_file','nib_file','ktp_pjbu_file','npwp_pjbu_file']);

        // Handle file uploads jika ada
        if ($request->hasFile('photo_pjbu')) {
            $data['photo_pjbu'] = $request->file('photo_pjbu')->store('badan-usaha/photo-pjbu','public');
        }
        if ($request->hasFile('npwp_bu_file')) {
            $data['npwp_bu_file'] = $request->file('npwp_bu_file')->store('badan-usaha/npwp-bu','public');
        }
        if ($request->hasFile('nib_file')) {
            $data['nib_file'] = $request->file('nib_file')->store('badan-usaha/nib','public');
        }
        if ($request->hasFile('ktp_pjbu_file')) {
            $data['ktp_pjbu_file'] = $request->file('ktp_pjbu_file')->store('badan-usaha/ktp-pjbu','public');
        }
        if ($request->hasFile('npwp_pjbu_file')) {
            $data['npwp_pjbu_file'] = $request->file('npwp_pjbu_file')->store('badan-usaha/npwp-pjbu','public');
        }

        $usaha->update($data);

        return redirect()->route('badan-usaha.index')->with('success','Data badan usaha berhasil diupdate');
    }

    // ADMIN/STAF: List badan usaha
    public function indexAdmin()
    {
        $usahaList = BadanUsaha::with('invoice')->get();
        return view('badan-usaha.index-admin', compact('usahaList'));
    }

    // PJ: List badan usaha milik sendiri
    public function indexPJ()
    {
        $usahaList = BadanUsaha::with('invoice')->where('user_id', Auth::id())->get();
        return view('badan-usaha.index-pj', compact('usahaList'));
    }

    public function create()
    {
        return view('badan-usaha.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pj' => 'required',
            'bentuk_badan_usaha' => 'required',
            'jenis_badan_usaha' => 'required',
            'npwp_bu' => 'required',
            'email_bu' => 'required|email',
            'telepon_bu' => 'required',
            'kode_pos_bu' => 'required',
            'alamat_bu' => 'required',
            'provinsi' => 'required',
            'kab_kota' => 'required',
            'pjbu' => 'required',
            'kualifikasi' => 'required',
            'photo_pjbu' => 'required|file|mimes:jpg,jpeg,png',
            'npwp_bu_file' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'nib_file' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'ktp_pjbu_file' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'npwp_pjbu_file' => 'required|file|mimes:pdf,jpg,jpeg,png',
        ]);

        $data = $request->except(['photo_pjbu','npwp_bu_file','nib_file','ktp_pjbu_file','npwp_pjbu_file']);
        $data['user_id'] = Auth::id();
        $data['status_verifikasi'] = 'Belum Diverifikasi';

        // Handle file uploads
        $data['photo_pjbu'] = $request->file('photo_pjbu')->store('badan-usaha/photo-pjbu','public');
        $data['npwp_bu_file'] = $request->file('npwp_bu_file')->store('badan-usaha/npwp-bu','public');
        $data['nib_file'] = $request->file('nib_file')->store('badan-usaha/nib','public');
        $data['ktp_pjbu_file'] = $request->file('ktp_pjbu_file')->store('badan-usaha/ktp-pjbu','public');
        $data['npwp_pjbu_file'] = $request->file('npwp_pjbu_file')->store('badan-usaha/npwp-pjbu','public');

        BadanUsaha::create($data);

        return redirect()->route('badan-usaha.index')->with('success','Data badan usaha berhasil ditambahkan');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'PJ') {
            $usahaList = BadanUsaha::where('user_id', $user->id)->get();
        } else {
            $usahaList = BadanUsaha::all();
        }
        return view('badan-usaha.index', compact('usahaList'));
    }
}
