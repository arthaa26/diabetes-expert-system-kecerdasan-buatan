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
        Schema::create('penyakits', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penyakit')->unique(); // P1, P2, P3, P4
            $table->string('nama_penyakit'); // Nama jenis diabetes
            $table->text('deskripsi')->nullable(); // Deskripsi penyakit
            $table->text('penanganan')->nullable(); // Rekomendasi penanganan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyakits');
    }
};
