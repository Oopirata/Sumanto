<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';

    protected $fillable = ['nama_prodi'];

    public function dosen ()
    {
        return $this->hasMany(Dosen::class, 'nama_prodi', 'nama_prodi');
    }
}
