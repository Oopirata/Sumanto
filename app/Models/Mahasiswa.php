<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa'; // Nama tabel

    protected $fillable = [
        'user_id',
        'nama',
        'nim',
        'semester',
        'prodi',
        'fakultas',
        'angkatan',
        'no_hp',
        'IPK',
        'IPS',
        'dosen_wali_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_wali_id');
    }

    public function irs()
    {
        return $this->hasMany(Irs::class);
    }
}
