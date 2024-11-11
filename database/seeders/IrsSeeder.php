<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('irs')->insert([
            [
                'mhs_id' => '1',
                'jadwal_id' => '68',
                'semester' => '5',
                'kode_mk' => 'PAIK6503',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '1',
                'jadwal_id' => '76',
                'semester' => '5',
                'kode_mk' => 'PAIK6504',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '1',
                'jadwal_id' => '84',
                'semester' => '5',
                'kode_mk' => 'PAIK6501',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '1',
                'jadwal_id' => '80',
                'semester' => '5',
                'kode_mk' => 'PAIK6506',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '1',
                'jadwal_id' => '88',
                'semester' => '5',
                'kode_mk' => 'PAIK6502',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
