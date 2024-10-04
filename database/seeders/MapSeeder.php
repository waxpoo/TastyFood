<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Map;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Map::create([
            'latitude' => '-6.9123', // Ganti dengan koordinat yang sesuai
            'longitude' => '107.6293' // Ganti dengan koordinat yang sesuai
        ]);
    }
}
