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
        Schema::create('jenis_pengguna', function (Blueprint $table) {
            $table->id('id_jenis_pengguna'); // Primary key
            $table->string('nama_jenis_pengguna');
            $table->integer('bobot')->nullable();
            $table->string('jenis_kode', 50);
            $table->timestamps(); // Includes created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_pengguna');
    }
};
