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
            $table->id('fasilitas_id'); // Primary key auto increment
            $table->string('nama', 100);
            $table->enum('jenis', ['aula', 'lapangan', 'gedung', 'taman', 'lainnya']);
            $table->text('alamat');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->integer('kapasitas');
            $table->text('deskripsi')->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('fasilitas_umum');
    }
};