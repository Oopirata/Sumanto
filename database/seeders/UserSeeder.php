<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Dosen;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['name' => 'Budiono Siregar', 'roles' => ['Pembimbing Akademik']],
            ['name' => 'Don Gogo', 'roles' => ['Dekan', 'Pembimbing Akademik']],
            ['name' => 'Ahmad Douglas', 'roles' => ['Mahasiswa', 'Pembimbing Akademik']],
            ['name' => 'Aegon', 'roles' => ['Mahasiswa']],
            ['name' => 'Leassa', 'roles' => ['Mahasiswa']],
            ['name' => 'Cartein', 'roles' => ['Bagian Akademik']],
            ['name' => 'Dewi Kusumawati', 'roles' => ['Bagian Akademik']],
            ['name' => 'Sarah Sriwedari', 'roles' => ['Bagian Akademik']],
            ['name' => 'Cain Chana', 'roles' => ['Ketua Program Studi']],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => 'temp@example.com',
                'password' => Hash::make('password'),
            ]);

            // Attach roles to user
            $roleIds = Role::whereIn('name', $userData['roles'])->pluck('id');
            $user->roles()->attach($roleIds);

            // Update email based on highest priority role
            $highestRole = $user->getHighestPriorityRole();
            $user->email = strtolower(str_replace(' ', '', $user->name)) . '@' . strtolower(str_replace(' ', '', $highestRole->name)) . '.example.com';
            $user->save();

            // Add user to specific tables based on their role
            foreach ($userData['roles'] as $roleName) {
                switch ($roleName) {
                    case 'Mahasiswa':
                        $dosenWali = Dosen::inRandomOrder()->first();
                        $dosenWaliId = $dosenWali ? $dosenWali->id : null;

                        DB::table('mahasiswa')->insert([
                            'user_id' => $user->id,
                            'nama' => $user->name,
                            'nim' => 'MHS' . uniqid() . random_int(1000, 9999), // Random unique NIM
                            'semester' => random_int(1, 12),
                            'prodi' => 'Informatika',
                            'IPK' => mt_rand(100, 400) / 100,
                            'dosen_wali_id' => $dosenWaliId
                        ]);
                        break;
                    case 'Pembimbing Akademik':
                        DB::table('dosen')->insert([
                            'user_id' => $user->id,
                            'nama' => $user->name,
                            'nip' => 'NIP' . uniqid() . random_int(1000, 9999) // Random unique NIP
                        ]);
                        break;
                    case 'Ketua Program Studi':
                        DB::table('kaprodi')->insert([
                            'user_id' => $user->id,
                            'nama' => $user->name,
                            'nip' => 'NIP' . uniqid() . random_int(1000, 9999) // Random unique NIP
                        ]);
                        break;
                    case 'Dekan':
                        DB::table('dekan')->insert([
                            'user_id' => $user->id,
                            'nama' => $user->name,
                            'nip' => 'NIP' . uniqid() . random_int(1000, 9999) // Random unique NIP
                        ]);
                        break;
                    case 'Bagian Akademik':
                        DB::table('bagian_akademik')->insert([
                            'user_id' => $user->id,
                            'nama' => $user->name,
                            'nip' => 'NIP' . uniqid() . random_int(1000, 9999) // Random unique NIP
                        ]);
                        break;
                }
            }
        }
    }
}