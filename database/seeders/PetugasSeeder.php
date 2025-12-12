<?php

namespace Database\Seeders;

use App\Models\PetugasFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 1. Ambil ID dari tabel induk (Gunakan PK yang benar: warga_id & fasilitas_id)
        $wargaIds = Warga::pluck('warga_id')->toArray();
        $fasilitasIds = FasilitasUmum::pluck('fasilitas_id')->toArray();

        // Safety check
        if (empty($wargaIds) || empty($fasilitasIds)) {
            $this->command->warn('SKIP: Data Warga atau Fasilitas kosong. Isi dulu seeder lainnya.');
            return;
        }

        // 2. Generate 40 Data Petugas Random
        for ($i = 0; $i < 40; $i++) {
            
            $fasilitasId = $faker->randomElement($fasilitasIds);
            $wargaId = $faker->randomElement($wargaIds);
            $peran = $faker->randomElement(['Penanggung Jawab', 'Operasional', 'Kebersihan', 'Keamanan']);

            // Pakai firstOrCreate agar tidak error duplikat (Satu orang dengan peran sama di tempat sama)
            PetugasFasilitas::firstOrCreate(
                [
                    'fasilitas_id' => $fasilitasId,
                    'warga_id'     => $wargaId,
                    'peran'        => $peran,
                ],
                [
                    // Kalau mau tambah created_at manual bisa disini, tapi default sudah oke
                ]
            );
        }

        $this->command->info('Sukses! 40 Data Petugas berhasil dibuat.');
    }
}