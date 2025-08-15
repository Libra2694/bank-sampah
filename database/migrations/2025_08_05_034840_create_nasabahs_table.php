<?php

// database/migrations/202X_XX_XX_create_nasabahs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
{
    Schema::create('nasabahs', function (Blueprint $table) {
        $table->id();
        $table->string('foto')->nullable(); // path foto KTP/profile
        $table->string('nama');
        $table->text('alamat');
        $table->string('no_telepon');
        $table->string('email')->unique();
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('nasabahs');
    }
};