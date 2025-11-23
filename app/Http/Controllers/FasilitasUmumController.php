<?php
namespace App\Http\Controllers;

use App\Models\FasilitasUmum;
use App\Models\SyaratFasilitas;
use Illuminate\Http\Request;

class FasilitasUmumController extends Controller
{
    public function index(Request $request)
    {
        $search  = $request->get('search');
        $filters = $request->only(['jenis', 'rt', 'rw']);
        $perPage = $request->get('perPage', 10); // Default 10

        $dataFasilitas = FasilitasUmum::with('syaratFasilitas')
            ->when($search, function ($query) use ($search) {
                return $query->search($search);
            })
            ->when($filters, function ($query) use ($filters) {
                return $query->filter($filters);
            })
            ->orderBy('fasilitas_id', 'desc')
            ->paginate($perPage)
            ->appends($request->all());

        return view('pages.fasilitas.index', compact('dataFasilitas', 'filters', 'search', 'perPage'));
    }
    public function create()
    {
        return view('pages.fasilitas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'               => 'required|max:100',
            'jenis'              => 'required|in:aula,lapangan,gedung,taman,lainnya',
            'alamat'             => 'required',
            'rt'                 => 'required|max:3',
            'rw'                 => 'required|max:3',
            'kapasitas'          => 'required|integer|min:1',
            'deskripsi'          => 'nullable',
            'syarat_nama'        => 'sometimes|array',
            'syarat_nama.*'      => 'required|string|max:200',
            'syarat_deskripsi'   => 'sometimes|array',
            'syarat_deskripsi.*' => 'nullable|string',
        ]);

        // Create fasilitas
        $fasilitas = FasilitasUmum::create($validated);

        // Create syarat-syarat jika ada
        if ($request->has('syarat_nama')) {
            foreach ($request->syarat_nama as $index => $namaSyarat) {
                SyaratFasilitas::create([
                    'fasilitas_id' => $fasilitas->fasilitas_id,
                    'nama_syarat'  => $namaSyarat,
                    'deskripsi'    => $request->syarat_deskripsi[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('pages.fasilitas.index')
            ->with('success', 'Data fasilitas beserta syarat berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $data['fasilitas'] = FasilitasUmum::with('syaratFasilitas')->findOrFail($id);
        return view('pages.fasilitas.show', $data);
    }

    public function edit(string $id)
    {
        $data['dataFasilitas'] = FasilitasUmum::with('syaratFasilitas')->findOrFail($id);
        return view('pages.fasilitas.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $fasilitas = FasilitasUmum::findOrFail($id);

        $validated = $request->validate([
            'nama'               => 'required|max:100',
            'jenis'              => 'required|in:aula,lapangan,gedung,taman,lainnya',
            'alamat'             => 'required',
            'rt'                 => 'required|max:3',
            'rw'                 => 'required|max:3',
            'kapasitas'          => 'required|integer|min:1',
            'deskripsi'          => 'nullable',
            'syarat_nama'        => 'sometimes|array',
            'syarat_nama.*'      => 'required|string|max:200',
            'syarat_deskripsi'   => 'sometimes|array',
            'syarat_deskripsi.*' => 'nullable|string',
        ]);

        // Update fasilitas
        $fasilitas->update($validated);

        // Hapus syarat lama dan buat yang baru
        if ($request->has('syarat_nama')) {
            // Hapus syarat lama
            $fasilitas->syaratFasilitas()->delete();

            // Buat syarat baru
            foreach ($request->syarat_nama as $index => $namaSyarat) {
                SyaratFasilitas::create([
                    'fasilitas_id' => $fasilitas->fasilitas_id,
                    'nama_syarat'  => $namaSyarat,
                    'deskripsi'    => $request->syarat_deskripsi[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('pages.fasilitas.index')
            ->with('success', 'Data fasilitas beserta syarat berhasil diubah!');
    }

    public function destroy(string $id)
    {
        $fasilitas = FasilitasUmum::findOrFail($id);
        $fasilitas->delete(); // Syarat akan terhapus otomatis karena cascade

        return redirect()->route('pages.fasilitas.index')
            ->with('success', 'Data fasilitas beserta syarat berhasil dihapus!');
    }
}
