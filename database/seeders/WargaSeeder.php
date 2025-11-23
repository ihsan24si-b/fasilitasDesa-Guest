<?php

namespace Database\Seeders;

use App\Models\Warga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        $pekerjaan = ['PNS', 'Wiraswasta', 'Petani', 'Guru', 'Dokter', 'Perawat', 'Karyawan Swasta', 'Mahasiswa', 'Pelajar', 'Ibu Rumah Tangga', 'Buruh', 'Pengusaha', 'Seniman', 'Pensiunan'];

        // HAPUS DATA DENGAN CARA YANG AMAN
        Warga::query()->delete();

        for ($i = 1; $i <= 100; $i++) {
            $jenisKelamin = $faker->randomElement(['Laki-laki', 'Perempuan']);
            $nama = $jenisKelamin === 'Laki-laki' ? $faker->firstNameMale() : $faker->firstNameFemale();
            $nama .= ' ' . $faker->lastName();

            // Generate telepon yang pasti sesuai (12 digit)
            $telp = '08' . str_pad($i, 10, '0', STR_PAD_LEFT);

            Warga::create([
                'no_ktp' => '32' . str_pad($i, 14, '0', STR_PAD_LEFT), // 16 digit
                'nama' => $nama,
                'jenis_kelamin' => $jenisKelamin,
                'agama' => $faker->randomElement($agama),
                'pekerjaan' => $faker->randomElement($pekerjaan),
                'telp' => $telp,
                'email' => $faker->unique()->safeEmail(),
            ]);
        }

        $this->command->info('Seeder Warga berhasil! Total: ' . Warga::count() . ' data.');
    }
}
