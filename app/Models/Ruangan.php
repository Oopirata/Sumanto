<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan';

    protected $fillable = [
        'id_ruang',
        'nama',
        'kapasitas',
        'lokasi',
        'status',
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
