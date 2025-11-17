<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Hapus tabel lama jika ada
        Schema::dropIfExists('fasilitas_umum');

        // Buat tabel baru dengan struktur yang benar
        Schema::create('fasilitas_umum', function (Blueprint $table) {
        $table->id();
        $table->string('nama_fasilitas');
        $table->string('jenis_fasilitas');
        $table->integer('rt');
        $table->integer('rw');
        $table->integer('kapasitas');
        $table->text('alamat');
        $table->text('deskripsi')->nullable();
        $table->timestamps();
    });
    }

    public function down()
    {
        Schema::dropIfExists('fasilitas_umum');
    }
};
