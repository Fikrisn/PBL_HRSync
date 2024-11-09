<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_kegiatan')->insert([
            [
                'id_jenis_kegiatan' => 1,
                'nama_jenis_kegiatan' => 'Kegiatan JTI',
            ],
            [
                'id_jenis_kegiatan' => 2,
                'nama_jenis_kegiatan' => 'Kegiatan Non-JTI',
            ],
        ]);
    }
}
