<?php

namespace Database\Seeders;

use App\Models\FasilitasUmum;
use App\Models\SyaratFasilitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FasilitasUmumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $jenis = ['aula', 'lapangan', 'gedung', 'taman', 'lainnya'];
        $namaFasilitas = [
            'aula' => ['Aula Serba Guna', 'Aula Kelurahan', 'Aula Pertemuan', 'Balai Warga'],
            'lapangan' => ['Lapangan Bola', 'Lapangan Voli', 'Lapangan Badminton', 'Lapangan Basket'],
            'gedung' => ['Gedung Serbaguna', 'Gedung Olahraga', 'Gedung Pertemuan', 'Gedung Kesenian'],
            'taman' => ['Taman Bermain', 'Taman Kota', 'Taman Rekreasi', 'Taman Hijau'],
            'lainnya' => ['Pos Kamling', 'Kantor RW', 'Perpustakaan', 'Ruang Kesehatan']
        ];

        $syaratContoh = [
            ['Membawa KTP Asli', 'Wajib menunjukkan KTP asli untuk verifikasi'],
            ['Booking Minimal 3 Hari', 'Pemesanan harus dilakukan minimal 3 hari sebelum acara'],
            ['DP 50%', 'Membayar uang muka 50% dari total biaya sewa'],
            ['Surat Izin RT/RW', 'Membawa surat izin dari ketua RT dan RW setempat'],
            ['Membayar Kebersihan', 'Membayar biaya kebersihan sebesar Rp 50.000'],
            ['Mengisi Formulir', 'Mengisi formulir peminjaman yang disediakan'],
        ];

        // HAPUS DATA DENGAN CARA YANG AMAN (bukan truncate)
        SyaratFasilitas::query()->delete(); // Hapus dulu child table
        FasilitasUmum::query()->delete();   // Baru hapus parent table

        for ($i = 1; $i <= 100; $i++) {
            $jenisFasilitas = $faker->randomElement($jenis);
            $nama = $faker->randomElement($namaFasilitas[$jenisFasilitas]) . ' ' . $faker->city();

            $fasilitas = FasilitasUmum::create([
                'nama' => $nama,
                'jenis' => $jenisFasilitas,
                'alamat' => 'Jl. ' . $faker->streetName() . ' No.' . $faker->buildingNumber() . ', ' . $faker->city(),
                'rt' => str_pad($faker->numberBetween(1, 10), 2, '0', STR_PAD_LEFT),
                'rw' => str_pad($faker->numberBetween(1, 5), 2, '0', STR_PAD_LEFT),
                'kapasitas' => $faker->numberBetween(50, 500),
                'deskripsi' => $faker->paragraph(2),
            ]);

            // Tambahkan 2-4 syarat random untuk setiap fasilitas
            $jumlahSyarat = $faker->numberBetween(2, 4);
            $syaratTerpilih = $faker->randomElements($syaratContoh, $jumlahSyarat);

            foreach ($syaratTerpilih as $syarat) {
                SyaratFasilitas::create([
                    'fasilitas_id' => $fasilitas->fasilitas_id,
                    'nama_syarat' => $syarat[0],
                    'deskripsi' => $syarat[1],
                ]);
            }
        }

        $this->command->info('Seeder Fasilitas Umum berhasil! Total: ' . FasilitasUmum::count() . ' data.');
    }
}
