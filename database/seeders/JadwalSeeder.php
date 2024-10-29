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
    public function run(): void
    {
        DB::table('jadwal')->insert([
            [
                'hari' => 'Senin',
                'jam_mulai' => '08:00',
                'jam_selesai' => '10:30',
                'ruang' => 'E101',
                'kode_mk' => 'PAIK6102',
                'nama_mk' => 'Dasar Pemrograman',
                'kelas' => 'A',
                'kapasitas' => 40,
                'status' => 'Wajib',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hari' => 'Selasa',
                'jam_mulai' => '10:00',
                'jam_selesai' => '13:30',
                'ruang' => 'E102',
                'nama_mk' => 'Logika Informatika',
                'kode_mk' => 'PAIK6104',
                'kelas' => 'A',
                'kapasitas' => 25,
                'status' => 'Wajib',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hari' => 'Rabu',
                'jam_mulai' => '07:00',
                'jam_selesai' => '10:30',
                'ruang' => 'E201',
                'kode_mk' => 'PAIK6105',
                'nama_mk' => 'Struktur Diskrit',
                'kelas' => 'A',
                'kapasitas' => 30,
                'status' => 'Wajib',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hari' => 'Rabu',
                'jam_mulai' => '07:00',
                'jam_selesai' => '08:50',
                'ruang' => 'K101',
                'kode_mk' => 'PAIK6101',
                'nama_mk' => 'Matematika I',
                'kelas' => 'A',
                'kapasitas' => 43,
                'status' => 'Wajib',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hari' => 'Kamis',
                'jam_mulai' => '11:00',
                'jam_selesai' => '13:30',
                'ruang' => 'E201',
                'kode_mk' => 'PAIK6103',
                'nama_mk' => 'Dasar Sistem',
                'kelas' => 'A',
                'kapasitas' => 35,
                'status' => 'Wajib',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hari' => 'Kamis',
                'jam_mulai' => '14:00',
                'jam_selesai' => '16:30',
                'ruang' => 'E101',
                'kode_mk' => 'UUW00003',
                'nama_mk' => 'Pancasila dan Kewarganegaraan',
                'kelas' => 'A',
                'kapasitas' => 50,
                'status' => 'Wajib',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hari' => 'Jumat',
                'jam_mulai' => '07:00',
                'jam_selesai' => '08:50',
                'ruang' => 'E201',
                'kode_mk' => 'UUW00007',
                'nama_mk' => 'Bahasa Inggris',
                'kelas' => 'A',
                'kapasitas' => 25,
                'status' => 'Wajib',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'hari' => 'Jumat',
                'jam_mulai' => '15:00',
                'jam_selesai' => '15:50',
                'ruang' => 'Lapangan Undip',
                'kode_mk' => 'UUW00005',
                'nama_mk' => 'Olah Raga',
                'kelas' => 'A',
                'kapasitas' => 55,
                'status' => 'Wajib',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
