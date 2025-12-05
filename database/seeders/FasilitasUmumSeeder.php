<?php

namespace Database\Seeders;

use App\Models\FasilitasUmum;
use App\Models\SyaratFasilitas;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FasilitasUmumSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $jenis = ['aula', 'lapangan', 'gedung', 'taman', 'lainnya'];

        $syaratContoh = [
            ['Membawa KTP Asli', 'Wajib menunjukkan KTP asli untuk verifikasi'],
            ['Booking Minimal 3 Hari', 'Pemesanan harus dilakukan minimal 3 hari sebelum acara'],
            ['DP 50%', 'Membayar uang muka 50% dari total biaya sewa'],
            ['Surat Izin RT/RW', 'Membawa surat izin dari ketua RT dan RW setempat'],
            ['Membayar Kebersihan', 'Membayar biaya kebersihan sebesar Rp 50.000'],
            ['Mengisi Formulir', 'Mengisi formulir peminjaman yang disediakan'],
        ];

        SyaratFasilitas::query()->delete();
        FasilitasUmum::query()->delete();

        // Loop jadi 100 kali
        for ($i = 1; $i <= 100; $i++) {
            $jenisFasilitas = $faker->randomElement($jenis);

            $fasilitas = FasilitasUmum::create([
                'nama' => ucfirst($jenisFasilitas) . ' ' . $faker->streetName . ' ' . $faker->city,
                'jenis' => $jenisFasilitas,
                'alamat' => $faker->address,
                'rt' => str_pad($faker->numberBetween(1, 10), 2, '0', STR_PAD_LEFT),
                'rw' => str_pad($faker->numberBetween(1, 5), 2, '0', STR_PAD_LEFT),
                'kapasitas' => $faker->numberBetween(50, 1000),
                'deskripsi' => $faker->paragraph(2),
            ]);

            // Tambah syarat random
            $syaratTerpilih = $faker->randomElements($syaratContoh, $faker->numberBetween(1, 3));
            foreach ($syaratTerpilih as $syarat) {
                SyaratFasilitas::create([
                    'fasilitas_id' => $fasilitas->fasilitas_id,
                    'nama_syarat' => $syarat[0],
                    'deskripsi' => $syarat[1],
                ]);
            }
        }

        $this->command->info('Seeder Fasilitas berhasil! Total: ' . FasilitasUmum::count() . ' data.');
    }
}
