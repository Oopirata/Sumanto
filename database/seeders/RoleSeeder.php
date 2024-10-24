<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'mahasiswa'],
            ['name' => 'dekan'],
            ['name' => 'ketua_program_studi'],
            ['name' => 'bagian_akademik'],
            ['name' => 'pembimbing_akademik'],
        ]);
    }
}
