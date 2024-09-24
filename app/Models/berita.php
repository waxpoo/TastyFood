<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class berita extends Model
{
    use HasFactory;

    protected $table = 'Berita'; // Tentukan nama tabel secara eksplisit

  // app/Models/Berita.php
protected $fillable = ['judul', 'isi', 'gambar'];

}
