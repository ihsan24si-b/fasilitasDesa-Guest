<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id');
            $table->string('ref_table'); // Untuk menyimpan nama tabel: 'fasilitas_umum'
            $table->unsignedBigInteger('ref_id'); // Untuk menyimpan fasilitas_id
            $table->string('file_name'); // Nama file yang disimpan
            $table->string('caption')->nullable(); // Keterangan file
            $table->string('mime_type'); // Jenis file: image/jpeg, application/pdf
            $table->integer('sort_order')->default(0); // Urutan tampilan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
