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
        Schema::create('progress', function (Blueprint $table) {
            $table->id('id_progress'); // Primary key
            $table->string('status_progress', 50)->nullable(); // Status dari progres upload
            $table->timestamp('tanggal_update')->useCurrent(); // Tanggal terakhir update progres
            $table->unsignedBigInteger('id_pengguna')->nullable()->index(); // Pengguna yang melakukan update progres
            $table->unsignedBigInteger('id_dokumen')->nullable()->index(); // Referensi ke dokumen yang diunggah
            
            // Foreign keys
            $table->foreign('id_pengguna')
                  ->references('id_pengguna')
                  ->on('pengguna')
                  ->onDelete('set null');
            $table->foreign('id_dokumen')
                  ->references('id_dokumen')
                  ->on('dokumen')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
