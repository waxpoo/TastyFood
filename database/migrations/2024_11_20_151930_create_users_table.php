<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // id kolom dengan tipe BIGINT UNSIGNED dan auto increment
            $table->string('name'); // Kolom nama
            $table->string('email')->unique(); // Kolom email yang unik
            $table->string('password'); // Kolom password
            $table->string('role')->default('user'); // Kolom role dengan default 'user'
            $table->timestamp('email_verified_at')->nullable(); // Kolom untuk verifikasi email (opsional)
            $table->rememberToken(); // Kolom untuk token mengingat login
            $table->timestamps(); // Kolom timestamps created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
