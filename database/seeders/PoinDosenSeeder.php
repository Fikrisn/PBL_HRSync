<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class PoinDosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kegiatan = DB::table('kegiatan')->get();

        foreach ($kegiatan as $kegiatanItem) {
            // Dosen sebagai PIC
            DB::table('poin_dosen')->insert([
                'id_pengguna' => $kegiatanItem->pic_id, // ID PIC
                'id_kegiatan' => $kegiatanItem->id_kegiatan,
                'poin' => 2, // Bobot untuk PIC
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Dosen sebagai Anggota
            $anggota = DB::table('kegiatan_anggota')
                         ->where('id_kegiatan', $kegiatanItem->id_kegiatan)
                         ->get();

            foreach ($anggota as $anggotaItem) {
                DB::table('poin_dosen')->insert([
                    'id_pengguna' => $anggotaItem->id_pengguna, // ID Anggota
                    'id_kegiatan' => $kegiatanItem->id_kegiatan,
                    'poin' => 1, // Bobot untuk anggota
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
