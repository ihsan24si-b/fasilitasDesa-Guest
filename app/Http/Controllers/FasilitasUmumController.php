<?php

namespace App\Http\Controllers;

use App\Models\FasilitasUmum;
use Illuminate\Http\Request;

class FasilitasUmumController extends Controller
{
    public function index()
    {
        $data['dataFasilitas'] = FasilitasUmum::all();
        return view('fasilitas.index', $data);
    }

    public function create()
    {
        return view('fasilitas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:100',
            'jenis' => 'required|in:aula,lapangan,gedung,taman,lainnya',
            'alamat' => 'required',
            'rt' => 'required|max:3',
            'rw' => 'required|max:3',
            'kapasitas' => 'required|integer|min:1',
            'deskripsi' => 'nullable',
        ], [
            'nama.required' => 'Nama fasilitas wajib diisi',
            'jenis.required' => 'Jenis fasilitas wajib dipilih',
            'alamat.required' => 'Alamat wajib diisi',
            'rt.required' => 'RT wajib diisi',
            'rw.required' => 'RW wajib diisi',
            'kapasitas.required' => 'Kapasitas wajib diisi',
            'kapasitas.integer' => 'Kapasitas harus berupa angka',
            'kapasitas.min' => 'Kapasitas minimal 1',
        ]);

        FasilitasUmum::create($validated);

        return redirect()->route('fasilitas.index')
            ->with('success', 'Data fasilitas berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $data['dataFasilitas'] = FasilitasUmum::findOrFail($id);
        return view('fasilitas.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $fasilitas = FasilitasUmum::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|max:100',
            'jenis' => 'required|in:aula,lapangan,gedung,taman,lainnya',
            'alamat' => 'required',
            'rt' => 'required|max:3',
            'rw' => 'required|max:3',
            'kapasitas' => 'required|integer|min:1',
            'deskripsi' => 'nullable',
        ], [
            'nama.required' => 'Nama fasilitas wajib diisi',
            'jenis.required' => 'Jenis fasilitas wajib dipilih',
            'alamat.required' => 'Alamat wajib diisi',
            'rt.required' => 'RT wajib diisi',
            'rw.required' => 'RW wajib diisi',
            'kapasitas.required' => 'Kapasitas wajib diisi',
            'kapasitas.integer' => 'Kapasitas harus berupa angka',
            'kapasitas.min' => 'Kapasitas minimal 1',
        ]);

        $fasilitas->update($validated);

        return redirect()->route('fasilitas.index')
            ->with('success', 'Data fasilitas berhasil diubah!');
    }

    public function destroy(string $id)
    {
        $fasilitas = FasilitasUmum::findOrFail($id);
        $fasilitas->delete();

        return redirect()->route('fasilitas.index')
            ->with('success', 'Data fasilitas berhasil dihapus!');
    }
}