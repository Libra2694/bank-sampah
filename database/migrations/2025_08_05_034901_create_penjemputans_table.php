<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penjemputans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained()->onDelete('cascade');

            // ✅ Tambahkan kolom petugas_id dulu
            $table->unsignedBigInteger('petugas_id')->nullable();

            $table->date('tanggal');
            $table->string('status')->default('menunggu'); // menunggu, diproses, selesai, batal
            $table->text('alamat');
            $table->text('catatan')->nullable();
            $table->timestamps();

            // ✅ Baru setelah itu bikin foreign key-nya
            $table->foreign('petugas_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('penjemputans');
    }
};
