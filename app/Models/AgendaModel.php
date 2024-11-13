<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaModel extends Model
{
    use HasFactory;

    protected $table = 'agenda'; // Nama tabel di database
    protected $primaryKey = 'id_agenda'; // Primary key dari tabel

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_agenda',
        'id_kegiatan',
        'id_pengguna',
        'status_agenda',
        'deskripsi_tugas',
        'status_tugas',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    // Relasi dengan model Kegiatan
    public function kegiatan()
    {
        return $this->belongsTo(KegiatanModel::class, 'id_kegiatan');
    }

    // Relasi dengan model Pengguna
    public function pengguna()
    {
        return $this->belongsTo(PenggunaModel::class, 'id_pengguna');
    }
}
