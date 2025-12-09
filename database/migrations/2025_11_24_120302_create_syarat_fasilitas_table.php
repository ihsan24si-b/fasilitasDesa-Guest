<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('syarat_fasilitas', function (Blueprint $table) {
            $table->id('syarat_id');
            $table->foreignId('fasilitas_id')->constrained('fasilitas_umum', 'fasilitas_id')->onDelete('cascade');
            $table->string('nama_syarat', 200);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('syarat_fasilitas');
    }
};
