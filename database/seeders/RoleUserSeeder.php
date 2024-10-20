<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('role_user')->insert([
            ['user_id' => 1, 'role_id' => 1], // Student One is a Mahasiswa
            ['user_id' => 2, 'role_id' => 2], // Dean One is a Dekan
            ['user_id' => 2, 'role_id' => 3], // Dean One is also a Ketua Program Studi
            ['user_id' => 2, 'role_id' => 4], // Dean One is also a Bagian Akademik
            ['user_id' => 1, 'role_id' => 5], // Student One is also a Pembimbing Akademik
        ]);
    }
}
