<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
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
            //Pembimbing Akademik atau Dosen
            ['name' => 'Dr. Aris Puji Widodo, S.Si., M.T.', 'roles' => ['Pembimbing Akademik']],
            ['name' => 'Drs. Eko Adi Sarwoko, M.Komp.', 'roles' => ['Pembimbing Akademik']],
            ['name' => 'Sandy Kurniawan, S.Kom., M.Kom.', 'roles' => ['Pembimbing Akademik']],
            ['name' => 'Adhe Setya Pramayoga, M.T.', 'roles' => ['Pembimbing Akademik']],
            ['name' => 'Priyo Sidik Sasongko, S.Si., M.Kom.', 'roles' => ['Pembimbing Akademik']],
            ['name' => 'Dr. Retno Kusumaningrum, S.Si., M.Kom.', 'roles' => ['Pembimbing Akademik']],
            ['name' => 'Guruh Aryotejo, S.Kom., M.Sc.', 'roles' => ['Pembimbing Akademik']],

            ['name' => 'Budiono Siregar', 'roles' => ['Pembimbing Akademik']],
            ['name' => 'Don Gogo', 'roles' => ['Dekan', 'Pembimbing Akademik']],
            ['name' => 'Ahmad Douglas', 'roles' => ['Mahasiswa', 'Pembimbing Akademik']],
            ['name' => 'Aegon', 'roles' => ['Mahasiswa']],
            ['name' => 'Leassa', 'roles' => ['Mahasiswa']],
            ['name' => 'Cartein', 'roles' => ['Bagian Akademik']],
            ['name' => 'Dewi Kusumawati', 'roles' => ['Bagian Akademik']],
            ['name' => 'Sarah Sriwedari', 'roles' => ['Bagian Akademik']],
            ['name' => 'Cain Chana', 'roles' => ['Ketua Program Studi']],

            //Mahasiswa
            ['name' => 'Bintang Syafrian Rizal', 'roles' => ['Mahasiswa']],
            ['name' => 'Muhammad Mirza Faiz Rabbani', 'roles' => ['Mahasiswa']],
            ['name' => 'Hanif Herofa', 'roles' => ['Mahasiswa']],
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
                            'semester' => 5,
                            'fakultas' => 'Fakultas Sains dan Matematika',
                            'prodi' => 'Informatika',
                            'angkatan' => '2022',
                            'no_hp' => '08' . random_int(100000000, 999999999),
                            'IPK' => mt_rand(100, 400) / 100,
                            'IPS' => mt_rand(100, 400) / 100,
                            'dosen_wali_id' => $dosenWaliId
                        ]);
                        break;
                    case 'Pembimbing Akademik':
                        DB::table('dosen')->insert([
                            'user_id' => $user->id,
                            'nama' => $user->name,
                            'nip' => 'NIP' . uniqid() . random_int(1000, 9999),
                            'no_hp' => '08' . random_int(100000000, 999999999),
                            'alamat' => 'Jl. ' . Str::random(10),
                            'fakultas' => 'Fakultas Sains dan Matematika', // Add the fakultas field
                            'prodi' => 'Informatika', // Add the prodi field if required
                            'created_at' => now(),
                            'updated_at' => now(),
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
