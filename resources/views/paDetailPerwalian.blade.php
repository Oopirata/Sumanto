@extends('main')

@section('title', 'Dashboard')

@section('page')
    <div class="bg-gray-100 min-h-screen flex">
        <x-side-bar-pa :dosen="$dosen" :dosens="$dosens"></x-side-bar-pa>
        <div id="main-content" class="relative text-black ml-64 font-poppins w-full">
            <div class="sticky top-0">
                <x-nav-bar :dosen="$dosen" :dosens="$dosens"></x-nav-bar>
            </div>

            <div class="mx-8 rounded-2xl mt-4 bg-white shadow p-8 mb-6">
                <!-- Informasi Mahasiswa -->
                <div class="flex justify-between mb-6">
                    <div>
                        <p class="text-sm font-medium text-gray-700">NIM: {{ $mahasiswa->nim }}</p>
                        <p class="text-sm font-medium text-gray-700">Nama Lengkap: {{ $mahasiswa->nama }}</p>
                        <p class="text-sm font-medium text-gray-700">Fakultas: {{ $mahasiswa->fakultas }}</p>
                        <p class="text-sm font-medium text-gray-700">Prodi: {{ $mahasiswa->prodi }}</p>
                        <p class="text-sm font-medium text-gray-700">Angkatan: {{ $mahasiswa->angkatan }}</p>
                        <p class="text-sm font-medium text-gray-700">Nomor HP: {{ $mahasiswa->no_hp }}</p>
                        <p class="text-sm font-medium text-gray-700">Email: {{ $mahasiswa->user->email }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-gray-700">2024/2025 Ganjil</p>
                        <div class="text-center font-medium bg-green-100 py-2 px-8 rounded-lg">
                            <h1 class="text-green-500">AKTIF</h1>
                        </div>
                    </div>
                </div>

                @if ($irsData->isEmpty())
                    <div class="text-center py-8">
                        <div class="mb-4">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum Ada IRS</h3>
                        <p class="mt-1 text-sm text-gray-500">Mahasiswa belum mengambil mata kuliah untuk semester ini.</p>
                    </div>
                @else
                    @foreach ($irsData as $semester => $matakuliahs)
                        <div x-data="{ open: false }" class="mb-4 border rounded-lg bg-[#F9FBFF] mt-8">
                            <div class="flex justify-between items-center p-4 cursor-pointer" @click="open = !open">
                                <div>
                                    <h1 class="text-lg">Semester {{ $semester }}</h1>
                                    <h1 class="text-sm text-gray-500">Jumlah SKS {{ $semesterSks[$semester] }}</h1>
                                </div>
                                <svg :class="{ 'rotate-180': open }" class="ml-2 w-5 h-5 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </div>

                            <div x-show="open" class="p-4">
                                <table class="min-w-full table-auto bg-white border-collapse border border-gray-300">
                                    <thead class="bg-[#5932EA] text-white">
                                        <tr>
                                            <th class="border px-4 py-2">No</th>
                                            <th class="border px-4 py-2">Kode</th>
                                            <th class="border px-4 py-2">Mata Kuliah</th>
                                            <th class="border px-4 py-2">Kelas</th>
                                            <th class="border px-4 py-2">SKS</th>
                                            <th class="border px-4 py-2">Ruang</th>
                                            <th class="border px-4 py-2">Sifat</th>
                                            <th class="border px-4 py-2">Nama Dosen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($matakuliahs as $index => $mk)
                                            <tr>
                                                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                                <td class="border px-4 py-2">{{ $mk->kode_mk }}</td>
                                                <td class="border px-4 py-2">{{ $mk->nama_mk }}</td>
                                                <td class="border px-4 py-2">{{ $mk->kelas }}</td>
                                                <td class="border px-4 py-2">{{ $mk->sks }}</td>
                                                <td class="border px-4 py-2">{{ $mk->ruang }}</td>
                                                <td class="border px-4 py-2">{{ $mk->sifat }}</td>
                                                <td class="border px-4 py-2">{{ $mk->nama_dosen }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
