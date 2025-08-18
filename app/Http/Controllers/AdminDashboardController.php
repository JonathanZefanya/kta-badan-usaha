<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BadanUsaha;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Statistik total
        $totalUsers = User::count();
        $totalBadanUsaha = BadanUsaha::count();
        $totalTransaksi = Pembayaran::count();

        // Data bulanan untuk chart
        $chartLabels = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"];
        $chartBadanUsaha = BadanUsaha::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')->pluck('total','bulan')->toArray();
        $chartTransaksi = Pembayaran::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')->pluck('total','bulan')->toArray();
        $chartUsers = User::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')->pluck('total','bulan')->toArray();

        // Normalisasi data bulanan agar 12 bulan
        $bu = $tr = $us = [];
        for($i=1;$i<=12;$i++){
            $bu[] = $chartBadanUsaha[$i] ?? 0;
            $tr[] = $chartTransaksi[$i] ?? 0;
            $us[] = $chartUsers[$i] ?? 0;
        }

        return view('dashboard-admin', compact(
            'totalUsers','totalBadanUsaha','totalTransaksi',
            'chartLabels','bu','tr','us'
        ))->with([
            'chartBadanUsaha' => $bu,
            'chartTransaksi' => $tr,
            'chartUsers' => $us,
        ]);
    }
}
