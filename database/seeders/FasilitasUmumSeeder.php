<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FasilitasUmum;
use App\Models\SyaratFasilitas;

class FasilitasUmumSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        // Generate 8 fasilitas random DENGAN BATAS PANJANG
        foreach (range(1, 8) as $index) {
            $fasilitas = FasilitasUmum::create([
                'nama' => $faker->randomElement(['Aula', 'Lapangan', 'Gedung', 'Taman']) . ' ' . $faker->firstName,
                'jenis' => $faker->randomElement(['aula', 'lapangan', 'gedung', 'taman']),
                'alamat' => 'Jl. ' . $faker->streetName, // Alamat lebih pendek
                'rt' => $faker->numerify('0#'),
                'rw' => $faker->numerify('0#'),
                'kapasitas' => $faker->numberBetween(20, 100),
                'deskripsi' => $faker->sentence(3), // Deskripsi lebih pendek
            ]);

            // Generate 2-3 syarat untuk setiap fasilitas
            foreach (range(1, $faker->numberBetween(2, 3)) as $syaratIndex) {
                SyaratFasilitas::create([
                    'fasilitas_id' => $fasilitas->fasilitas_id,
                    'nama_syarat' => $faker->randomElement([
                        'Bawa KTP',
                        'Bayar Deposit',
                        'Bersihkan',
                        'Surat Permohonan',
                        'Booking 7 Hari'
                    ]), // Syarat lebih pendek
                    'deskripsi' => $faker->sentence(2), // Deskripsi lebih pendek
                ]);
            }
        }
    }
}
