<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Define a many-to-many relationship with the Role model.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function hasRole($roleName): bool
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    public function getHighestPriorityRole()
    {
        $priorityOrder = [
            'Dekan' => 1,
            'Ketua Program Studi' => 2,
            'Bagian Akademik' => 3,
            'Pembimbing Akademik' => 4,
            'Mahasiswa' => 5,
        ];

        return $this->roles->sortBy(function ($role) use ($priorityOrder) {
            return $priorityOrder[$role->name] ?? PHP_INT_MAX;
        })->first();
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }
}
