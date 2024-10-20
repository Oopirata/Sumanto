<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('jadwal')->insert([
            [
                'kode_mk' => 'MK001',
                'nama_mk' => 'Matematika Dasar',
                'sks' => 3,
                'ruang' => 'R101',
                'kelas' => 'A',
                'hari' => '2024-10-15',
                'jam' => '08:00:00',
                'tanggal' => '2024-10-15',
                'nama_dosen' => 'Dr. Budi',
            ],
            // Add more records as needed
        ]);
    }
}
