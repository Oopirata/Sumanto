@extends('main')

@section('title', 'Buat Jadwal')

@section('page')
<div class="bg-gray-100 min-h-screen flex flex-col ">
    <div class="flex overflow-hidden">
        <x-side-bar-dekan></x-side-bar-dekan>
        <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar></x-nav-bar>
            <div class="border-b-4"></div>
            <div class="p-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-black font-bold items-center">Jadwal</h1>
                    </div>
                    
                    <div>
                        <div class="flex justify-between">
                            <div>
                                <x-jurusan></x-jurusan>
                            </div>
                            <div class="px-4 bg-white"></div>
                            <div>
                                <x-semester></x-semester>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div x-data="{ showModal: false, selectedSchedule: null }">
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
                                        // Definisikan nama hari dalam array untuk mempermudah pencocokan
                                        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                        $schedules = [
                                            // Tambahkan jadwal lainnya sesuai kebutuhan
                                        ];

                                        foreach ($data as $jadwal){
                                            $j =[ 'day' => $jadwal->hari, 'start' => $jadwal->jam_mulai, 'end' => $jadwal->jam_selesai, 'title' => $jadwal->nama_mk, 'kelas' => $jadwal->kelas, 'ruangan' => $jadwal->ruang, 'jenis' => $jadwal->status];
                                            // Tambahkan jadwal ke array $schedules
                                            array_push($schedules, $j);
                                            }
                                    
                                    @endphp
                                    @foreach ($schedules as $schedule)
                                        @if ($schedule['day'] == $days[$day - 1] &&  $time >= intval(substr($schedule['start'], 0, 2)) && $time < intval(substr($schedule['end'], 0, 2)))
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

                                            <button class="rounded p-1.5 border-l-2 {{ $colorClass }} w-full text-left" 
                                                    @click="showModal = true; selectedSchedule = {{ json_encode($schedule) }}">
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
                    <div class="text-center">
                        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-5 mr-9 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" 
                                type="button" 
                                data-drawer-target="drawer-right-example" 
                                data-drawer-show="drawer-right-example" 
                                data-drawer-placement="right" 
                                aria-controls="drawer-right-example">
                            <svg class="w-4 h-4 inline-block mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v6h6a1 1 0 110 2h-6v6a1 1 0 01-2 0v-6H4a1 1 0 110-2h6V4a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                            Jadwal
                        </button>
                    </div>

                    <!-- drawer component -->
                    <div id="drawer-right-example" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
                        <h5 id="drawer-right-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            Right drawer
                        </h5>
                        <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l12 12M1 13L13 1"/>
                            </svg>
                            <span class="sr-only">Close menu</span>
                        </button>
                        <ul class="space-y-4">
                            <li>
                                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <svg class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2a8 8 0 1 0 8 8A8.01 8.01 0 0 0 10 2ZM5 10a5 5 0 0 1 9.24-3.58A4.979 4.979 0 0 1 16 10a5 5 0 0 1-10 0ZM9 7.5a.5.5 0 1 1 1 0v4a.5.5 0 1 1-1 0v-4Z"/>
                                    </svg>
                                    <span class="ml-3">Dashboard</span>
                                </a>
                            </li>
                        </ul>
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
                                    <p class="text-sm text-gray-500">Kelas: <span x-text="selectedSchedule.kelas"></span></p>
                                    <p class="text-sm text-gray-500">Waktu: <span x-text="selectedSchedule.start"></span> - <span x-text="selectedSchedule.end"></span></p>
                                    <p class="text-sm text-gray-500">Ruangan: <span x-text="selectedSchedule.ruangan"></span></p>
                                    <p class="text-sm text-gray-500">Jenis: <span x-text="selectedSchedule.jenis"></span></p>
                                </div>
                                <div class="mt-4">
                                    <button @click="showModal = false" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                                        Tutup
                                    </button>
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
