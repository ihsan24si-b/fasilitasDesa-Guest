<?php

namespace Database\Seeders;

use App\Models\Warga;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class WargaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        $pekerjaan = ['PNS', 'Wiraswasta', 'Petani', 'Guru', 'Dokter', 'Perawat', 'Karyawan Swasta', 'Mahasiswa', 'Pelajar', 'Ibu Rumah Tangga', 'Buruh', 'Pengusaha', 'Seniman', 'Pensiunan'];

        // Reset Data
        Warga::query()->delete();

        // Loop jadi 100 kali
        for ($i = 1; $i <= 100; $i++) {
            $jenisKelamin = $faker->randomElement(['Laki-laki', 'Perempuan']);
            $nama = $jenisKelamin === 'Laki-laki' ? $faker->firstNameMale() : $faker->firstNameFemale();
            $nama .= ' ' . $faker->lastName();

            // NIK 16 digit & Telp unik
            $nik = '32' . str_pad($faker->unique()->numberBetween(10000000000000, 99999999999999), 14, '0', STR_PAD_LEFT);
            $telp = '08' . $faker->unique()->numerify('##########');

            Warga::create([
                'no_ktp' => $nik,
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
