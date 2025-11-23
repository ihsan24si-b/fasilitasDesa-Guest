<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // HAPUS DATA DENGAN CARA YANG AMAN (kecuali admin pertama)
        User::where('email', '!=', 'admin@example.com')->delete();

        // User pertama (admin)
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@desa.com',
            'password' => Hash::make('admin213'),
        ]);

        // 100 user tambahan dengan nama Indonesia
        for ($i = 1; $i <= 100; $i++) {
            $jenisKelamin = $faker->randomElement(['male', 'female']);
            $nama = $jenisKelamin === 'male' ? $faker->firstNameMale() : $faker->firstNameFemale();
            $nama .= ' ' . $faker->lastName();

            User::create([
                'name' => $nama,
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password'),
            ]);
        }

        $this->command->info('Seeder User berhasil! Total: ' . User::count() . ' data.');
    }
}
