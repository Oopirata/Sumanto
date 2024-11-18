<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuatIRS extends Model
{
    use HasFactory;

    protected  $table = 'buat_irs';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
        'kelas',
        'ruang',
        'sifat',
        'nama_dosen',
        'time_date',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
