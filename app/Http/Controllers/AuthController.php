<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function index()
    {
        return view('pages.auth.login-form');
    }

    /**
     * Menampilkan halaman registrasi
     */
    public function showRegisterForm()
    {
        return view('pages.auth.register');
    }

    /**
     * Handle logika form login
     */
    public function login(Request $request)
    {
        // Validasi input email & password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $email = $request->email;
        $password = $request->password;

        // Cari user di database berdasarkan EMAIL
        $user = User::where('email', $email)->first();

        // Check jika user ada dan password cocok dengan Hash::check
        if ($user && Hash::check($password, $user->password)) {
            session(['admin_logged_in' => true]);
            session(['admin_username' => $user->name]);
            session(['admin_email' => $user->email]);
            session(['admin_role' => $user->role]);

            // Redirect ke Dashboard dengan partial view
            return redirect()->route('dashboard')
                ->with('success', 'Selamat Datang ' . $user->name . '!');
        }

        // Kembali ke login dengan error message
        return back()->withErrors([
            'login_error' => 'Email atau password salah!',
        ])->withInput($request->only('email'));
    }

    /**
     * Handle logika form register (CREATE User)
     */
    public function register(Request $request)
    {
        // Validasi custom untuk nama (tidak mengandung angka)
        Validator::extend('no_numbers', function ($attribute, $value, $parameters, $validator) {
            return !preg_match('/[0-9]/', $value);
        });

        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|no_numbers',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
            'confirm_password' => 'required|string|same:password',
        ], [
            'nama.no_numbers' => 'Nama tidak boleh mengandung angka',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.regex' => 'Password harus mengandung huruf kapital dan angka',
            'confirm_password.same' => 'Password dan Confirm Password tidak cocok',
        ]);

        // Cek validasi
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Simpan data ke database (CREATE User)
        try {
            User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('pages.auth.index')
                ->with('success', 'Registrasi berhasil! Silakan Login');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['registration_error' => 'Terjadi kesalahan saat registrasi: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Handle logout
     */
    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_username', 'admin_email', 'admin_role']);
        return redirect()->route('pages.auth.index')
            ->with('success', 'Anda telah logout!');
    }
}

