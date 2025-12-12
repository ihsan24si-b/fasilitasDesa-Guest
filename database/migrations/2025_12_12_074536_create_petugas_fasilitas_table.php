<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('petugas_fasilitas', function (Blueprint $table) {
            $table->bigIncrements('petugas_id'); // PK Custom

            // Relasi ke Fasilitas
            $table->foreignId('fasilitas_id')
                  ->constrained('fasilitas_umum', 'fasilitas_id')
                  ->onDelete('cascade');

            // Relasi ke Warga (Perhatikan PK 'warga_id' bukan 'id')
            $table->foreignId('warga_id')
                  ->constrained('warga', 'warga_id')
                  ->onDelete('cascade');

            // Peran (Enum)
            $table->enum('peran', ['Penanggung Jawab', 'Operasional', 'Kebersihan', 'Keamanan']);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('petugas_fasilitas');
    }
};