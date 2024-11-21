<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara eksplisit jika diperlukan
    protected $table = 'Berita';

    // Tentukan kolom yang dapat diisi
    protected $fillable = ['judul', 'isi', 'gambar'];
}
