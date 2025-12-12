<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran_fasilitas', function (Blueprint $table) {
            $table->bigIncrements('bayar_id');
            
            // Relasi 1-to-1 (Karena sekali bayar, pinjam_id harus unique)
            $table->foreignId('pinjam_id')
                  ->unique() // <--- Kunci agar 1 peminjaman cuma bisa 1x bayar
                  ->constrained('peminjaman_fasilitas', 'pinjam_id')
                  ->onDelete('cascade');

            $table->date('tgl_bayar');
            $table->decimal('jumlah', 15, 2);
            $table->string('metode'); // Tunai, Transfer BRI, Dana, dll
            $table->text('keterangan')->nullable(); // Catatan admin (misal: No Ref Transfer)
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran_fasilitas');
    }
};