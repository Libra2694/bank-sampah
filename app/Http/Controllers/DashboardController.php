<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Transaksi;
use App\Models\Penjemputan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        // Dummy statistics
        $totalNasabah = 125;
        $transaksiHariIni = 18;
        $penjemputanMenunggu = 7;
        $totalSampah = 342.5; // in kg

        // Dummy chart data (last 7 days)
        $chartLabels = [];
        $chartData = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $chartLabels[] = $date->format('d M');
            $chartData[] = rand(5, 20); // Random transaction count
        }

        // Dummy upcoming pickups
        $penjemputans = collect([
            [
                'id' => 1,
                'nasabah' => ['nama' => 'John Doe'],
                'tanggal' => Carbon::now()->addDays(1),
                'alamat' => 'Jl. Merdeka No. 123, Jakarta',
                'status' => 'terjadwal'
            ],
            [
                'id' => 2,
                'nasabah' => ['nama' => 'Jane Smith'],
                'tanggal' => Carbon::now()->addDays(2),
                'alamat' => 'Jl. Sudirman No. 456, Jakarta',
                'status' => 'terjadwal'
            ],
            [
                'id' => 3,
                'nasabah' => ['nama' => 'Bob Johnson'],
                'tanggal' => Carbon::now()->addDays(3),
                'alamat' => 'Jl. Thamrin No. 789, Jakarta',
                'status' => 'terjadwal'
            ]
        ])->map(function($item) {
            return (object) $item;
        });

        return view('dashboard', compact(
            'totalNasabah',
            'transaksiHariIni',
            'penjemputanMenunggu',
            'totalSampah',
            'chartLabels',
            'chartData',
            'penjemputans'
        ));
    }
}