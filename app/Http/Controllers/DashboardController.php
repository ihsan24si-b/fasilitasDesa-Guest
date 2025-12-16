<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

// --- IMPORT MODELS ---
use App\Models\User;
use App\Models\Warga;
use App\Models\FasilitasUmum;
use App\Models\PeminjamanFasilitas; 
use App\Models\PembayaranFasilitas; // [FIX] Gunakan model yang benar
use App\Models\Media; 

class DashboardController extends Controller
{
    public function index()
    {
        // ==========================================
        // 1. DATA UMUM / STATISTIK DASAR (Tampil di Guest & Admin)
        // ==========================================
        $totalFasilitas = FasilitasUmum::count();
        $totalWarga     = Warga::count();
        
        // Hitung fasilitas yang sedang dipakai hari ini
        $peminjamanAktif = PeminjamanFasilitas::where('status', 'disetujui')
            ->where('tanggal_selesai', '>=', now()->toDateString())
            ->count();
            
        $fasilitasTersedia = $totalFasilitas - $peminjamanAktif;
        if ($fasilitasTersedia < 0) $fasilitasTersedia = 0;

        // Data Fasilitas Terbaru (Untuk Grid/Slider di Halaman Depan)
        $fasilitasTerbaru = FasilitasUmum::with('media')
                            ->latest('fasilitas_id')
                            ->take(6)
                            ->get();

        // ==========================================
        // 2. DATA KOMPONEN HALAMAN DEPAN (PORTAL)
        // ==========================================
        
        // A. Statistik Jenis Fasilitas (Untuk Kategori Unggulan)
        $jenisStats = FasilitasUmum::select('jenis', DB::raw('count(*) as total'))
                     ->groupBy('jenis')
                     ->pluck('total', 'jenis')
                     ->toArray();
        
        // B. Data Kategori Unggulan (Manual Array + Data DB)
        // Pastikan nama key array ($jenisStats['...']) sesuai dengan isi kolom 'jenis' di database
        $jenisFasilitasUnggulan = [
            [ 'nama' => 'Balai Desa', 'foto_asset' => 'assets/img/jenis-balai.jpg', 'jumlah' => $jenisStats['Balai Desa'] ?? 0 ],
            [ 'nama' => 'Aula Serbaguna', 'foto_asset' => 'assets/img/jenis-aula.jpg', 'jumlah' => $jenisStats['Aula'] ?? 0 ],
            [ 'nama' => 'Lapangan', 'foto_asset' => 'assets/img/jenis-lapangan.jpg', 'jumlah' => $jenisStats['Lapangan'] ?? 0 ],
            [ 'nama' => 'Ruang Rapat', 'foto_asset' => 'assets/img/jenis-rapat.jpg', 'jumlah' => $jenisStats['Ruang Rapat'] ?? 0 ],
        ];

        // C. Alur Peminjaman (Static Data untuk Tamu)
        $alurPeminjaman = [
            [
                'judul' => 'Cek Jadwal',
                'icon' => 'fas fa-calendar-check',
                'deskripsi' => 'Lihat ketersediaan fasilitas pada tanggal yang Anda butuhkan.'
            ],
            [
                'judul' => 'Isi Formulir',
                'icon' => 'fas fa-file-signature',
                'deskripsi' => 'Ajukan permohonan peminjaman dengan detail acara dan tujuan.'
            ],
            [
                'judul' => 'Verifikasi Admin',
                'icon' => 'fas fa-user-shield',
                'deskripsi' => 'Admin akan melakukan verifikasi data dan memberikan persetujuan.'
            ],
            [
                'judul' => 'Gunakan Fasilitas',
                'icon' => 'fas fa-door-open',
                'deskripsi' => 'Setelah disetujui, fasilitas siap digunakan sesuai jadwal.'
            ],
        ];

        // D. Galeri Fasilitas (Mengambil dari Tabel Media)
        $mediaGaleri = Media::where('ref_table', 'fasilitas_umum')
                            ->inRandomOrder()
                            ->limit(5)
                            ->get();
                            
        $galeriFasilitas = [];
        foreach ($mediaGaleri as $m) {
            $galeriFasilitas[] = [
                'judul' => 'Fasilitas Desa', 
                'caption' => 'Dokumentasi Fasilitas Umum',
                'url' => asset('storage/media/' . $m->file_name) 
            ];
        }
        // Fallback jika tidak ada gambar
        if (empty($galeriFasilitas)) {
            $galeriFasilitas[] = [
                'judul' => 'Selamat Datang', 
                'caption' => 'Sistem Informasi Fasilitas Desa', 
                'url' => asset('assets/img/hero-bg.jpg')
            ];
        }

        // ==========================================
        // 3. DATA KHUSUS ADMIN (Hanya Dihitung Jika Login)
        // ==========================================
        $adminStats = [];
        $dataBulanan = []; 
        $labelJenis = [];
        $dataJenis = [];

        // Cek Login & Role
        if (Auth::check() && in_array(Auth::user()->role, ['Super Admin', 'Admin', 'Petugas'])) {
            
            // A. Statistik Admin
            $adminStats['booking_pending'] = PeminjamanFasilitas::where('status', 'pending')->count();
            
            // [FIX] Menggunakan PembayaranFasilitas::sum('jumlah')
            $adminStats['total_uang'] = PembayaranFasilitas::sum('jumlah'); 
            
            // B. Data Chart Peminjaman Bulanan
            $peminjamanPerBulan = PeminjamanFasilitas::select(
                                    DB::raw('MONTH(tanggal_mulai) as bulan'), 
                                    DB::raw('count(*) as total')
                                )
                                ->whereYear('tanggal_mulai', date('Y'))
                                ->groupBy('bulan')
                                ->pluck('total', 'bulan')
                                ->toArray();
            
            for ($i = 1; $i <= 12; $i++) {
                $dataBulanan[] = $peminjamanPerBulan[$i] ?? 0;
            }

            // C. Data Chart Komposisi Jenis (Pie Chart)
            $labelJenis = array_keys($jenisStats); 
            $dataJenis  = array_values($jenisStats); 
        }

        // ==========================================
        // 4. RETURN KE VIEW UTAMA
        // ==========================================
        return view('pages.dashboard.index', compact(
            // Data Global
            'totalFasilitas', 
            'peminjamanAktif', 
            'fasilitasTersedia', 
            'totalWarga',
            'fasilitasTerbaru',
            
            // Data Portal/Landing
            'jenisFasilitasUnggulan', 
            'alurPeminjaman', 
            'galeriFasilitas',
            
            // Data Admin (Chart & Stats)
            'adminStats', 
            'dataBulanan',
            'labelJenis',
            'dataJenis'
        ));
    }
}