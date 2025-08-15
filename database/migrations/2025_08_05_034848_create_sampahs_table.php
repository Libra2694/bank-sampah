<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('sampahs', function (Blueprint $table) {
        $table->id();
        $table->string('foto')->nullable(); // path foto
        $table->string('jenis');
        $table->string('kategori');
        $table->integer('harga_per_kg');
        $table->text('deskripsi')->nullable();
        $table->timestamps();
    });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sampahs');
    }
};
