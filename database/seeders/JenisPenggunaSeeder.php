<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JenisPenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_pengguna')->insert([
            [
                'id_jenis_pengguna' => 1,
                'nama_jenis_pengguna' => 'Admin',
                'bobot' => 0,
                'jenis_kode' => 'ADM',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_jenis_pengguna' => 2,
                'nama_jenis_pengguna' => 'Pimpinan',
                'bobot' => 0,
                'jenis_kode' => 'PMN',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_jenis_pengguna' => 3,
                'nama_jenis_pengguna' => 'DosenAnggota',
                'bobot' => 1,
                'jenis_kode' => 'DSA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_jenis_pengguna' => 4,
                'nama_jenis_pengguna' => 'DosenPIC',
                'bobot' => 2,
                'jenis_kode' => 'DPC',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
