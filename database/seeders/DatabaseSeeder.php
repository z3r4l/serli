<?php

namespace Database\Seeders;

use App\Models\UangHarianDalam;
use App\Models\UangHarianLuar;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            DasarPeraturanTableSeeder::class,
            TransportasiToBandaraSeeder::class,
            TransportasiToTerminalSeeder::class,
            BiayaHotelSeeder::class,
            UangHarianLuarSeeder::class,
            UangHarianDalamSeeder::class,
            BiayaRepresentasiSeeder::class,
            KepalaDinasSeeder::class,
            TipeUserSeeder::class
        ]);
    }
}
