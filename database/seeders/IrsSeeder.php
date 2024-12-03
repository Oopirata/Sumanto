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
                'nim' => '24060122199999',
                'jadwal_id' => '2',
                'semester' => '1',
                'status' => 'Tidak Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '24060122199999',
                'jadwal_id' => '9',
                'semester' => '1',
                'status' => 'Tidak Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '24060122199999',
                'jadwal_id' => '14',
                'semester' => '1',
                'status' => 'Tidak Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '24060122199999',
                'jadwal_id' => '19',
                'semester' => '1',
                'status' => 'Tidak Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '24060122199999',
                'jadwal_id' => '24',
                'semester' => '1',
                'status' => 'Tidak Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '24060122199999',
                'jadwal_id' => '29',
                'semester' => '1',
                'status' => 'Tidak Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '24060122199999',
                'jadwal_id' => '34',
                'semester' => '1',
                'status' => 'Tidak Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '24060122199999',
                'jadwal_id' => '39',
                'semester' => '3',
                'status' => 'Tidak Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '24060122199999',
                'jadwal_id' => '44',
                'semester' => '3',
                'status' => 'Tidak Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '24060122199999',
                'jadwal_id' => '49',
                'semester' => '3',
                'status' => 'Tidak Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '24060122199999',
                'jadwal_id' => '54',
                'semester' => '3',
                'status' => 'Tidak Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '24060122199999',
                'jadwal_id' => '59',
                'semester' => '3',
                'status' => 'Tidak Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '24060122199999',
                'jadwal_id' => '64',
                'semester' => '3',
                'status' => 'Tidak Disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
