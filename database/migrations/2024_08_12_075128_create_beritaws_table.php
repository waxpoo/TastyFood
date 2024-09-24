<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
            $table->string('gambar')->nullable(); // Menambahkan kolom gambar, jika diperlukan
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('berita');
    }
};
