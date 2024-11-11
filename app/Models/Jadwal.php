<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal'; // Nama tabel

    protected $fillable = [
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruang',
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
        'kelas',
        'kapasitas',
        'status',
        'prodi',
        'sifat'
    ];
}
