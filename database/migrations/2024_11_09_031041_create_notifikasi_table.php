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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id('id_notifikasi'); // Primary key
            $table->text('pesan_notifikasi'); // Pesan notifikasi
            $table->unsignedBigInteger('id_pengguna')->nullable()->index(); // Penerima notifikasi
            $table->unsignedBigInteger('id_kegiatan')->nullable()->index(); // Kegiatan terkait
            $table->unsignedBigInteger('id_agenda')->nullable()->index(); // Agenda terkait
            $table->string('jenis_notifikasi', 50); // Jenis notifikasi (misalnya "Kegiatan", "Tugas")
            $table->timestamp('tanggal')->useCurrent(); // Waktu notifikasi
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_pengguna')
                  ->references('id_pengguna')
                  ->on('pengguna')
                  ->onDelete('set null');
            $table->foreign('id_kegiatan')
                  ->references('id_kegiatan')
                  ->on('kegiatan')
                  ->onDelete('set null');
            $table->foreign('id_agenda')
                  ->references('id_agenda')
                  ->on('agenda')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifikasi', function (Blueprint $table) {
            //
        });
    }
};
