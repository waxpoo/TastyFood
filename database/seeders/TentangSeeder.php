<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tentang;

class TentangSeeder extends Seeder
{
    public function run()
    {
        Tentang::create([
            'about_text' => 'Isi tentang kami.',
            'vision_text' => 'Visi kami.',
            'mission_text' => 'Misi kami.',
        ]);
    }
}
