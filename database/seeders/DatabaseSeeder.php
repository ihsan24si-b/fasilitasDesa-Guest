<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class, // Sudah mencakup pembuatan admin & user dummy
            WargaSeeder::class,
            FasilitasUmumSeeder::class,
        ]);
    }
}
