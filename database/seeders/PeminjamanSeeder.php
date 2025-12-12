<?php

namespace Database\Seeders;

use App\Models\PeminjamanFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // --- PERBAIKAN DI SINI ---
        // Kita harus mengambil kolom Primary Key yang SESUAI dengan database
        // Warga PK = 'warga_id'
        // Fasilitas PK = 'fasilitas_id'
        
        $listWarga = Warga::pluck('warga_id')->toArray(); 
        $listFasilitas = FasilitasUmum::pluck('fasilitas_id')->toArray();

        // Cek apakah data induk tersedia
        if (empty($listWarga) || empty($listFasilitas)) {
            $this->command->error('Error: Tabel Warga atau Fasilitas Umum masih kosong. Harap seed tabel tersebut dahulu.');
            return;
        }

        // Generate 50 Data Dummy
        for ($i = 0; $i < 50; $i++) {
            
            // Random Tanggal
            $tglMulai = $faker->dateTimeBetween('-2 months', '+1 month');
            $durasi = rand(0, 2); 
            $tglSelesai = (clone $tglMulai)->modify("+$durasi days");

            $status = $faker->randomElement(['pending', 'disetujui', 'ditolak', 'selesai', 'dibatalkan']);
            $biaya = $faker->randomElement([0, 50000, 100000, 150000, 250000, 500000]);
            
            // Kode Booking
            $kode = 'PJ-' . $tglMulai->format('Ymd') . '-' . strtoupper(Str::random(4));

            PeminjamanFasilitas::create([
                'fasilitas_id'    => $faker->randomElement($listFasilitas),
                'warga_id'        => $faker->randomElement($listWarga),
                'kode_booking'    => $kode,
                'tanggal_mulai'   => $tglMulai,
                'tanggal_selesai' => $tglSelesai,
                'tujuan'          => $faker->randomElement([
                    'Rapat Koordinasi RT/RW', 
                    'Resepsi Pernikahan', 
                    'Turnamen Bulutangkis', 
                    'Pengajian Rutin', 
                    'Senam Pagi Bersama', 
                    'Posyandu Balita'
                ]),
                'status'          => $status,
                'total_biaya'     => $biaya,
            ]);
        }

        $this->command->info('Sukses! 50 Data Peminjaman berhasil dibuat.');
    }
}