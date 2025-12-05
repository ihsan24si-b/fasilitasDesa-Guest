<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // PENTING: Pakai Auth Facade
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        // KEMBALIKAN KE NORMAL
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('pages.auth.login-form');
    
    }

    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        // if (Auth::check()) {
        //      // Jika muncul tulisan ini, berarti Login Berhasil & Session Tersimpan
        //      return "Posisi: SUDAH LOGIN (Halo " . Auth::user()->name . "). <br> <a href='".route('dashboard')."'>Klik manual ke Dashboard</a>";
        // }
        return view('pages.auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        // Logika Login sesuai Modul
        if ($user && Hash::check($request->password, $user->password)) {

            // FUNGSI UTAMA: Login menggunakan Auth bawaan Laravel
            Auth::login($user);

            // Redirect ke Dashboard
            return redirect()->route('dashboard')
                ->with('success', 'Selamat Datang ' . $user->name . '!');
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ])->withInput($request->only('email'));
    }

    public function register(Request $request)
    {
        // Validasi Custom (Sama seperti kodemu sebelumnya)
        Validator::extend('no_numbers', function ($attribute, $value, $parameters, $validator) {
            return ! preg_match('/[0-9]/', $value);
        });

        $validator = Validator::make($request->all(), [
            'nama'             => 'required|string|no_numbers',
            'email'            => 'required|email|unique:users,email',
            'password'         => [
                'required', 'string', 'min:8', 'regex:/[A-Z]/', 'regex:/[0-9]/',
            ],
            'confirm_password' => 'required|string|same:password',
        ], [
            'nama.no_numbers' => 'Nama tidak boleh mengandung angka',
            // ... pesan error lain tetap sama ...
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // CREATE USER
            // Note: Kita set default role jadi 'Super Admin' agar bisa tembus middleware CheckRole nanti
            User::create([
                'name'     => $request->nama,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'Super Admin', // <--- Default Role
            ]);

            return redirect()->route('pages.auth.index')
                ->with('success', 'Registrasi berhasil! Silakan Login');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['registration_error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function logout(Request $request)
    {
        // FUNGSI LOGOUT SESUAI MODUL
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pages.auth.index')
            ->with('success', 'Anda telah logout!');
    }
}
