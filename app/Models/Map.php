<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak mengikuti konvensi penamaan
    protected $table = 'maps';

    // Tentukan kolom yang dapat diisi (fillable)
    protected $fillable = [
        'latitude',
        'longitude',
    ];

    // Jika Anda menggunakan timestamps, bisa ditambahkan ini
    public $timestamps = false; // jika tidak menggunakan timestamps
}
