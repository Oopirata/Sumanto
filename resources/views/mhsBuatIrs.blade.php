@extends('main')

@section('title', 'Buat Jadwal')

@section('page')
<div class="bg-gray-100 min-h-screen flex flex-col ">
    <div class="flex overflow-hidden">
        <x-side-bar-mhs :mahasiswa="$mahasiswa"></x-side-bar-mhs>
        <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar></x-nav-bar>
            <div class="border-b-4"></div>
            <div class="p-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-black font-bold items-center text-2xl">Buat IRS</h1>
                    </div>
                </div>
            </div>
            
            <div x-data="{ showModal: false, selectedSchedule: null, selectedSchedules: [] }">
                <!-- Bagian jadwal -->
                <section class="relative mb-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm flex">
                    <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 overflow-x-auto">
                        <div class="grid grid-cols-8 border-t border-gray-200 sticky top-0 left-0 w-full">
                            <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900"></div>
                            <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Senin</div>
                            <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Selasa</div>
                            <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Rabu</div>
                            <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Kamis</div>
                            <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Jumat</div>
                            <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Sabtu</div>
                            <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Minggu</div>
                        </div>

                        @for ($time = 7; $time <= 21; $time++)
    <div class="grid grid-cols-8 border-t border-gray-200">
        <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">{{ $time }}:00</div>
        @for ($day = 1; $day <= 7; $day++)
            <div class="flex flex-col h-auto p-0.5 md:p-3.5 border-r border-gray-200 transition-all hover:bg-stone-100">
                @php
                    $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                    $schedules = [];
                    foreach ($jadwals as $jadwal) {
                        $j = [
                            'day' => $jadwal->hari,
                            'kode_mk' => $jadwal->kode_mk,
                            'sks' => $jadwal->sks,
                            'kapasitas' => $jadwal->kapasitas,
                            'start' => $jadwal->jam_mulai,
                            'end' => $jadwal->jam_selesai,
                            'title' => $jadwal->nama_mk,
                            'kelas' => $jadwal->kelas,
                            'ruangan' => $jadwal->ruang,
                            'jenis' => $jadwal->status
                        ];
                        array_push($schedules, $j);
                    }
                @endphp
                @foreach ($schedules as $schedule)
                    @if ($schedule['day'] == $days[$day - 1] && 
                        ($time == intval(substr($schedule['start'], 0, 2)) || 
                        ($time > intval(substr($schedule['start'], 0, 2)) && $time < intval(substr($schedule['end'], 0, 2)))))

                        @php
                            $colorClass = '';
                            switch ($schedule['kelas']) {
                                case 'A':
                                    $colorClass = 'bg-blue-50 border-blue-600 text-blue-600';
                                    break;
                                case 'B':
                                    $colorClass = 'bg-red-50 border-red-600 text-red-600';
                                    break;
                                case 'C':
                                    $colorClass = 'bg-green-50 border-green-600 text-green-600';
                                    break;
                                case 'D':
                                    $colorClass = 'bg-purple-50 border-purple-600 text-purple-600';
                                    break;
                                default:
                                    $colorClass = 'bg-gray-50 border-gray-600 text-gray-600';
                                    break;
                            }
                        @endphp

                        <button class="rounded p-1.5 border-l-2 {{ $colorClass }} w-full text-left" @click="showModal = true; selectedSchedule = {{ json_encode($schedule) }}">
                            <p class="text-xs font-normal mb-px">{{ $schedule['title'] }}</p>
                            <p class="text-xs font-semibold">{{ $schedule['start'] }} - {{ $schedule['end'] }}</p>
                        </button>
                    @endif
                @endforeach
            </div>
        @endfor
    </div>
@endfor

                    </div>
                    
                    <!-- drawer init and toggle -->
                    <div class="fixed bottom-5 right-5 text-center">
                        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" 
                                type="button" 
                                data-drawer-target="drawer-right-example" 
                                data-drawer-show="drawer-right-example" 
                                data-drawer-placement="right" 
                                aria-controls="drawer-right-example">
                            SKS
                        </button>
                    </div>

                    <!-- drawer component -->
                    <div id="drawer-right-example" class="rounded-xl fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-96 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
                        <h1 id="drawer-right-label" class="inline-flex items-center mb-4 text-base font-semibold text-black">LIST MATAKULIAH YANG DIPILIH</h1>
                        <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l12 12M1 13L13 1"/>
                            </svg>
                            <span class="sr-only">Close menu</span>
                        </button>

                        <!-- Tabel Mata Kuliah yang Dipilih -->
                        <div class="mt-4 overflow-x-auto bg-gray-50 p-2 rounded-lg shadow-md">
                            <table class="min-w-full table-auto border-collapse text-sm">
                                <thead class="bg-blue-600 text-white">
                                    <tr>
                                        <th class="border px-4 py-2 text-left">Nama MK</th>
                                        <th class="border px-4 py-2 text-left">Kode MK</th>
                                        <th class="border px-4 py-2 text-left">SKS</th>
                                        <th class="border px-4 py-2 text-left">Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="schedule in selectedSchedules" :key="schedule.kode_mk">
                                        <tr class="hover:bg-gray-100 transition-colors">
                                            <td class="border px-4 py-2" x-text="schedule.title"></td>
                                            <td class="border px-4 py-2" x-text="schedule.kode_mk"></td>
                                            <td class="border px-4 py-2" x-text="schedule.sks"></td>
                                            <td class="border px-4 py-2" x-text="schedule.kelas"></td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </section>

                <!-- Modal for displaying schedule details -->
                <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto">
                    <div class="flex items-center justify-center min-h-screen px-4 text-center">
                        <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
                        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                            <div class="px-4 py-5">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" x-text="selectedSchedule.title"></h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Kode MK: <span x-text="selectedSchedule.kode_mk"></span></p>
                                    <p class="text-sm text-gray-500">SKS: <span x-text="selectedSchedule.sks"></span></p>
                                    <p class="text-sm text-gray-500">Kelas: <span x-text="selectedSchedule.kelas"></span></p>
                                    <p class="text-sm text-gray-500">Hari: <span x-text="selectedSchedule.day"></span></p>
                                    <p class="text-sm text-gray-500">Waktu: <span x-text="selectedSchedule.start"></span> - <span x-text="selectedSchedule.end"></span></p>
                                    <p class="text-sm text-gray-500">Ruangan: <span x-text="selectedSchedule.ruangan"></span></p>
                                    <p class="text-sm text-gray-500">Jenis: <span x-text="selectedSchedule.jenis"></span></p>
                                    <p class="text-sm text-gray-500">Kapasitas: <span x-text="selectedSchedule.kapasitas"></span></p>
                                </div>
                                <div class="mt-4">
                                    <button @click="selectedSchedules.push(selectedSchedule); showModal = false" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-5 rounded">Pilih</button>
                                    <button @click="showModal = false" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-5 rounded">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
