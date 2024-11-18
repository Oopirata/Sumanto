<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen'; // Nama tabel

    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'no_telp',
        'alamat',
        'fakultas',
        'prodi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function matakuliah()
    {
        return $this->belongsToMany(Matakuliah::class, 'dosen_matakuliah', 'dosen_nip', 'kode_mk');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'dosen_wali_id');
    }
}
