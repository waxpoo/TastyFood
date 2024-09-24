<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Galeri extends Model
{
    protected $table = 'galeri'; // Nama tabel yang benar
    protected $fillable = ['gambar']; // Sesuaikan dengan kolom yang ada
}

