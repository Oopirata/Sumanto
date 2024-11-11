<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Irs extends Model
{
    use HasFactory;

    protected $fillable = [
        'mhs_id',
        'jadwal_id',
        'semester',
        'total_sks',
        'status',
    ];
}
