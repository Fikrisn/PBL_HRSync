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
        Schema::create('poin_dosen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pengguna'); // Dosen
            $table->unsignedBigInteger('id_kegiatan'); // Kegiatan
            $table->integer('poin'); // Poin yang didapatkan
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna')->onDelete('cascade');
            $table->foreign('id_kegiatan')->references('id_kegiatan')->on('kegiatan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poin_dosen');
    }
};
