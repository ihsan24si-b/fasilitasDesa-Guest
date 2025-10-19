<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function index()
    {
        return view('admin.login-form'); // PERBAIKI: 'admin.login-form' bukan 'admin.login-from'
    }

    /**
     * Menampilkan halaman registrasi
     */
    public function showRegisterForm()
    {
        return view('admin.register');
    }

    /**
     * Handle logika form login
     */
    public function login(Request$request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->username;
        $password = $request->password;

        // Untuk testing, terima semua kombinasi username/password yang sama
        if ($username === $password) {
            session(['admin_logged_in' => true]);
            session(['admin_username' => $username]);

            return redirect()->route('dashboard')
                ->with('success', 'Selamat Datang Admin!');
        }

        // Atau kredensial khusus
        if (($username === 'nim' && $password === 'nim') ||
            ($username === 'admin' && $password === 'admin') ||
            ($username === 'test' && $password === 'test')) {
            session(['admin_logged_in' => true]);
            session(['admin_username' => $username]);

            return redirect()->route('dashboard')
                ->with('success', 'Selamat Datang Admin!');
        }

        return back()->withErrors([
            'login_error' => 'Username atau password salah!',
        ]);
    }

    /**
     * Handle logika form register
     */
    public function register(Request $request)
    {
        // Validasi custom untuk nama (tidak mengandung angka)
        Validator::extend('no_numbers', function ($attribute, $value, $parameters, $validator) {
            return ! preg_match('/[0-9]/', $value);
        });

        // Validasi data - HAPUS 'unique:users,username'
        $validator = Validator::make($request->all(), [
            'nama'             => 'required|string|no_numbers',
            'alamat'           => 'required|string|max:300',
            'tanggal_lahir'    => 'required|date',
            'username'         => 'required|string', // HAPUS unique:users,username
            'password'         => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
            'confirm_password' => 'required|string|same:password',
        ], [
            'nama.no_numbers'       => 'Nama tidak boleh mengandung angka',
            'password.regex'        => 'Password harus mengandung huruf kapital dan angka',
            'confirm_password.same' => 'Password dan Confirm Password tidak cocok',
        ]);

        // Cek validasi
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('auth.index')
            ->with('success', 'Registrasi berhasil! Silakan Login');
    }

    /**
     * Handle logout
     */
    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_username']);
        return redirect()->route('auth.index')
            ->with('success', 'Anda telah logout!');
    }

}
