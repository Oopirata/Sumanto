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
                'jadwal_id' => '1',
                'semester' => '4',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '1',
                'jadwal_id' => '2',
                'semester' => '4',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '1',
                'jadwal_id' => '3',
                'semester' => '4',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '1',
                'jadwal_id' => '4',
                'semester' => '4',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '1',
                'jadwal_id' => '5',
                'semester' => '4',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '2',
                'jadwal_id' => '1',
                'semester' => '6',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '2',
                'jadwal_id' => '2',
                'semester' => '6',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '2',
                'jadwal_id' => '3',
                'semester' => '6',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '2',
                'jadwal_id' => '4',
                'semester' => '6',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '2',
                'jadwal_id' => '5',
                'semester' => '6',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '3',
                'jadwal_id' => '1',
                'semester' => '4',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '3',
                'jadwal_id' => '2',
                'semester' => '4',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '3',
                'jadwal_id' => '3',
                'semester' => '4',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '3',
                'jadwal_id' => '4',
                'semester' => '4',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '3',
                'jadwal_id' => '5',
                'semester' => '4',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '3',
                'jadwal_id' => '6',
                'semester' => '4',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '3',
                'jadwal_id' => '7',
                'semester' => '4',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mhs_id' => '3',
                'jadwal_id' => '8',
                'semester' => '4',
                'status' => 'Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
