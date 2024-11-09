<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PenggunaModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';

    protected $fillable = ['id_pengguna','username', 'nama', 'email', 'password', 'NIP', 'id_jenis_pengguna'];

    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];

    // Define the relationship with Jenis Pengguna
    public function jenisPengguna(): BelongsTo
    {
        return $this->belongsTo(JenisPenggunaModel::class, 'id_jenis_pengguna', 'id_jenis_pengguna');
    }

    public function geRoleName(): string
    {
        return $this->jenisPengguna->nama_jenis_pengguna;
    }

    public function hasRole($role): bool
    {
        return $this->jenisPengguna->jenis_kode == $role;
    }

    public function getRole() {
        return $this->jenisPengguna->jenis_kode;
    }

    public function kegiatan(): BelongsToMany
    {
        return $this->belongsToMany(KegiatanModel::class, 'kegiatan_anggota', 'id_pengguna', 'id_kegiatan');
    }
}