<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use carbon\Carbon;

class KegiatanAnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kegiatan_anggota')->insert([
            [
                'id' => 1,
                'id_kegiatan' => 1, // Id kegiatan yang ada di tabel kegiatan
                'id_pengguna' => 2, // Id pengguna yang menjadi anggota
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'id_kegiatan' => 1,
                'id_pengguna' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
