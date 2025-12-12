<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            WargaSeeder::class,
            FasilitasUmumSeeder::class,
            PeminjamanSeeder::class,
            PembayaranSeeder::class,
            
            // --- TAMBAHAN TERAKHIR ---
            PetugasSeeder::class,
        ]);
    }
}