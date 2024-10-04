<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    use HasFactory;

    protected $table = 'tentang'; // nama tabel
    protected $fillable = [
        'about_text',
        'vision_text',
        'mission_text',
    ];
}
