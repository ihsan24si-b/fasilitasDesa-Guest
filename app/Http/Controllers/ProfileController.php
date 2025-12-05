<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;    // Wajib untuk ambil data user login
use Illuminate\Support\Facades\Storage; // Wajib untuk kelola file
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Menampilkan profil user yang sedang login
     */
    public function show()
    {
        // LOGIKA BARU:
        // Tidak perlu cek session manual. Middleware 'checkislogin' sudah menjamin user login.

        $user = Auth::user(); // Ambil data user yang sedang login saat ini
        return view('pages.profile.show', compact('user'));
    }

    /**
     * Menampilkan form edit profil
     */
    public function edit()
    {
        $user = Auth::user();
        return view('pages.profile.edit', compact('user'));
    }

    /**
     * Update profil (Foto & Data)
     */
    public function update(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Kita cari ulang instance User berdasarkan ID agar aman saat save()
        // (Kadang Auth::user() hanya mengembalikan object interface)
        $userData = User::findOrFail($user->id);

        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 1. Cek & Hapus foto lama jika ada
        if ($userData->profile_picture && Storage::disk('public')->exists($userData->profile_picture)) {
            Storage::disk('public')->delete($userData->profile_picture);
        }

        // 2. Simpan foto baru
        // Simpan ke folder 'profile_pictures' di dalam disk 'public'
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');

        // 3. Update database
        $userData->profile_picture = $path;
        $userData->save();

        return redirect()->route('pages.profile.show')->with('success', 'Foto profil berhasil diupdate!');
    }

    /**
     * Hapus foto profil
     */
    public function destroy()
    {
        $user = Auth::user();
        $userData = User::findOrFail($user->id);

        // Cek jika ada foto, hapus filenya
        if ($userData->profile_picture && Storage::disk('public')->exists($userData->profile_picture)) {
            Storage::disk('public')->delete($userData->profile_picture);

            // Set kolom di database jadi NULL
            $userData->profile_picture = null;
            $userData->save();
        }

        return redirect()->route('pages.profile.show')->with('success', 'Foto profil berhasil dihapus!');
    }
}
