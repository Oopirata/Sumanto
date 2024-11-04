<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Irs extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
        'kelas',
        'ruang',
        'status',
        'nama_dosen',
        'time_date',
    ];
}
