<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        // Data admin tetap
        User::create([
            'name' => 'Admin Desa',
            'email' => 'admin@desa.id',
            'password' => Hash::make('password123'),
        ]);

        // Generate 10 user random DENGAN BATAS PANJANG
        foreach (range(1, 10) as $index) {
            User::create([
                'name' => $faker->firstName . ' ' . $faker->lastName, // Nama lebih pendek
                'email' => $faker->userName . '@desa.id', // Email lebih pendek
                'password' => Hash::make('password123'),
            ]);
        }
    }
}
