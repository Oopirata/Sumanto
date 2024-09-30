@extends('main')

@section('title', 'Dashboard')

@section('page')

<div class="bg-gray-100 min-h-screen flex flex-col">
    <div class="flex overflow-hidden">
        <x-side-bar-mhs></x-side-bar-mhs>
        <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar></x-nav-bar>
            <div class="mx-8 mt-8 bg-white py-8 px-6 rounded-2xl">
                <h1 class="font-extrabold text-xl">Transkrip Akademik</h1>

                <!-- Identitas Mahasiswa -->
                <div class="mt-6 bg-[#F9FBFF] p-4 rounded-lg">
                    <div class="flex justify-between">
                        <div>
                            <p><strong>Nama</strong>: Dul Samsi</p>
                            <p><strong>Prodi</strong>: Informatika</p>
                        </div>
                        <div>
                            <p><strong>Nomor Induk Mahasiswa</strong>: 24060122120031</p>
                            <p><strong>Tahun Masuk</strong>: 2022</p>
                        </div>
                    </div>
                </div>

                <!-- Tabel Transkrip Akademik -->
                <div class="mt-8">
                    <table class="min-w-full table-auto bg-white border-collapse border border-gray-300">
                        <thead class="bg-[#5932EA] text-white">
                            <tr>
                                <th class="border px-4 py-2">No</th>
                                <th class="border px-4 py-2">Kode</th>
                                <th class="border px-4 py-2">Mata Kuliah</th>
                                <th class="border px-4 py-2">SKS</th>
                                <th class="border px-4 py-2">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border px-4 py-2">1</td>
                                <td class="border px-4 py-2">PAK6102</td>
                                <td class="border px-4 py-2">Dasar Pemrograman</td>
                                <td class="border px-4 py-2">3</td>
                                <td class="border px-4 py-2">A</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">2</td>
                                <td class="border px-4 py-2">PAK6103</td>
                                <td class="border px-4 py-2">Dasar Sistem</td>
                                <td class="border px-4 py-2">3</td>
                                <td class="border px-4 py-2">A</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">3</td>
                                <td class="border px-4 py-2">PAK6101</td>
                                <td class="border px-4 py-2">Matematika 1</td>
                                <td class="border px-4 py-2">2</td>
                                <td class="border px-4 py-2">A</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">4</td>
                                <td class="border px-4 py-2">UWW00007</td>
                                <td class="border px-4 py-2">Bahasa Inggris</td>
                                <td class="border px-4 py-2">2</td>
                                <td class="border px-4 py-2">A</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">5</td>
                                <td class="border px-4 py-2">PAK6104</td>
                                <td class="border px-4 py-2">Logika Informatika</td>
                                <td class="border px-4 py-2">3</td>
                                <td class="border px-4 py-2">A</td>
                            </tr>
                            <tr>
                                <td class="border px-4 py-2">6</td>
                                <td class="border px-4 py-2">PAK6105</td>
                                <td class="border px-4 py-2">Struktur Diskrit</td>
                                <td class="border px-4 py-2">4</td>
                                <td class="border px-4 py-2">A</td>
                            </tr>
                            <!-- Tambahkan semua mata kuliah lainnya di sini -->
                        </tbody>
                    </table>
                </div>

                <!-- Footer: Total SKS, IP Semester, IP Kumulatif -->
                <div class="flex justify-center mt-8 gap-8">
                    <!-- Total SKS -->
                    <div class="bg-green-500 text-white font-bold py-2 px-6 rounded-lg">
                        <h1 class="text-2xl">87</h1>
                        <h1>SKS Kumulatif</h1>
                    </div>

                    <!-- IP Kumulatif -->
                    <div class="bg-green-500 text-white font-bold py-2 px-6 rounded-lg">
                        <h1 class="text-2xl">3.83</h1>
                        <h1>IP Kumulatif</h1>
                    </div>

                    <!-- Button Download PDF -->
                    <div>
                        <button class="bg-red-500 text-white font-bold py-6 px-6 rounded-lg hover:bg-red-600" onclick="window.location.href='/path/to/pdf'">
                            Unduh PDF
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
