<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    // Menampilkan daftar peminjaman
    public function index()
    {
        // Ambil data dengan relasi agar tidak N+1 Query
        $peminjaman = PeminjamanFasilitas::with(['fasilitas', 'warga'])
                        ->latest('created_at') // Urutkan dari yang terbaru
                        ->paginate(10);

        return view('pages.peminjaman.index', compact('peminjaman'));
    }

    // Form Tambah Peminjaman
    public function create()
    {
        // Kita butuh data Warga dan Fasilitas untuk Dropdown Select
        $warga = Warga::all();
        $fasilitas = FasilitasUmum::all();

        return view('pages.peminjaman.create', compact('warga', 'fasilitas'));
    }

    // Proses Simpan Data
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'warga_id'        => 'required|exists:warga,id',
            'fasilitas_id'    => 'required|exists:fasilitas_umum,fasilitas_id',
            'tanggal_mulai'   => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tujuan'          => 'required|string',
            'total_biaya'     => 'required|numeric|min:0',
            'bukti_bayar'     => 'nullable|image|max:2048', // Opsional, maks 2MB
        ]);

        // 2. CEK BENTROK JADWAL (Logic Inti)
        // Cari peminjaman lain di fasilitas yang sama, yang tanggalnya bertabrakan
        // Dan statusnya BUKAN ditolak/dibatalkan
        $bentrok = PeminjamanFasilitas::where('fasilitas_id', $request->fasilitas_id)
            ->where('status', '!=', 'ditolak')
            ->where('status', '!=', 'dibatalkan')
            ->where(function ($query) use ($request) {
                $query->whereBetween('tanggal_mulai', [$request->tanggal_mulai, $request->tanggal_selesai])
                      ->orWhereBetween('tanggal_selesai', [$request->tanggal_mulai, $request->tanggal_selesai])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('tanggal_mulai', '<=', $request->tanggal_mulai)
                            ->where('tanggal_selesai', '>=', $request->tanggal_selesai);
                      });
            })
            ->exists();

        if ($bentrok) {
            return back()->with('error', 'Gagal! Fasilitas sudah dipesan pada tanggal tersebut.')->withInput();
        }

        // 3. Generate Kode Booking Unik (PJ + Timestamp + Random)
        $kodeBooking = 'PJ-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        // Gunakan Transaction agar data konsisten (jika upload gagal, data tidak tersimpan)
        DB::transaction(function () use ($request, $kodeBooking) {
            
            // Simpan Data Peminjaman
            $peminjaman = PeminjamanFasilitas::create([
                'fasilitas_id'    => $request->fasilitas_id,
                'warga_id'        => $request->warga_id,
                'kode_booking'    => $kodeBooking,
                'tanggal_mulai'   => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'tujuan'          => $request->tujuan,
                'total_biaya'     => $request->total_biaya,
                'status'          => 'pending', // Default pending menunggu konfirmasi admin
            ]);

            // 4. Handle Upload Bukti Bayar (Jika ada)
            if ($request->hasFile('bukti_bayar')) {
                $file = $request->file('bukti_bayar');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('bukti_bayar', $filename, 'public'); // Simpan di storage/app/public/bukti_bayar

                // Simpan ke tabel Media
                Media::create([
                    'ref_table' => 'peminjaman_fasilitas',
                    'ref_id'    => $peminjaman->pinjam_id,
                    'file_name' => $filename,
                    'file_path' => $path,
                    'file_type' => 'image', // Bisa disesuaikan
                ]);
            }
        });

        return redirect()->route('pages.peminjaman.index')->with('success', 'Peminjaman berhasil dibuat!');
    }

    // Detail Peminjaman
    public function show($id)
    {
        $peminjaman = PeminjamanFasilitas::with(['fasilitas', 'warga', 'media'])->findOrFail($id);
        return view('pages.peminjaman.show', compact('peminjaman'));
    }

    // Update Status (Contoh: Approve/Reject)
    public function updateStatus(Request $request, $id)
    {
        $peminjaman = PeminjamanFasilitas::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak,selesai,dibatalkan'
        ]);

        $peminjaman->update(['status' => $request->status]);

        return back()->with('success', 'Status peminjaman diperbarui.');
    }

    // Hapus Peminjaman
    public function destroy($id)
    {
        $peminjaman = PeminjamanFasilitas::findOrFail($id);
        
        // Hapus media terkait dulu (opsional, bisa pakai observer, tapi manual juga oke)
        // ... Logika hapus file fisik media bisa ditambahkan disini ...

        $peminjaman->delete();
        return redirect()->route('pages.peminjaman.index')->with('success', 'Data peminjaman dihapus.');
    }
}