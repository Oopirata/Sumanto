<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhsSeeder extends Seeder
{
    public function run()
    {
        $khs_data = [
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6102',
                'semester' => 1,
                'nilai' => 'A',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6104',
                'semester' => 1,
                'nilai' => 'A',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6105',
                'semester' => 1,
                'nilai' => 'B',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6101',
                'semester' => 1,
                'nilai' => 'A',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6103',
                'semester' => 1,
                'nilai' => 'A',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'UUW1624107',
                'semester' => 1,
                'nilai' => 'A',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'UUW1624002',
                'semester' => 1,
                'nilai' => 'A',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'UUW1624004',
                'semester' => 1,
                'nilai' => 'A',
            ],
            //Semester 3
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6301',
                'semester' => 3,
                'nilai' => 'A',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6304',
                'semester' => 3,
                'nilai' => 'A',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6302',
                'semester' => 3,
                'nilai' => 'A',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6305',
                'semester' => 3,
                'nilai' => 'A',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6303',
                'semester' => 3,
                'nilai' => 'A',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6306',
                'semester' => 3,
                'nilai' => 'A',
            ],
        ];
        DB::table('khs')->insert($khs_data);
    }
}
