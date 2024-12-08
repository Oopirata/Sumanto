<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prodi')->insert([
            ['nama_prodi' => 'Informatika'],
            ['nama_prodi' => 'Kimia'],
            ['nama_prodi' => 'Fisika'],
            ['nama_prodi' => 'Biologi'],
            ['nama_prodi' => 'Matematika'],
            ['nama_prodi' => 'Statistika']
        ]);
        
    }
}
