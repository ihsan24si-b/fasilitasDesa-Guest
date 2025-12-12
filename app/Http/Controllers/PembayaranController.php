<?php

namespace App\Http\Controllers;

use App\Models\PembayaranFasilitas;
use App\Models\PeminjamanFasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    // List Riwayat Pembayaran
    public function index()
    {
        $pembayaran = PembayaranFasilitas::with('peminjaman.warga', 'peminjaman.fasilitas')
                        ->latest('tgl_bayar')
                        ->paginate(10);

        return view('pages.pembayaran.index', compact('pembayaran'));
    }

    // Form Catat Pembayaran
    public function create()
    {
        // Cari Peminjaman yang:
        // 1. Belum dibayar (doesntHave 'pembayaran')
        // 2. Statusnya BUKAN ditolak/dibatalkan
        // 3. Biayanya > 0 (kalau gratis gak perlu bayar)
        
        $tagihan = PeminjamanFasilitas::doesntHave('pembayaran')
                    ->whereNotIn('status', ['ditolak', 'dibatalkan'])
                    ->where('total_biaya', '>', 0)
                    ->with('warga', 'fasilitas')
                    ->get();

        return view('pages.pembayaran.create', compact('tagihan'));
    }

    // Simpan Data
    public function store(Request $request)
    {
        $request->validate([
            'pinjam_id'  => 'required|exists:peminjaman_fasilitas,pinjam_id|unique:pembayaran_fasilitas,pinjam_id',
            'tgl_bayar'  => 'required|date',
            'jumlah'     => 'required|numeric|min:0',
            'metode'     => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            // 1. Simpan Pembayaran
            PembayaranFasilitas::create([
                'pinjam_id'  => $request->pinjam_id,
                'tgl_bayar'  => $request->tgl_bayar,
                'jumlah'     => $request->jumlah,
                'metode'     => $request->metode,
                'keterangan' => $request->keterangan,
            ]);

            // 2. Update Status Peminjaman jadi 'Disetujui' (Otomatis)
            // Asumsinya kalau sudah bayar berarti deal.
            $peminjaman = PeminjamanFasilitas::find($request->pinjam_id);
            if ($peminjaman->status == 'pending') {
                $peminjaman->update(['status' => 'disetujui']);
            }
        });

        return redirect()->route('pages.pembayaran.index')
            ->with('success', 'Pembayaran berhasil dicatat & Status Peminjaman diupdate!');
    }

    // Hapus (Rollback Pembayaran)
    public function destroy($id)
    {
        $pembayaran = PembayaranFasilitas::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pages.pembayaran.index')->with('success', 'Data pembayaran dihapus.');
    }
}