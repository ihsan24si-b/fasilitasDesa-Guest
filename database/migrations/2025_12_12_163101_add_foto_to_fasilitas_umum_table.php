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
    Schema::table('fasilitas_umum', function (Blueprint $table) {
        // Menambah kolom foto setelah kolom deskripsi
        $table->string('foto')->nullable()->after('deskripsi');
    });
}

public function down(): void
{
    Schema::table('fasilitas_umum', function (Blueprint $table) {
        $table->dropColumn('foto');
    });
}
};
