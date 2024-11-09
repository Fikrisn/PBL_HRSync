<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JenisPenggunaModel extends Model
{
    use HasFactory;

    protected $table = 'jenis_pengguna';
    protected $primaryKey = 'id_jenis_pengguna';

    protected $fillable = [
        'id_jenis_pengguna',
        'nama_jenis_pengguna', 
        'bobot',
        'jenis_kode',
        'created_at',
        'updated_at'
    ];
}
