<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            ['name' => 'Ahmad Douglas', 'roles' => ['Mahasiswa', 'Pembimbing Akademik']],
            ['name' => 'Don Gogo', 'roles' => ['Dekan']],
            ['name' => 'Cartein', 'roles' => ['Bagian Akademik', 'Ketua Program Studi']],
            ['name' => 'Budiono Siregar', 'roles' => ['Pembimbing Akademik']],
            ['name' => 'Dewi Kusumawati', 'roles' => ['Mahasiswa', 'Bagian Akademik']],
        ];

        foreach ($users as $userData) {
            $user = \App\Models\User::create([
                'name' => $userData['name'],
                'email' => 'temp@example.com', // Temporary email to satisfy NOT NULL constraint
                'password' => Hash::make('password'),
            ]);

            $user->roles()->attach(
                Role::whereIn('name', $userData['roles'])->pluck('id')
            );

            // Determine email based on highest priority role
            $highestRole = $user->getHighestPriorityRole();
            $user->email = strtolower(str_replace(' ', '', $user->name)) . '@' . strtolower(str_replace(' ', '', $highestRole->name)) . '.example.com';
            $user->save();
        }
    }

}