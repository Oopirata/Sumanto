<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuatIrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('buat_irs')->insert([
            [
                'kode_mk' => 'MIK1624102',
                'nama_mk' => 'Dasar Pemrograman',
                'sks' => '3',
                'semester' => '1',
                'kelas' => 'A',
                'ruang' => 'E102',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Dr.Eng. Adi Wibowo, S.Si., M.Kom.',
                'time_date' => 'Senin, 09:40: - 12:10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624102',
                'nama_mk' => 'Dasar Pemrograman',
                'sks' => '3',
                'semester' => '1',
                'kelas' => 'B',
                'ruang' => 'E103',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Dr.Eng. Adi Wibowo, S.Si., M.Kom.',
                'time_date' => 'Selasa, 07:00: - 09:30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624102',
                'nama_mk' => 'Dasar Pemrograman',
                'sks' => '3',
                'semester' => '1',
                'kelas' => 'C',
                'ruang' => 'E103',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Dr.Eng. Adi Wibowo, S.Si., M.Kom.',
                'time_date' => 'Senin, 13:00: - 15:30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624102',
                'nama_mk' => 'Dasar Pemrograman',
                'sks' => '3',
                'semester' => '1',
                'kelas' => 'D',
                'ruang' => 'E103',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Dr.Eng. Adi Wibowo, S.Si., M.Kom.',
                'time_date' => 'Selasa, 09:40: - 12:10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624102',
                'nama_mk' => 'Dasar Pemrograman',
                'sks' => '3',
                'semester' => '1',
                'kelas' => 'E',
                'ruang' => 'E102',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Dr.Eng. Adi Wibowo, S.Si., M.Kom.',
                'time_date' => 'Senin, 15:40: - 18:10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624102',
                'nama_mk' => 'Dasar Pemrograman',
                'sks' => '3',
                'semester' => '1',
                'kelas' => 'F',
                'ruang' => 'E102',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Dr.Eng. Adi Wibowo, S.Si., M.Kom.',
                'time_date' => 'Rabu, 09:40: - 12:10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'PAIK6104',
                'nama_mk' => 'Logika Informatika',
                'sks' => '3',
                'semester' => '1',
                'kelas' => 'A',
                'ruang' => 'E102',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Dr. Sutikno, S.T., M.Cs.',
                'time_date' => 'Jumat, 09:40 - 12:10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624103',
                'nama_mk' => 'Struktur Diskret',
                'sks' => '4',
                'semester' => '1',
                'kelas' => 'A',
                'ruang' => 'E103',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Nurdin Bahtiar, S.Si., M.T.',
                'time_date' => 'Rabu, 07:00 - 10:20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624103',
                'nama_mk' => 'Struktur Diskret',
                'sks' => '4',
                'semester' => '1',
                'kelas' => 'B',
                'ruang' => 'E103',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Nurdin Bahtiar, S.Si., M.T.',
                'time_date' => 'Selasa, 13:00 - 16:20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624103',
                'nama_mk' => 'Struktur Diskret',
                'sks' => '4',
                'semester' => '1',
                'kelas' => 'C',
                'ruang' => 'E103',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Nurdin Bahtiar, S.Si., M.T.',
                'time_date' => 'Rabu, 13:00 - 16:20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624103',
                'nama_mk' => 'Struktur Diskret',
                'sks' => '4',
                'semester' => '1',
                'kelas' => 'D',
                'ruang' => 'E103',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Nurdin Bahtiar, S.Si., M.T.',
                'time_date' => 'Kamis, 13:00 - 16:20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624103',
                'nama_mk' => 'Struktur Diskret',
                'sks' => '4',
                'semester' => '1',
                'kelas' => 'E',
                'ruang' => 'E103',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Nurdin Bahtiar, S.Si., M.T.',
                'time_date' => 'Jumat, 13:00 - 16:20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624104',
                'nama_mk' => 'Matematika I',
                'sks' => '2',
                'semester' => '1',
                'kelas' => 'A',
                'ruang' => 'E102',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Prof. Dr. Dra. Sunarsih M.Si.',
                'time_date' => 'Kamis, 07:00 - 08:40',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624104',
                'nama_mk' => 'Matematika I',
                'sks' => '2',
                'semester' => '1',
                'kelas' => 'B',
                'ruang' => 'K202',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Prof. Dr. Dra. Sunarsih M.Si.',
                'time_date' => 'Senin, 16:30 - 18:10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624104',
                'nama_mk' => 'Matematika I',
                'sks' => '2',
                'semester' => '1',
                'kelas' => 'C',
                'ruang' => 'E103',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Prof. Dr. Dra. Sunarsih M.Si.',
                'time_date' => 'Selasa, 16:30 - 18:10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624104',
                'nama_mk' => 'Matematika I',
                'sks' => '2',
                'semester' => '1',
                'kelas' => 'D',
                'ruang' => 'E103',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Prof. Dr. Dra. Sunarsih M.Si.',
                'time_date' => 'Rabu, 10:30 - 12:10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624104',
                'nama_mk' => 'Matematika I',
                'sks' => '2',
                'semester' => '1',
                'kelas' => 'E',
                'ruang' => 'E102',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Prof. Dr. Dra. Sunarsih M.Si.',
                'time_date' => 'Kamis, 13:00 - 14:40',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624101',
                'nama_mk' => 'Dasar Sistem',
                'sks' => '3',
                'semester' => '1',
                'kelas' => 'A',
                'ruang' => 'E102',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Rismiyati, B.Eng, M.Cs.',
                'time_date' => 'Selasa, 15:40 - 18:10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624101',
                'nama_mk' => 'Dasar Sistem',
                'sks' => '3',
                'semester' => '1',
                'kelas' => 'B',
                'ruang' => 'E103',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Rismiyati, B.Eng, M.Cs.',
                'time_date' => 'Senin, 09:40 - 12:10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624101',
                'nama_mk' => 'Dasar Sistem',
                'sks' => '3',
                'semester' => '1',
                'kelas' => 'C',
                'ruang' => 'E102',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Rismiyati, B.Eng, M.Cs.',
                'time_date' => 'Senin, 07:00 - 09:30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624101',
                'nama_mk' => 'Dasar Sistem',
                'sks' => '3',
                'semester' => '1',
                'kelas' => 'D',
                'ruang' => 'E102',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Rismiyati, B.Eng, M.Cs.',
                'time_date' => 'Senin, 13:00 - 15:30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'MIK1624101',
                'nama_mk' => 'Dasar Sistem',
                'sks' => '3',
                'semester' => '1',
                'kelas' => 'E',
                'ruang' => 'E102',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Rismiyati, B.Eng, M.Cs.',
                'time_date' => 'Rabu, 07:00 - 09:30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW1624002',
                'nama_mk' => 'Pancasila',
                'sks' => '2',
                'semester' => '1',
                'kelas' => 'A',
                'ruang' => 'E102',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Dyah Wijaningsih, S.H., M.H.',
                'time_date' => 'Kamis, 15:50 - 17:30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW1624002',
                'nama_mk' => 'Pancasila',
                'sks' => '2',
                'semester' => '1',
                'kelas' => 'B',
                'ruang' => 'E103',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Drs. Slamet Subekti, M.Hum.',
                'time_date' => 'Jumat, 16:30 - 18:10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW1624002',
                'nama_mk' => 'Pancasila',
                'sks' => '2',
                'semester' => '1',
                'kelas' => 'C',
                'ruang' => 'E102',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Drs. Slamet Subekti, M.Hum.',
                'time_date' => 'Jumat, 13:00 - 14:40',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW1624002',
                'nama_mk' => 'Pancasila',
                'sks' => '2',
                'semester' => '1',
                'kelas' => 'D',
                'ruang' => 'K202',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Drs. Slamet Subekti, M.Hum.',
                'time_date' => 'Selasa, 16:30 - 18:10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW1624002',
                'nama_mk' => 'Pancasila',
                'sks' => '2',
                'semester' => '1',
                'kelas' => 'E',
                'ruang' => 'K202',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Dyah Wijaningsih, S.H., M.H.',
                'time_date' => 'Jumat, 09:40 - 11:20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW1624107',
                'nama_mk' => 'Bahasa Inggris I',
                'sks' => '1',
                'semester' => '1',
                'kelas' => 'A',
                'ruang' => 'E102',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Rismiyati, B.Eng, M.Cs.',
                'time_date' => 'Kamis, 10:50 - 11:40',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW1624107',
                'nama_mk' => 'Bahasa Inggris I',
                'sks' => '1',
                'semester' => '1',
                'kelas' => 'B',
                'ruang' => 'E102',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Rismiyati, B.Eng, M.Cs.',
                'time_date' => 'Kamis, 11:50 - 12:40',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW1624107',
                'nama_mk' => 'Bahasa Inggris I',
                'sks' => '1',
                'semester' => '1',
                'kelas' => 'C',
                'ruang' => 'B101',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Dr. Sutrisno, S.Si., M.Sc.',
                'time_date' => 'Jumat, 10:40 - 11:30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW1624107',
                'nama_mk' => 'Bahasa Inggris I',
                'sks' => '1',
                'semester' => '1',
                'kelas' => 'D',
                'ruang' => 'E102',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Rismiyati, B.Eng, M.Cs.',
                'time_date' => 'Kamis, 09:50 - 10:40',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW1624107',
                'nama_mk' => 'Bahasa Inggris I',
                'sks' => '1',
                'semester' => '1',
                'kelas' => 'E',
                'ruang' => 'A304',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Rismiyati, B.Eng, M.Cs.',
                'time_date' => 'Rabu, 15:50 - 16:40',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW1624004',
                'nama_mk' => 'Bahasa Indonesia',
                'sks' => '2',
                'semester' => '1',
                'kelas' => 'A',
                'ruang' => 'E103',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Dr. Drs. Muh Abdullah, M.A.',
                'time_date' => 'Rabu, 16:30 - 18:10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW1624004',
                'nama_mk' => 'Bahasa Indonesia',
                'sks' => '2',
                'semester' => '1',
                'kelas' => 'B',
                'ruang' => 'E103',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Dr. Drs. Muh Abdullah, M.A.',
                'time_date' => 'Kamis, 09:40 - 11:20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW1624004',
                'nama_mk' => 'Bahasa Indonesia',
                'sks' => '2',
                'semester' => '1',
                'kelas' => 'C',
                'ruang' => 'K102',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Dr. Drs. Muh Abdullah, M.A.',
                'time_date' => 'Senin, 10:30 - 12:10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW1624004',
                'nama_mk' => 'Bahasa Indonesia',
                'sks' => '2',
                'semester' => '1',
                'kelas' => 'D',
                'ruang' => 'K102',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Dr. Drs. Muh Abdullah, M.A.',
                'time_date' => 'Jumat, 09:40 - 11:20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW1624004',
                'nama_mk' => 'Bahasa Indonesia',
                'sks' => '2',
                'semester' => '1',
                'kelas' => 'E',
                'ruang' => 'E103',
                'sifat' => 'Wajib',
                'nama_dosen' => 'Dr. Drs. Muh Abdullah, M.A.',
                'time_date' => 'Jumat, 07:00 - 08:40',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
