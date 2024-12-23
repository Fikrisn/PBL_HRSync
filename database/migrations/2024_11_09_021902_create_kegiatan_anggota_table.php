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
        Schema::create('kegiatan_anggota', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('id_pengguna'); // Foreign key column for pengguna
            $table->timestamps(); // Includes created_at and updated_at

            $table->foreign('id_pengguna')
                  ->references('id_pengguna')
                  ->on('pengguna')
                  ->onDelete('cascade'); // Optional: cascade on delete

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatan_anggota', function (Blueprint $table) {
            //
        });
    }
};
