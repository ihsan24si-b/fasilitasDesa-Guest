<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FirstUserSeeder extends Seeder
{
    public function run()
    {
        // Cek apakah email sudah ada untuk mencegah duplikasi
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            User::create([
                'name'     => 'Admin Desa 1',
                'email'    => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role'     => 'Super Admin', // <--- INI KUNCINYA (Hanya Seeder yang boleh set ini)
            ]);
        }
    }
}