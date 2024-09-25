<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array of sample users with roles
        $users = [
            [
                'nama' => 'Ahmad Douglas',
                'role' => 'dekan', // Dekan
            ],
            [
                'nama' => 'Sarah Nurani',
                'role' => 'kaprodi', // Kaprodi
            ],
            [
                'nama' => 'Budi Setiawan',
                'role' => 'dosen', // Dosen
            ],
            [
                'nama' => 'Rani Kurnia',
                'role' => 'mahasiswa', // Mahasiswa
            ],
            [
                'nama' => 'Taufik Hidayat',
                'role' => 'akademik', // Akademik
            ]
        ];

        // Loop through the users array and insert each one into the users table
        foreach ($users as $user) {
            // Format the email by removing spaces and making lowercase
            $email = $this->generateEmail($user['nama'], $user['role']);

            DB::table('users')->insert([
                'nama' => $user['nama'],
                'email' => $email,
                'password' => md5('password123'), // Placeholder password (hashed with MD5)
                'mahasiswa' => $user['role'] === 'mahasiswa' ? 1 : 0,
                'dosen' => $user['role'] === 'dosen' ? 1 : 0,
                'kaprodi' => $user['role'] === 'kaprodi' ? 1 : 0,
                'dekan' => $user['role'] === 'dekan' ? 1 : 0,
                'akademik' => $user['role'] === 'akademik' ? 1 : 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Generate email based on user's name and role.
     *
     * @param string $name
     * @param string $role
     * @return string
     */
    private function generateEmail($name, $role)
    {
        // Remove spaces and lowercase the name
        $emailName = strtolower(str_replace(' ', '', $name));

        // Define the domain based on role
        switch ($role) {
            case 'mahasiswa':
                $domain = '@student.undip.ac.id';
                break;
            case 'dosen':
                $domain = '@lecturer.undip.ac.id';
                break;
            case 'kaprodi':
                $domain = '@kaprodi.undip.ac.id';
                break;
            case 'dekan':
                $domain = '@dekan.undip.ac.id';
                break;
            case 'akademik':
                $domain = '@akademik.undip.ac.id';
                break;
            default:
                $domain = '@undip.ac.id'; // Default domain if role is not specified
        }

        // Combine email name with domain
        return $emailName . $domain;
    }
}