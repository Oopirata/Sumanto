<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $table = 'matakuliah';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
        'status',
        'deskripsi',
        'kapasitas'
    ];
    
    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, 'dosen_matakuliah');
    }
}
