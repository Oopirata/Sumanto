<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('ruangan')->insert([
            [
                'id_ruang' => 'R101',
                'nama' => 'Ruang Kuliah 1',
                'kapasitas' => 40,
                'lokasi' => 'Gedung A',
            ],
            [
                'id_ruang' => 'R102',
                'nama' => 'Ruang Kuliah 2',
                'kapasitas' => 35,
                'lokasi' => 'Gedung B',
            ],
            // Add more records as needed
        ]);
    }
}
