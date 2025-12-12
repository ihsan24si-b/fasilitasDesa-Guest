<?php

namespace App\Http\Controllers;

use App\Models\PetugasFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    // List Semua Petugas
    public function index()
    {
        $petugas = PetugasFasilitas::with(['fasilitas', 'warga'])
                    ->latest()
                    ->paginate(10);

        return view('pages.petugas.index', compact('petugas'));
    }

    // Form Tambah Petugas
    public function create()
    {
        $fasilitas = FasilitasUmum::all();
        $warga = Warga::all();
        
        return view('pages.petugas.create', compact('fasilitas', 'warga'));
    }

    // Simpan Data
    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'warga_id'     => 'required|exists:warga,warga_id',
            'peran'        => 'required|in:Penanggung Jawab,Operasional,Kebersihan,Keamanan',
        ]);

        // Cek Duplikasi (Opsional): Apakah warga ini sudah jadi petugas dengan peran SAMA di fasilitas SAMA?
        $exists = PetugasFasilitas::where('fasilitas_id', $request->fasilitas_id)
                    ->where('warga_id', $request->warga_id)
                    ->where('peran', $request->peran)
                    ->exists();

        if ($exists) {
            return back()->with('error', 'Warga ini sudah terdaftar dengan peran tersebut di fasilitas ini.');
        }

        PetugasFasilitas::create($request->all());

        return redirect()->route('pages.petugas.index')->with('success', 'Petugas berhasil ditambahkan.');
    }

    // Hapus Petugas
    public function destroy($id)
    {
        $petugas = PetugasFasilitas::findOrFail($id);
        $petugas->delete();

        return redirect()->route('pages.petugas.index')->with('success', 'Data petugas dihapus.');
    }
}