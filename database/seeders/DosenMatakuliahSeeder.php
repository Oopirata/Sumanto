<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Dosen;
use App\Models\Matakuliah;

class DosenMatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assignments = [
            ['dosen_nip' => Dosen::find(1)->nip, 'kode_mk' => Matakuliah::find(1)->kode_mk],
            ['dosen_nip' => Dosen::find(2)->nip, 'kode_mk' => Matakuliah::find(1)->kode_mk],
            ['dosen_nip' => Dosen::find(3)->nip, 'kode_mk' => Matakuliah::find(1)->kode_mk],
            ['dosen_nip' => Dosen::find(1)->nip, 'kode_mk' => Matakuliah::find(2)->kode_mk],
            ['dosen_nip' => Dosen::find(2)->nip, 'kode_mk' => Matakuliah::find(2)->kode_mk],
            ['dosen_nip' => Dosen::find(1)->nip, 'kode_mk' => Matakuliah::find(3)->kode_mk],
            ['dosen_nip' => Dosen::find(2)->nip, 'kode_mk' => Matakuliah::find(4)->kode_mk],
            ['dosen_nip' => Dosen::find(2)->nip, 'kode_mk' => Matakuliah::find(5)->kode_mk],
            ['dosen_nip' => Dosen::find(2)->nip, 'kode_mk' => Matakuliah::find(6)->kode_mk],
            ['dosen_nip' => Dosen::find(3)->nip, 'kode_mk' => Matakuliah::find(7)->kode_mk],
            ['dosen_nip' => Dosen::find(3)->nip, 'kode_mk' => Matakuliah::find(8)->kode_mk]
        ];

        foreach ($assignments as $assignment) {
            DB::table('dosen_matakuliah')->insert([
                'dosen_nip' => $assignment['dosen_nip'],
                'kode_mk' => $assignment['kode_mk'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}