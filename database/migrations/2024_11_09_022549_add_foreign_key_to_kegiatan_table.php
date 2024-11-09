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
        Schema::table('kegiatan', function (Blueprint $table) {
            // Tambahkan foreign key constraint pada kolom id_jenis_kegiatan
            $table->unsignedBigInteger('id_jenis_kegiatan')->nullable()->change();
            $table->foreign('id_jenis_kegiatan')
                  ->references('id_jenis_kegiatan')
                  ->on('jenis_kegiatan')
                  ->onDelete('set null'); // Atur menjadi null jika data dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->dropForeign(['id_jenis_kegiatan']);
        });
    }
};
