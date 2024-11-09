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
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('id_pengguna'); // Primary key
            $table->unsignedBigInteger('id_jenis_pengguna')->index();
            $table->string('username')->index();
            $table->string('nama');
            $table->string('email')->index();
            $table->string('password');
            $table->string('NIP')->nullable();
            $table->timestamps(); // Includes created_at and updated_at

            // Foreign key constraint
            $table->foreign('id_jenis_pengguna')->references('id_jenis_pengguna')->on('jenis_pengguna');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
