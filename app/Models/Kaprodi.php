<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    use HasFactory;

    protected $table = 'kaprodi'; // Nama tabel

    protected $fillable = ['user_id', 'nip', 'nama', 'nama_prodi']; // Kolom yang dapat diisi

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'nama_prodi', 'nama_prodi');
    }
}
