<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('ruangan')->insert([
            [
                'id_ruang' => 'A303',
                'nama' => 'Ruang Kuliah A303',
                'kapasitas' => 40,
                'lokasi' => 'Gedung A',
                'status' => 'Disetujui',
                'keterangan' => 'Terpakai'
            ],
            [
                'id_ruang' => 'E101',
                'nama' => 'Ruang Kuliah E101',
                'kapasitas' => 50,
                'lokasi' => 'Gedung E',
                'status' => 'Disetujui',
                'keterangan' => 'Terpakai'
            ],
            [
                'id_ruang' => 'E102',
                'nama' => 'Ruang Kuliah E102',
                'kapasitas' => 50,
                'lokasi' => 'Gedung E',
                'status' => 'Disetujui',
                'keterangan' => 'Terpakai'
            ],
            [
                'id_ruang' => 'E103',
                'nama' => 'Ruang Kuliah E103',
                'kapasitas' => 50,
                'lokasi' => 'Gedung E',
                'status' => 'Disetujui',
                'keterangan' => 'Terpakai'
            ],
            [
                'id_ruang' => 'K101',
                'nama' => 'Ruang Kuliah K101',
                'kapasitas' => 45,
                'lokasi' => 'Gedung K',
                'status' => 'Pending',
                'keterangan' => 'Tidak Tersedia'
            ],
            [
                'id_ruang' => 'K102',
                'nama' => 'Ruang Kuliah K102',
                'kapasitas' => 45,
                'lokasi' => 'Gedung K',
                'status' => 'Pending',
                'keterangan' => 'Tidak Tersedia'
            ],
            [
                'id_ruang' => 'K202',
                'nama' => 'Ruang Kuliah K202',
                'kapasitas' => 45,
                'lokasi' => 'Gedung K',
                'status' => 'Pending',
                'keterangan' => 'Tidak Tersedia'
            ],
        ]);
    }
}