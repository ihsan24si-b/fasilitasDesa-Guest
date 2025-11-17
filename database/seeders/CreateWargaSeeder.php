<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\warga;

class CreateWargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('warga')->insert([
            [
                'no_ktp' => '1234567890',
                'nama_lengkap' => 'Budi Santoso',
                'jenis_kelamin' => 'L',
                'agama' => 'Islam',
                'pekerjaan' => 'Karyawan',
                'no_telepon' => '08123456789',
                'email' => 'budi@mail.com',
                'fasilitas_id' => 1 // relasi
            ],
        ]);
    }
}
