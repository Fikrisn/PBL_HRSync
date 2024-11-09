<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JenisKegiatanModel extends Model
{
    use HasFactory;

    protected $table = 'jenis_kegiatan';
    protected $primaryKey = 'id_jenis_kegiatan';

    protected $fillable = [
        'id_jenis_kegiatan',
        'nama_jenis_kegiatan'
    ];

    public function kegiatan(): BelongsTo {
        return $this->BelongsTo(KegiatanModel::class, 'id_jenis_kegiatan', 'id_jenis_kegiatan');
    }
}
