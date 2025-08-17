<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\BadanUsaha;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    // Admin input invoice
    public function create($id)
    {
        $usaha = BadanUsaha::findOrFail($id);
        return view('invoice.create', compact('usaha'));
    }
    public function store(Request $request, $id)
    {
        $usaha = BadanUsaha::findOrFail($id);
        $request->validate([
            'nomor_invoice' => 'required',
            'nilai' => 'required|numeric|min:0',
        ]);
        Invoice::create([
            'badan_usaha_id' => $id,
            'user_id' => $usaha->user_id,
            'nomor_invoice' => $request->nomor_invoice,
            'nilai' => $request->nilai,
            'status' => 'Belum Dibayar',
        ]);
        return redirect()->route('badan-usaha.index')->with('success', 'Invoice berhasil dibuat dan dikirim');
    }
    // PJ melihat invoice
    public function show($id)
    {
        $invoice = Invoice::where('badan_usaha_id', $id)->first();
        return view('invoice.show', compact('invoice'));
    }
}
