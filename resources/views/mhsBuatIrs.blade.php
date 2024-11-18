@extends('main')

@section('title', 'Buat Irs')

@section('page')
    <div class="bg-gray-100 min-h-screen flex flex-col ">
        <div class="flex overflow-hidden">
            <x-side-bar-mhs :mahasiswa="$mahasiswa"></x-side-bar-mhs>
            <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
                <x-nav-bar :mahasiswa="$mahasiswa" :user="$user"></x-nav-bar>
                <div class="border-b-4"></div>
                <div class="p-8 mt-6 mx-8 bg-white border border-gray-200 rounded-2xl shadow-sm">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-10">
                            <h1 class="text-black font-bold text-2xl">Buat IRS</h1>
                            <div id="real-time-clock" class="text-2xl font-semibold text-black"></div>
                            <div class="text-green-600 text-2xl font-semibold">Saatnya Isi IRS!!!</div>
                        </div>
                        <div class="flex items-center space-x-10">
                            <h1 class="bg-[#000CB0] px-8 py-2 text-white rounded-3xl">Semester {{ $mahasiswa->semester }}
                            </h1>
                        </div>
                    </div>
                </div>

                <div x-data="{ showModal: false, selectedSchedule: null, selectedSchedules: []">
                    <!-- Bagian jadwal -->
                    <section class="relative mb-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm flex">
                        <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 overflow-x-auto">
                            <div class="grid grid-cols-8 border-t border-gray-200 sticky top-0 left-0 w-full">
                                <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900"></div>
                                <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Senin
                                </div>
                                <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Selasa
                                </div>
                                <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Rabu
                                </div>
                                <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Kamis
                                </div>
                                <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Jumat
                                </div>
                                <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Sabtu
                                </div>
                                <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Minggu
                                </div>
                            </div>
                            @for ($time = 7; $time <= 21; $time++)
                                <div class="grid grid-cols-8 border-t border-gray-200">
                                    <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">
                                        {{ $time }}:00</div>
                                    @for ($day = 1; $day <= 7; $day++)
                                        <div
                                            class="flex flex-col h-auto p-0.5 md:p-3.5 border-r border-gray-200 transition-all hover:bg-stone-100">
                                            @php
                                                $days = [
                                                    'Senin',
                                                    'Selasa',
                                                    'Rabu',
                                                    'Kamis',
                                                    'Jumat',
                                                    'Sabtu',
                                                    'Minggu',
                                                ];
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
                                                        'jenis' => $jadwal->status,
                                                    ];
                                                    array_push($schedules, $j);
                                                }
                                            @endphp
                                            @foreach ($schedules as $schedule)
                                                @if ($schedule['day'] == $days[$day - 1] && $time == intval(substr($schedule['start'], 0, 2)))
                                                    @php
                                                        // Calculate the duration of the schedule in hours
                                                        $startHour = intval(substr($schedule['start'], 0, 2));
                                                        $endHour = intval(substr($schedule['end'], 0, 2));
                                                        $duration = $endHour - $startHour;

                                                        // Define color class based on the class
                                                        $colorClass = match ($schedule['kelas']) {
                                                            'A' => 'bg-blue-50 border-blue-600 text-blue-600',
                                                            'B' => 'bg-red-50 border-red-600 text-red-600',
                                                            'C' => 'bg-green-50 border-green-600 text-green-600',
                                                            'D' => 'bg-purple-50 border-purple-600 text-purple-600',
                                                            default => 'bg-gray-50 border-gray-600 text-gray-600',
                                                        };
                                                    @endphp

                                                    <button
                                                        class="rounded p-1.5 border-l-2 {{ $colorClass }} w-full text-left my-2"
                                                        style="grid-row: span {{ $duration }};"
                                                        @click="showModal = true; selectedSchedule = {{ json_encode($schedule) }}">
                                                        <p class="text-xs font-normal mb-px">{{ $schedule['title'] }}</p>
                                                        <p class="text-xs font-semibold">{{ $schedule['start'] }} -
                                                            {{ $schedule['end'] }}</p>
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
                            <button
                                class="text-white bg-blue-800 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                type="button" data-drawer-target="drawer-right-example"
                                data-drawer-show="drawer-right-example" data-drawer-placement="right"
                                aria-controls="drawer-right-example">
                                IRS
                            </button>
                        </div>

                        <!-- drawer component -->
                        <div id="drawer-right-example"
                            class="rounded-xl fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-gray-800"
                            tabindex="-1" aria-labelledby="drawer-right-label">
                            <h1 id="drawer-right-label"
                                class="inline-flex items-center mb-4 ml-2 text-base font-bold text-black">Matakuliah Yang
                                Dipilih</h1>
                            <button type="button" data-drawer-hide="drawer-right-example"
                                aria-controls="drawer-right-example"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 1l12 12M1 13L13 1" />
                                </svg>
                                <span class="sr-only">Close menu</span>
                            </button>

                            <!-- Tabel Mata Kuliah yang Dipilih -->
                            <div class="mt-4 overflow-x-auto p-2 rounded-lg font-poppins">
                                <table class="min-w-full table-auto border-collapse text-sm">
                                    <thead class="bg-[#5932EA] text-white">
                                        <tr>
                                            <th class="border px-4 py-2 text-left">Nama MK</th>
                                            <th class="border px-4 py-2 text-left">Kode MK</th>
                                            <th class="border px-4 py-2 text-left">SKS</th>
                                            <th class="border px-4 py-2 text-left">Kelas</th>
                                            <th class="border px-4 py-2 text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="(schedule, index) in selectedSchedules" :key="schedule.kode_mk">
                                            <tr class="hover:bg-gray-100 transition-colors">
                                                <td class="border px-4 py-2" x-text="schedule.title"></td>
                                                <td class="border px-4 py-2" x-text="schedule.kode_mk"></td>
                                                <td class="border px-4 py-2" x-text="schedule.sks"></td>
                                                <td class="border px-4 py-2" x-text="schedule.kelas"></td>
                                                <!-- Trash Icon -->
                                                <td class="border px-4 py-2 text-center">
                                                    <button @click="selectedSchedules.splice(index, 1)"
                                                        class="text-red-600 hover:text-red-800">
                                                        <!-- Trash Icon SVG -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2h1v10a2 2 0 002 2h6a2 2 0 002-2V6h1a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zm1 4a1 1 0 011 1v7a1 1 0 11-2 0V7a1 1 0 011-1zM7 7a1 1 0 10-2 0v7a1 1 0 102 0V7zm8 0a1 1 0 10-2 0v7a1 1 0 102 0V7z" />
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex items-center justify-between px-2 mt-4">
                                <div class="text-lg font-semibold">
                                    Total SKS: <span
                                        x-text="selectedSchedules.reduce((total, schedule) => total + schedule.sks, 0)"
                                        class="text-blue-600"></span>
                                </div>
                                <button class="px-5 py-2 bg-[#000CB0] rounded-xl text-white font-poppins font-semibold">
                                    Ajukan
                                </button>
                            </div>
                        </div>


                    </section>
                    <!-- Modal for displaying schedule details -->
                    <div x-show="showModal"
                        class="fixed inset-0 z-50 flex items-center justify-center min-h-screen px-4 text-center">
                        <!-- Overlay -->
                        <div class="fixed inset-0 bg-gray-900 opacity-60"></div>

                        <!-- Modal Content -->
                        <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-6 relative transform transition-all">
                            <!-- Close Button -->
                            <button @click="showModal = false"
                                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <!-- Modal Header -->
                            <div class="mb-4">
                                <h3 class="text-xl font-semibold text-gray-800" x-text="selectedSchedule.title"></h3>
                                <p class="text-gray-500">Detail informasi mengenai mata kuliah yang dipilih</p>
                            </div>

                            <!-- Modal Body -->
                            <div class="space-y-2 text-gray-600">
                                <p><span class="font-semibold">Kode MK:</span> <span
                                        x-text="selectedSchedule.kode_mk"></span></p>
                                <p><span class="font-semibold">SKS:</span> <span x-text="selectedSchedule.sks"></span></p>
                                <p><span class="font-semibold">Kelas:</span> <span x-text="selectedSchedule.kelas"></span>
                                </p>
                                <p><span class="font-semibold">Hari:</span> <span x-text="selectedSchedule.day"></span>
                                </p>
                                <p><span class="font-semibold">Waktu:</span> <span x-text="selectedSchedule.start"></span>
                                    - <span x-text="selectedSchedule.end"></span></p>
                                <p><span class="font-semibold">Ruangan:</span> <span
                                        x-text="selectedSchedule.ruangan"></span></p>
                                <p><span class="font-semibold">Jenis:</span> <span x-text="selectedSchedule.jenis"></span>
                                </p>
                                <p><span class="font-semibold">Kapasitas:</span> <span
                                        x-text="selectedSchedule.kapasitas"></span></p>
                            </div>

                            <!-- Modal Footer -->
                            <div class="mt-6 flex justify-center">
                                <button @click="selectedSchedules.push(selectedSchedule); showModal = false"
                                    class="bg-blue-600 text-white px-8 rounded-lg py-4 hover:bg-blue-700 transition-colors">
                                    Pilih
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function updateClock() {
                const clockElement = document.getElementById('real-time-clock');
                const now = new Date();
                const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
                const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
                    "Oktober", "November", "Desember"
                ];

                const dayName = days[now.getDay()];
                const monthName = months[now.getMonth()];
                const day = String(now.getDate()).padStart(2, '0');
                const year = now.getFullYear();

                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');

                clockElement.innerText = `${dayName}, ${day} ${monthName} ${year} | ${hours} : ${minutes} : ${seconds}`;
            }

            setInterval(updateClock, 1000);
            updateClock();
        </script>

    </div>
@endsection
