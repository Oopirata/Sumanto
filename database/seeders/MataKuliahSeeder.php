<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('matakuliah')->insert([
            [
                'kode_mk' => 'PAIK6102',
                'nama_mk' => 'Dasar Pemrograman',
                'sks' => 3,
                'semester' => 1,
                'status' => 'Wajib',
                'deskripsi' => 'Mata kuliah Dasar Pemrograman merupakan seri pertama kelompok pengembangan perangkat lunak dengan fokus pada paradigma fungsional yang dilengkapi dengan notasi fungsional.',
                'kapasitas' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'PAIK6104',
                'nama_mk' => 'Logika Informatika',
                'sks' => 4,
                'semester' => 1,
                'status' => 'Wajib',
                'deskripsi' => 'Logika Informatika merupakan sebuah mata kuliah sebagai dasar bagi matakuliah lain seperti Sistem Cerdas, dengan harapan mahasiswa mempunyai konsep berpikir komputasi (Computational thinking) dalam memecahkan sebuah masalah. Mata kuliah ini berisi konsep dasar Proporsional Logic dan First Order Logic, Validitaa, Invaliditas, Inference Rule, Pohon Semantik, Logical Ekuivalen serta pembentukan normal form dan resolusi baik PL maupu FOL.',
                'kapasitas' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'PAIK6105',
                'nama_mk' => 'Struktur Diskrit',
                'sks' => 4,
                'semester' => 1,
                'status' => 'Wajib',
                'deskripsi' => 'Struktur Diskrit merupakan materi dasar dalam Ilmu Komputer. Mata kuliah ini akan membekali mahasiswa tentang teori-teori dan konsep dasar dalam melakukan komputasi, selain itu materi ini juga akan melatih mahasiswa untuk berfikir secara analitis dan logis. Mata kuliah Struktur Diskrit ini berisi beberapa materi dasar komputasi yang meliputi teori himpunan, fungsi, matematika kombinatorik, teori graph dan pohon serta beberapa penerapannya dalam komputasi.',
                'kapasitas' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'PAIK6101',
                'nama_mk' => 'Matematika I',
                'sks' => 2,
                'semester' => 1,
                'status' => 'Wajib',
                'deskripsi' => 'Memahami konsep kalkulus untuk menyelesaikan persoalan dengan berpikir analitis.',
                'kapasitas' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'PAIK6103',
                'nama_mk' => 'Dasar Sistem',
                'sks' => 3,
                'semester' => 1,
                'status' => 'Wajib',
                'deskripsi' => 'Mata kuliah ini menjadi dasar pada bidang kajian infrastruktur sistem yang mengenalkan sistem digital sebagai dasar membangun sistem komputer, hingga pembahasan tentang gambaran dasar teknologi informasi mencakup sistem operasi, internet, dan web.',
                'kapasitas' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW00007',
                'nama_mk' => 'Bahasa Inggris',
                'sks' => 2,
                'semester' => 1,
                'status' => 'Wajib',
                'deskripsi' => 'Bahasa Inggris sebagai bahasa internasional perlu dikuasai mahasiswa terutama untuk mempelajari materi kuliah dan literatur berbahasa Inggris. Dalam kuliah ini, mahasiswa belajar materi uji bahasa Inggris sebagai bahasa asing yang meliputi aspek mendengar, menganalisis struktur, membaca, dan menulis paragraf dalam bahasa Inggris. Aspek berbicara dipelajari secara terpadu dengan aspek - aspek lain.',
                'kapasitas' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW00005',
                'nama_mk' => 'Olah Raga',
                'sks' => 1,
                'semester' => 1,
                'status' => 'Wajib',
                'deskripsi' => 'Mata kuliah ini membekali mahassiswa dengan pemahaman tentang gerak, aktivitas fisik, permainan, dan olah raga.Mata kuliah ini juga memberikan pemahaman tentang fungsi dan esensi pendidikan jasmani, olah raga, serta hubungannya dengan kebugaran dan kesehatan.',
                'kapasitas' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'UUW00003',
                'nama_mk' => 'Pancasila dan Kewarganegaraan',
                'sks' => 3,
                'semester' => 1,
                'status' => 'Wajib',
                'deskripsi' => 'Mahasiswa belajar untuk menganalisis masalah kontekstual kewarganegaraan, mengembangkan sikap positif, dan menampilkan perilaku mendukung yang berkaitan dengan semangat kebangsaan, cinta tanah air, demokrasi berkeadaban dan kesadaran hukum.',
                'kapasitas' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
