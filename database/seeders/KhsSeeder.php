<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('khs')->insert([
            [
                'kode_mk' => 'MK001',
                'nama_mk' => 'Matematika Dasar',
                'sks_mk' => 3,
                'nilai' => 'A',
                'semester' => '1',
                'jumlah_sks' => 21,
                'ipk' => 3.80,
                'ips' => 3.90,
            ],
            // Add more records as needed
        ]);
    }
}
