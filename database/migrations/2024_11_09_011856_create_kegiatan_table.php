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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id('id_kegiatan'); // Primary key
            $table->string('judul_kegiatan');
            $table->text('deskripsi_kegiatan')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->unsignedBigInteger('id_jenis_kegiatan')->nullable()->index(); // Foreign key column (optional)
            $table->unsignedBigInteger('pic_id')->nullable()->index(); // Foreign key column (optional)
            $table->timestamps(); // Includes created_at and updated_at

            // Foreign key constraints (if needed)
            $table->foreign('id_jenis_kegiatan')
                  ->references('id_jenis_pengguna') // Adjust if `jenis_kegiatan` table exists
                  ->on('jenis_pengguna')
                  ->onDelete('set null'); // Optional

            $table->foreign('pic_id')
                  ->references('id_pengguna') // Adjust if `pengguna` table exists
                  ->on('pengguna')
                  ->onDelete('set null'); // Optional
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
