<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KegiatanModel extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';

    protected $fillable = ['judul_kegiatan', 'deskripsi_kegiatan', 'tanggal_mulai', 'tanggal_selesai', 'id_jenis_kegiatan', 'pic','anggota'];

    // Define the relationship with Jenis Kegiatan
    public function jenisKegiatan(): BelongsTo
    {
        return $this->belongsTo(JenisKegiatanModel::class, 'id_jenis_kegiatan', 'id_jenis_kegiatan');
    }

    // Define the relationship with PIC
    public function pic(): BelongsTo
    {
        return $this->belongsTo(PenggunaModel::class, 'pic_id', 'id_pengguna');
    }

    // Define the relationship with multiple Anggota
    public function anggota(): BelongsToMany
    {
        return $this->belongsToMany(PenggunaModel::class, 'kegiatan_anggota', 'id_kegiatan', 'id_pengguna');
    }
}