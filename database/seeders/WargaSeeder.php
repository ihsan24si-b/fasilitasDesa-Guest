<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warga;

class WargaSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        // Generate 15 warga random DENGAN BATAS PANJANG
        foreach (range(1, 15) as $index) {
            Warga::create([
                'no_ktp' => $faker->unique()->numerify('32##############'), // 16 digit
                'nama' => $faker->firstName . ' ' . $faker->lastName, // Nama lebih pendek
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
                'pekerjaan' => $faker->randomElement(['PNS', 'Wirausaha', 'Karyawan', 'Petani', 'IRT', 'Guru', 'Dokter']),
                'telp' => $faker->numerify('08##########'), // Maksimal 12 karakter
                'email' => $faker->userName . '@desa.id', // Email lebih pendek
            ]);
        }

        // Data khusus untuk demo
        Warga::create([
            'no_ktp' => '3273010101010001',
            'nama' => 'Budi Santoso',
            'jenis_kelamin' => 'Laki-laki',
            'agama' => 'Islam',
            'pekerjaan' => 'PNS',
            'telp' => '08123456789',
            'email' => 'budi@desa.id',
        ]);
    }
}
