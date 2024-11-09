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
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id('id_dokumen'); // Primary key
            $table->unsignedBigInteger('id_kegiatan'); // Foreign key column
            $table->string('draf_surat_tugas');
            $table->string('proposal');
            $table->string('kwitansi');
            $table->string('dokumentasi');
            $table->string('dokumen_lpj');
            
            // Foreign key constraint
            $table->foreign('id_kegiatan')
                  ->references('id_kegiatan')
                  ->on('kegiatan')
                  ->onDelete('cascade'); // Optional: cascade on delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};
