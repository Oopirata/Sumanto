<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Dekan', 'priority' => 1],
            ['name' => 'Ketua Program Studi', 'priority' => 2],
            ['name' => 'Bagian Akademik', 'priority' => 3],
            ['name' => 'Pembimbing Akademik', 'priority' => 4],
            ['name' => 'Mahasiswa', 'priority' => 5]
        ]);
    }
}