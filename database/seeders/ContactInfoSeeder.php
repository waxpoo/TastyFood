<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactInfo;

class ContactInfoSeeder extends Seeder
{
    public function run()
    {
        ContactInfo::create([
            'email' => 'example@example.com',
            'phone' => '+62 812 3456 7890',
            'location' => 'Kota Bandung, Jawa Barat',
        ]);
    }
}
