<?php
namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $filters = $request->only(['jenis_kelamin', 'agama', 'pekerjaan']);
        $perPage = $request->get('perPage', 10);

        $dataWarga = Warga::when($search, function($query) use ($search) {
                return $query->search($search);
            })
            ->when($filters, function($query) use ($filters) {
                return $query->filter($filters);
            })
            ->orderBy('warga_id', 'desc')
            ->paginate($perPage)
            ->appends($request->all());

        return view('pages.warga.index', compact('dataWarga', 'filters', 'search', 'perPage'));
    }

    public function create()
    {
        return view('pages.warga.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_ktp' => 'required|unique:warga|max:16',
            'nama_lengkap' => 'required|max:100',
            'jenis_kelamin' => 'required|in:L,P',  // UBAH: ke L/P
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'pekerjaan' => 'required|max:50',
            'no_telepon' => 'required|max:15',
            'email' => 'required|email|unique:warga',
        ], [
            'no_ktp.required' => 'No KTP wajib diisi',
            'no_ktp.unique' => 'No KTP sudah terdaftar',
            'nama_lengkap.required' => 'Nama wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
        ]);

        Warga::create($validated);

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $data['dataWarga'] = Warga::findOrFail($id);
        return view('pages.warga.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $warga = Warga::findOrFail($id);

        $validated = $request->validate([
            'no_ktp' => 'required|max:16|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama_lengkap' => 'required|max:100',
            'jenis_kelamin' => 'required|in:L,P',  // UBAH: ke L/P
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'pekerjaan' => 'required|max:50',
            'no_telepon' => 'required|max:15',
            'email' => 'required|email|unique:warga,email,' . $id . ',warga_id',
        ]);

        $warga->update($validated);

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil diubah!');
    }

    public function destroy(string $id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus');
    }
}
