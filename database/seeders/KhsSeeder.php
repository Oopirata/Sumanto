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
            //Semester 2
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6202',
                'semester' => 2,
                'nilai' => 'A',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6204',
                'semester' => 2,
                'nilai' => 'A',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6203',
                'semester' => 2,
                'nilai' => 'B',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6201',
                'semester' => 2,
                'nilai' => 'C',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'UUW00006',
                'semester' => 2,
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
            //Semester 4
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6401',
                'semester' => 4,
                'nilai' => 'A',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6402',
                'semester' => 4,
                'nilai' => 'A',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6403',
                'semester' => 4,
                'nilai' => 'A',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6404',
                'semester' => 4,
                'nilai' => 'A',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6405',
                'semester' => 4,
                'nilai' => 'A',
            ],
            [
                'nim' => '24060122120031',
                'kode_mk' => 'PAIK6406',
                'semester' => 4,
                'nilai' => 'A',
            ],
        ];
        DB::table('khs')->insert($khs_data);
    }
}
