@extends('main')

@section('title', 'Dashboard')

@section('page')
    <div class="bg-gray-100 min-h-screen flex flex-col">
        <div class="flex overflow-hidden">
            <x-side-bar-mhs :mahasiswa="$mahasiswa"></x-side-bar-mhs>
            <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
                <x-nav-bar :mahasiswa="$mahasiswa" :user="$userData"></x-nav-bar>
                <div class="mx-8 mt-8 bg-white py-8 px-6 rounded-2xl">
                    <h1 class="font-extrabold text-xl">Kartu Hasil Studi (KHS)</h1>

                    @foreach ($semesterData as $semester)
                        <div x-data="{ open: false }" class="mb-4 border rounded-lg bg-[#F9FBFF] mt-8">
                            <div class="flex justify-between items-center p-4 cursor-pointer" @click="open = !open">
                                <div>
                                    <h1 class="text-lg">Semester {{ $semester->semester }}</h1>
                                    <h1 class="text-sm text-gray-500">Jumlah SKS {{ $semester->total_sks }}</h1>
                                </div>
                                <svg :class="{ 'rotate-180': open }" class="ml-2 w-5 h-5 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>

                            <div x-show="open" class="p-4">
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
                                        @foreach ($khsData[$semester->semester] as $index => $khs)
                                            <tr>
                                                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                                <td class="border px-4 py-2">{{ $khs->kode_mk }}</td>
                                                <td class="border px-4 py-2">{{ $khs->nama_mk }}</td>
                                                <td class="border px-4 py-2">{{ $khs->sks }}</td>
                                                <td class="border px-4 py-2">{{ $khs->nilai }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="flex justify-center mt-8 gap-40">
                                    <div class="bg-green-500 text-white font-bold py-2 px-6 rounded-lg mx-4">
                                        <h1 class="text-2xl">{{ number_format($semester->ips, 2) }}</h1>
                                        <h1>IP Semester</h1>
                                    </div>

                                    <div class="bg-green-500 text-white font-bold py-2 px-6 rounded-lg mx-4">
                                        <h1 class="text-2xl">{{ number_format($mahasiswa->IPS, 2) }}</h1>
                                        <h1>IP Kumulatif</h1>
                                    </div>

                                    <div>
                                        <button
                                            class="bg-red-500 text-white font-bold py-6 px-6 rounded-lg mx-4 hover:bg-red-600"
                                            onclick="window.location.href='{{ route('khs.download', ['semester' => $semester->semester]) }}'">
                                            Unduh PDF
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
