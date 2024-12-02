<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Irs extends Model
{
    use HasFactory;

    protected $table = 'irs';
    protected $fillable = [
        'mhs_id',
        'jadwal_id',
        'semester',
        'total_sks',
        'status',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mhs_id', 'id');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'id');
    }
}
