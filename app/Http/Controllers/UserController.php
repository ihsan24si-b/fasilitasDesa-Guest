<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('auth.index')
                ->with('error', 'Silakan login terlebih dahulu!');
        }

        $data['dataUser'] = User::all();
        return view('user.index', $data);
    }

    public function create()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('auth.index')
                ->with('error', 'Silakan login terlebih dahulu!');
        }

        return view('user.create');
    }

    public function store(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('auth.index')
                ->with('error', 'Silakan login terlebih dahulu!');
        }

        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            // HAPUS VALIDASI ROLE
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // HAPUS ROLE DARI DATA
        ];

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
    }

    public function edit(string $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('auth.index')
                ->with('error', 'Silakan login terlebih dahulu!');
        }

        $data['dataUser'] = User::findOrFail($id);
        return view('user.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('auth.index')
                ->with('error', 'Silakan login terlebih dahulu!');
        }

        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8|confirmed',
            // HAPUS VALIDASI ROLE
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            // HAPUS ROLE DARI DATA UPDATE
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Perubahan Data Berhasil!');
    }

    public function destroy(string $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('auth.index')
                ->with('error', 'Silakan login terlebih dahulu!');
        }

        $user = User::findOrFail($id);

        if ($user->email === session('admin_email')) {
            return redirect()->route('user.index')
                ->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
    }
}
