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
        Schema::create('warga', function (Blueprint $table) {
        $table->id();
        $table->string('no_ktp')->unique();
        $table->string('nama_lengkap');
        $table->enum('jenis_kelamin', ['L','P']);
        $table->string('agama');
        $table->string('pekerjaan');
        $table->string('no_telepon');
        $table->string('email');

        // foreign key
        $table->unsignedBigInteger('fasilitas_id');
        $table->foreign('fasilitas_id')
              ->references('id')
              ->on('fasilitas_umum')
              ->onDelete('cascade');

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};
