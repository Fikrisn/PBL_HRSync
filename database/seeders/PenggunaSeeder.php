<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengguna')->insert([
            [
                'id_pengguna' => 1,
                'id_jenis_pengguna' => 1, // Admin
                'username' => 'admin1',
                'nama' => 'Admin Satu',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('123456'),
                'NIP' => '1234567890',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_pengguna' => 2,
                'id_jenis_pengguna' => 2, // Pimpinan
                'username' => 'pimpinan1',
                'nama' => 'Pimpinan Satu',
                'email' => 'pimpinan1@gmail.com',
                'password' => Hash::make('123456'),
                'NIP' => '2345678901',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_pengguna' => 3,
                'id_jenis_pengguna' => 3, // Dosen Anggota
                'username' => 'dosenanggota1',
                'nama' => 'Dosen Anggota Satu',
                'email' => 'dosenanggota1@gmail.com',
                'password' => Hash::make('123456'),
                'NIP' => '3456789012',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_pengguna' => 4,
                'id_jenis_pengguna' => 4, // Dosen PIC
                'username' => 'dosenpic1',
                'nama' => 'Dosen PIC Satu',
                'email' => 'dosenpic1@gmail.com',
                'password' => Hash::make('123456'),
                'NIP' => '4567890123',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_pengguna' => 5,
                'id_jenis_pengguna' => 3, // Dosen Anggota
                'username' => 'dosenanggota2',
                'nama' => 'Dosen Anggota Dua',
                'email' => 'dosen2@gmail.com',
                'password' => Hash::make('123456'),
                'NIP' => '5678901234',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
