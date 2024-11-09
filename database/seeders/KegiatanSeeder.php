<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kegiatan')->insert([
            [
                'id_kegiatan' => 1,
                'judul_kegiatan' => 'Pelatihan Laravel',
                'deskripsi_kegiatan' => 'Pelatihan penggunaan framework Laravel',
                'tanggal_mulai' => '2024-11-01',
                'tanggal_selesai' => '2024-11-03',
                'id_jenis_kegiatan' => 1,
                'pic_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
