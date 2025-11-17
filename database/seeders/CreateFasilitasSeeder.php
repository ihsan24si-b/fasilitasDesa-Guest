<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateFasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fasilitas_umum')->insert([
            [
                'nama_fasilitas' => 'Balai RW',
                'jenis_fasilitas' => 'Umum',
                'rt' => 1,
                'rw' => 2,
                'kapasitas' => 50,
                'alamat' => 'Jl Melati No. 10',
                'deskripsi' => 'Balai serbaguna'
            ],
        ]);
    }
}
