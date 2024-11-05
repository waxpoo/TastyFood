<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormKontakTable extends Migration
{
    public function up()
    {
        Schema::create('form_kontak', function (Blueprint $table) {
            $table->id(); // Kolom ID
            $table->string('subject'); // Kolom untuk subjek
            $table->string('name'); // Kolom untuk nama
            $table->string('email'); // Kolom untuk email
            $table->text('message'); // Kolom untuk pesan
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_kontak'); // Menghapus tabel jika dibutuhkan
    }
}
