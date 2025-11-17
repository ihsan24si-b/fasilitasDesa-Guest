<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            FirstUserSeeder::class,
            UserSeeder::class,
            WargaSeeder::class,
            FasilitasUmumSeeder::class,
        ]);
    }
}

