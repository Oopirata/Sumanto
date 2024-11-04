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
        DB::table('buat_irs')->insert([
            [
                'kode_mk' => 'PAIK6102',
                'nama_mk' => 'Dasar Pemrograman',
                'sks' => '3',
                'semester' => '1',
                'kelas' => 'A',
                'ruang' => 'E101',
                'status' => 'Wajib',
                'nama_dosen' => 'Dr. Aris Puji Widodo, S.Si., M.T.',
                'time_date' => 'Senin, 08:00: - 10:30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'PAIK6104',
                'nama_mk' => 'Logika Informatika',
                'sks' => '4',
                'semester' => '1',
                'kelas' => 'A',
                'ruang' => 'E102',
                'status' => 'Wajib',
                'nama_dosen' => 'Drs. Eko Adi Sarwoko, M.Komp.',
                'time_date' => 'Selasa, 10:00 - 13:30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'PAIK6105',
                'nama_mk' => 'Struktur Diskrit',
                'sks' => '4',
                'semester' => '1',
                'kelas' => 'A',
                'ruang' => 'E201',
                'status' => 'Wajib',
                'nama_dosen' => 'Dr. Retno Kusumaningrum, S.Si., M.Kom.',
                'time_date' => 'Rabu, 07:00 - 10:30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'PAIK6101',
                'nama_mk' => 'Matematika I',
                'sks' => '2',
                'semester' => '1',
                'kelas' => 'A',
                'ruang' => 'K101',
                'status' => 'Wajib',
                'nama_dosen' => 'Sandy Kurniawan, S.Kom., M.Kom.',
                'time_date' => 'Rabu, 07:00 - 08:50',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'PAIK6103',
                'nama_mk' => 'Dasar Sistem',
                'sks' => '3',
                'semester' => '1',
                'kelas' => 'A',
                'ruang' => 'E201',
                'status' => 'Wajib',
                'nama_dosen' => 'Adhe Setya Pramayoga, M.T.',
                'time_date' => 'Kamis, 11:00 - 13:30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW00003',
                'nama_mk' => 'Pancasila dan Kewarganegaraan',
                'sks' => '3',
                'semester' => '1',
                'kelas' => 'A',
                'ruang' => 'E101',
                'status' => 'Wajib',
                'nama_dosen' => 'Priyo Sidik Sasongko, S.Si., M.Kom.',
                'time_date' => 'Kamis, 14:00 - 16:30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW00007',
                'nama_mk' => 'Bahasa Inggris',
                'sks' => '2',
                'semester' => '1',
                'kelas' => 'A',
                'ruang' => 'E201',
                'status' => 'Wajib',
                'nama_dosen' => 'Guruh Aryotejo, S.Kom., M.Sc.',
                'time_date' => 'Jumat, 07:00 - 08:50',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW00005',
                'nama_mk' => 'Olah Raga',
                'sks' => '1',
                'semester' => '1',
                'kelas' => 'A',
                'ruang' => 'Lapangan Undip',
                'status' => 'Wajib',
                'nama_dosen' => 'Dr. Aris Puji Widodo, S.Si., M.T.',
                'time_date' => 'Jumat, 15:00, 15:50',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
