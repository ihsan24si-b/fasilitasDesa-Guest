<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Warga;
use App\Models\FasilitasUmum;
use App\Models\PeminjamanFasilitas;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. KARTU STATISTIK
        $totalFasilitas   = FasilitasUmum::count();
        $totalWarga       = Warga::count();
        
        // PENGGANTI STATUS: Kita hitung total kapasitas seluruh desa
        $totalKapasitas   = FasilitasUmum::sum('kapasitas'); 

        // Peminjaman Aktif (Menggunakan tabel peminjaman, yang punya kolom status)
        // Asumsi: Tabel peminjaman_fasilitas punya kolom 'status' (sesuai diskusi sebelumnya)
        $peminjamanAktif  = PeminjamanFasilitas::where('status', 'disetujui')
                            ->where('tanggal_selesai', '>=', now())
                            ->count();

        // 2. DATA CHART DONAT (Jenis Fasilitas)
        $jenisStats = FasilitasUmum::select('jenis', DB::raw('count(*) as total'))
                     ->groupBy('jenis')
                     ->pluck('total', 'jenis')->toArray();
        
        $labelJenis = array_keys($jenisStats); 
        $dataJenis  = array_values($jenisStats); 

        // 3. DATA CHART BATANG (Peminjaman Bulanan)
        $peminjamanPerBulan = PeminjamanFasilitas::select(
                        DB::raw('MONTH(tanggal_mulai) as bulan'), 
                        DB::raw('count(*) as total')
                    )
                    ->whereYear('tanggal_mulai', date('Y'))
                    ->groupBy('bulan')
                    ->pluck('total', 'bulan')->toArray();

        $dataBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataBulanan[] = $peminjamanPerBulan[$i] ?? 0;
        }

        // 4. DATA TABEL TERBARU
        $fasilitasTerbaru = FasilitasUmum::latest()->limit(5)->get();
        
        $peminjamanTerbaru = PeminjamanFasilitas::with(['warga', 'fasilitas'])
                             ->latest()
                             ->limit(5)
                             ->get();

        return view('pages.dashboard', compact(
            'totalFasilitas', 'peminjamanAktif', 'totalWarga', 'totalKapasitas',
            'labelJenis', 'dataJenis', 'dataBulanan',
            'fasilitasTerbaru', 'peminjamanTerbaru'
        ));
    }
}