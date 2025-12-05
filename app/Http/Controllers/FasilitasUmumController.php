<?php

namespace App\Http\Controllers;

use App\Models\FasilitasUmum;
use App\Models\SyaratFasilitas;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasUmumController extends Controller
{
    public function index(Request $request)
    {
        $search  = $request->get('search');
        $filters = $request->only(['jenis', 'rt', 'rw']);
        $perPage = $request->get('perPage', 10);

        $dataFasilitas = FasilitasUmum::with(['syaratFasilitas', 'media'])
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
            'nama'             => 'required|max:100',
            'jenis'            => 'required|in:aula,lapangan,gedung,taman,lainnya',
            'alamat'           => 'required',
            'rt'               => 'required|max:3',
            'rw'               => 'required|max:3',
            'kapasitas'        => 'required|integer|min:1',
            'deskripsi'        => 'nullable',
            'syarat_nama'      => 'sometimes|array',
            'syarat_nama.*'    => 'required|string|max:200',
            'syarat_deskripsi' => 'sometimes|array',
            'photos'           => 'sometimes|array',
            'photos.*'         => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 1. Simpan Data Fasilitas
        $fasilitas = FasilitasUmum::create($validated);

        // 2. Simpan Syarat
        if ($request->has('syarat_nama')) {
            foreach ($request->syarat_nama as $index => $namaSyarat) {
                SyaratFasilitas::create([
                    'fasilitas_id' => $fasilitas->fasilitas_id,
                    'nama_syarat'  => $namaSyarat,
                    'deskripsi'    => $request->syarat_deskripsi[$index] ?? null,
                ]);
            }
        }

        // 3. Upload Foto (KE DISK PUBLIC)
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                // Simpan ke disk 'public' di folder 'media'
                $path = $photo->store('media', 'public');
                $filename = basename($path);

                Media::create([
                    'ref_table'  => 'fasilitas_umum',
                    'ref_id'     => $fasilitas->fasilitas_id,
                    'file_name'  => $filename,
                    'mime_type'  => $photo->getClientMimeType(),
                    'sort_order' => 0,
                ]);
            }
        }

        return redirect()->route('pages.fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $data['fasilitas'] = FasilitasUmum::with(['syaratFasilitas', 'media'])->findOrFail($id);
        return view('pages.fasilitas.show', $data);
    }

    public function edit(string $id)
    {
        $data['dataFasilitas'] = FasilitasUmum::with(['syaratFasilitas', 'media'])->findOrFail($id);
        return view('pages.fasilitas.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $fasilitas = FasilitasUmum::findOrFail($id);

        $validated = $request->validate([
            'nama'             => 'required|max:100',
            'jenis'            => 'required|in:aula,lapangan,gedung,taman,lainnya',
            'alamat'           => 'required',
            'rt'               => 'required|max:3',
            'rw'               => 'required|max:3',
            'kapasitas'        => 'required|integer|min:1',
            'deskripsi'        => 'nullable',
            'syarat_nama'      => 'sometimes|array',
            'syarat_nama.*'    => 'required|string|max:200',
            'syarat_deskripsi' => 'sometimes|array',
            'photos'           => 'sometimes|array',
            'photos.*'         => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_photos'    => 'sometimes|array'
        ]);

        // 1. Update Data Utama
        $fasilitas->update($validated);

        // 2. Update Syarat
        if ($request->has('syarat_nama')) {
            $fasilitas->syaratFasilitas()->delete();
            foreach ($request->syarat_nama as $index => $namaSyarat) {
                SyaratFasilitas::create([
                    'fasilitas_id' => $fasilitas->fasilitas_id,
                    'nama_syarat'  => $namaSyarat,
                    'deskripsi'    => $request->syarat_deskripsi[$index] ?? null,
                ]);
            }
        }

        // 3. Hapus Foto (DARI DISK PUBLIC)
        if ($request->has('delete_photos')) {
            foreach ($request->delete_photos as $mediaId) {
                $media = Media::find($mediaId);
                if ($media) {
                    // Gunakan disk('public') agar sama dengan saat upload
                    Storage::disk('public')->delete('media/' . $media->file_name);
                    $media->delete();
                }
            }
        }

        // 4. Upload Foto Baru (KE DISK PUBLIC)
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('media', 'public');
                $filename = basename($path);

                Media::create([
                    'ref_table'  => 'fasilitas_umum',
                    'ref_id'     => $fasilitas->fasilitas_id,
                    'file_name'  => $filename,
                    'mime_type'  => $photo->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('pages.fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $fasilitas = FasilitasUmum::findOrFail($id);

        // 1. Ambil semua media
        $medias = Media::where('ref_table', 'fasilitas_umum')
                        ->where('ref_id', $id)
                        ->get();

        // 2. Hapus fisik & record (DARI DISK PUBLIC)
        foreach ($medias as $media) {
            Storage::disk('public')->delete('media/' . $media->file_name);
            $media->delete();
        }

        // 3. Hapus Fasilitas
        $fasilitas->delete();

        return redirect()->route('pages.fasilitas.index')
            ->with('success', 'Fasilitas dan semua fotonya berhasil dihapus!');
    }
}
