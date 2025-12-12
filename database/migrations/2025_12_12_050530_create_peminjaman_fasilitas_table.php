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
        Schema::create('peminjaman_fasilitas', function (Blueprint $table) {
            // 1. Primary Key Custom
            $table->bigIncrements('pinjam_id');

            // 2. Foreign Keys (PERBAIKAN DISINI)
            $table->foreignId('fasilitas_id')->constrained('fasilitas_umum', 'fasilitas_id')->onDelete('cascade');
            
            // Tambahkan parameter kedua 'warga_id' agar Laravel tau kolom tujuannya
            $table->foreignId('warga_id')->constrained('warga', 'warga_id')->onDelete('cascade');

            // 3. Data Peminjaman
            $table->string('kode_booking')->unique();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->text('tujuan');
            
            // 4. Status & Biaya
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'selesai', 'dibatalkan'])->default('pending');
            $table->decimal('total_biaya', 15, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_fasilitas');
    }
};