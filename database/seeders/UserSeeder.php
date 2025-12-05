<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // ==========================================
        // 1. AKUN UTAMA (Super Admin) - Punya Kamu
        // ==========================================
        // Kita pakai firstOrCreate biar kalau dijalankan manual gak error duplikat
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // Cek email ini
            [
                'name' => 'Admin Desa 1',
                'password' => Hash::make('admin123'),
                'role' => 'Super Admin',
            ]
        );

        // ==========================================
        // 2. AKUN CADANGAN (Super Admin)
        // ==========================================
        User::firstOrCreate(
            ['email' => 'super@admin.com'],
            [
                'name' => 'Super Admin Desa',
                'password' => Hash::make('password'),
                'role' => 'Super Admin',
            ]
        );

        // ==========================================
        // 3. AKUN ADMIN BIASA
        // ==========================================
        User::firstOrCreate(
            ['email' => 'admin@desa.com'],
            [
                'name' => 'Pak Sekretaris',
                'password' => Hash::make('password'),
                'role' => 'Admin',
            ]
        );

        // ==========================================
        // 4. DATA DUMMY (100 Warga)
        // ==========================================
        for ($i = 1; $i <= 100; $i++) {
            $jenisKelamin = $faker->randomElement(['male', 'female']);
            $nama = $jenisKelamin === 'male' ? $faker->firstNameMale() : $faker->firstNameFemale();
            $nama .= ' ' . $faker->lastName();

            // Generate email unik random
            $emailRandom = $faker->unique()->userName . '@example.com';

            User::create([
                'name' => $nama,
                'email' => $emailRandom,
                'password' => Hash::make('password'),
                'role' => 'User',
            ]);
        }

        $this->command->info('Seeder User berhasil! Total user sekarang: ' . User::count());
    }
}
