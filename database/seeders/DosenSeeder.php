<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dosen')->insert([
            [
                'nip' => '197404011999031002',
                'nama' => 'Dr. Aris Puji Widodo, S.Si., M.T.',
                'no_telp' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '196511071992031003',
                'nama' => 'Drs. Eko Adi Sarwoko, M.Komp.',
                'no_telp' => '081298765432',
                'alamat' => 'Jl. Mangga Dalam No. 5, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '199603032024061003',
                'nama' => 'Sandy Kurniawan, S.Kom., M.Kom.',
                'no_telp' => '082156262728',
                'alamat' => 'Jl. Rantapari No. 45, Semarang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '199112092024061001',
                'nama' => 'Adhe Setya Pramayoga, M.T.',
                'no_telp' => '085188778889',
                'alamat' => 'Jl. Sudirman No. 45, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '197007051997021001',
                'nama' => 'Priyo Sidik Sasongko, S.Si., M.Kom.',
                'no_telp' => '081356789012',
                'alamat' => 'Jl. Gatot Subroto No. 67, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '198104202005012001',
                'nama' => 'Dr. Retno Kusumaningrum, S.Si., M.Kom.',
                'no_telp' => '085777829382',
                'alamat' => 'Jl. Prabowo Subroto No. 61, Semarang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '198012272015041002',
                'nama' => 'Guruh Aryotejo, S.Kom., M.Sc.',
                'no_telp' => '089827362718',
                'alamat' => 'Jl. Gibran No. 66, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
