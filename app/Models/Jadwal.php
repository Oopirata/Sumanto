<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal'; // Nama tabel

    protected $fillable = [
        'id',
        'id_matakuliah',
        'id_dosen',
        'id_ruangan',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'kelas',
        'semester',
        'tahun_ajaran',
        'created_at',
        'updated_at',
    ];

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'id_matakuliah', 'id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id');
    }
}
