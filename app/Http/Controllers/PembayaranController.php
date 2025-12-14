<?php

namespace App\Http\Controllers;

use App\Models\PembayaranFasilitas;
use App\Models\PeminjamanFasilitas;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    // 1. INDEX (Search + Filter + Pagination)
    public function index(Request $request)
    {
        // Ambil parameter filter
        $perPage = $request->get('perPage', 10);
        $search  = $request->get('search');
        $metode  = $request->get('metode');
        $tanggal = $request->get('tanggal');

        // Query Dasar
        $query = PembayaranFasilitas::with(['peminjaman.warga', 'peminjaman.fasilitas', 'media']);

        // 1. Pencarian (Kode Booking atau Nama Warga)
        if ($search) {
            $query->whereHas('peminjaman', function($q) use ($search) {
                $q->where('kode_booking', 'like', "%{$search}%")
                  ->orWhereHas('warga', function($subQ) use ($search) {
                      $subQ->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        // 2. Filter Metode
        if ($metode) {
            $query->where('metode', $metode);
        }

        // 3. Filter Tanggal
        if ($tanggal) {
            $query->whereDate('tgl_bayar', $tanggal);
        }

        // Eksekusi
        $pembayaran = $query->latest('tgl_bayar')
                            ->paginate($perPage)
                            ->withQueryString();

        return view('pages.pembayaran.index', compact('pembayaran', 'perPage'));
    }

    // 2. CREATE (Form Pembayaran)
    public function create()
    {
        // Ambil Booking yang:
        // 1. Belum punya record pembayaran (Lunas)
        // 2. Statusnya AKTIF (bukan ditolak/batal)
        // 3. Biayanya > 0 (Gratis tidak perlu bayar)
        $tagihan = PeminjamanFasilitas::doesntHave('pembayaran')
                    ->whereNotIn('status', ['ditolak', 'dibatalkan'])
                    ->where('total_biaya', '>', 0)
                    ->with(['warga', 'fasilitas'])
                    ->get();

        return view('pages.pembayaran.create', compact('tagihan'));
    }

    // 3. STORE (Simpan Pembayaran)
    public function store(Request $request)
    {
        $request->validate([
            'pinjam_id'  => 'required|exists:peminjaman_fasilitas,pinjam_id|unique:pembayaran_fasilitas,pinjam_id',
            'tgl_bayar'  => 'required|date',
            'jumlah'     => 'required|numeric|min:0',
            'metode'     => 'required|in:Tunai,Transfer',
            'keterangan' => 'nullable|string',
            'resi'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            // A. Simpan Data Pembayaran
            $pembayaran = PembayaranFasilitas::create([
                'pinjam_id'  => $request->pinjam_id,
                'tgl_bayar'  => $request->tgl_bayar,
                'jumlah'     => $request->jumlah,
                'metode'     => $request->metode,
                'keterangan' => $request->keterangan,
            ]);

            // B. Upload Resi (Jika ada)
            if ($request->hasFile('resi')) {
                $file = $request->file('resi');
                $filename = time() . '_' . $file->getClientOriginalName();
                // Upload ke folder 'public/resi_pembayaran'
                $file->storeAs('resi_pembayaran', $filename, 'public');

                Media::create([
                    'ref_table' => 'pembayaran_fasilitas',
                    'ref_id'    => $pembayaran->bayar_id,
                    'file_name' => $filename,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }

            // C. Update Status Peminjaman -> Disetujui
            // (Asumsi: Kalau sudah bayar, berarti approved)
            $peminjaman = PeminjamanFasilitas::find($request->pinjam_id);
            if ($peminjaman->status == 'pending') {
                $peminjaman->update(['status' => 'disetujui']);
            }
        });

        return redirect()->route('pages.pembayaran.index')
            ->with('success', 'Pembayaran berhasil dicatat & Status Booking diupdate!');
    }

    // 4. EDIT
    public function edit($id)
    {
        $pembayaran = PembayaranFasilitas::with('media')->findOrFail($id);

        // Ambil Tagihan: (Yang belum lunas) GABUNG (Punya dia sendiri)
        // Agar saat edit, booking ID dia sendiri tetap muncul di dropdown
        $tagihan = PeminjamanFasilitas::with(['warga', 'fasilitas'])
            ->where(function($query) use ($pembayaran) {
                $query->doesntHave('pembayaran')
                      ->orWhere('pinjam_id', $pembayaran->pinjam_id);
            })
            ->whereNotIn('status', ['ditolak', 'dibatalkan'])
            ->get();

        return view('pages.pembayaran.edit', compact('pembayaran', 'tagihan'));
    }

    // 5. UPDATE
    public function update(Request $request, $id)
    {
        $pembayaran = PembayaranFasilitas::findOrFail($id);

        $request->validate([
            'pinjam_id'  => 'required|exists:peminjaman_fasilitas,pinjam_id|unique:pembayaran_fasilitas,pinjam_id,'.$id.',bayar_id',
            'tgl_bayar'  => 'required|date',
            'jumlah'     => 'required|numeric|min:0',
            'metode'     => 'required|in:Tunai,Transfer',
            'keterangan' => 'nullable|string',
            'resi'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::transaction(function () use ($request, $pembayaran) {
            // A. Update Data
            $pembayaran->update([
                'pinjam_id'  => $request->pinjam_id,
                'tgl_bayar'  => $request->tgl_bayar,
                'jumlah'     => $request->jumlah,
                'metode'     => $request->metode,
                'keterangan' => $request->keterangan,
            ]);

            // B. Update Resi (Jika upload baru)
            if ($request->hasFile('resi')) {
                // Hapus Resi Lama
                if ($pembayaran->media) {
                    if (Storage::disk('public')->exists('resi_pembayaran/' . $pembayaran->media->file_name)) {
                        Storage::disk('public')->delete('resi_pembayaran/' . $pembayaran->media->file_name);
                    }
                    $pembayaran->media->delete();
                }

                // Upload Baru
                $file = $request->file('resi');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('resi_pembayaran', $filename, 'public');

                Media::create([
                    'ref_table' => 'pembayaran_fasilitas',
                    'ref_id'    => $pembayaran->bayar_id,
                    'file_name' => $filename,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        });

        return redirect()->route('pages.pembayaran.index')->with('success', 'Data pembayaran berhasil diperbarui.');
    }

    // 6. DESTROY
    public function destroy($id)
    {
        $pembayaran = PembayaranFasilitas::findOrFail($id);
        
        // Hapus Resi Fisik
        if ($pembayaran->media) {
            if (Storage::disk('public')->exists('resi_pembayaran/' . $pembayaran->media->file_name)) {
                Storage::disk('public')->delete('resi_pembayaran/' . $pembayaran->media->file_name);
            }
            $pembayaran->media->delete();
        }

        $pembayaran->delete();
        return redirect()->route('pages.pembayaran.index')->with('success', 'Data pembayaran dihapus.');
    }
}