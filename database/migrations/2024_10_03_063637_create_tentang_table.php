<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTentangTable extends Migration
{
    public function up()
    {
        Schema::create('tentang', function (Blueprint $table) {
            $table->id();
            $table->text('about_text');
            $table->text('vision_text');
            $table->text('mission_text');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tentang');
    }
}
