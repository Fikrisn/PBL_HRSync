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
        Schema::create('agenda', function (Blueprint $table) {
            $table->id('id_agenda'); // Primary key
            $table->string('nama_agenda');
            $table->unsignedBigInteger('id_kegiatan')->nullable();
            $table->unsignedBigInteger('id_pengguna')->nullable(); // Foreign key untuk pengguna
            $table->string('status_agenda', 50)->nullable();
            $table->text('deskripsi_tugas')->nullable(); // Detail tugas
            $table->string('status_tugas', 50)->nullable(); // Status tugas
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_kegiatan')
                  ->references('id_kegiatan')
                  ->on('kegiatan')
                  ->onDelete('set null');
                  
            $table->foreign('id_pengguna')
                  ->references('id_pengguna')
                  ->on('pengguna')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agenda', function (Blueprint $table) {
            // Drop foreign keys
            $table->dropForeign(['id_kegiatan']);
            $table->dropForeign(['id_pengguna']);
            
            // Drop columns
            $table->dropColumn(['id_pengguna', 'deskripsi_tugas', 'status_tugas']);
        });
    }
};
