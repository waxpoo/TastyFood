<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormKontak extends Model
{
    use HasFactory;

    protected $table = 'form_kontak'; // Menentukan nama tabel

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'subject', // Subjek
        'name',    // Nama
        'email',   // Email
        'message', // Pesan
    ];
}
