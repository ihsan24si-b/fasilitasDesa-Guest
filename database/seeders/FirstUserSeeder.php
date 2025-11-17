<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FirstUserSeeder extends Seeder  // UBAH JADI FirstUserSeeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Desa 1',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
    }
}
