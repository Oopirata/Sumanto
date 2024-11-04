@extends('main')

@section('title', 'Buat IRS')

@section('page')
<div class="bg-gray-100 min-h-screen flex flex-col">
    <div class="flex overflow-hidden">
        <x-side-bar-mhs></x-side-bar-mhs>
        <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar></x-nav-bar>

            <!-- Main container for IRS creation -->
            <div class="p-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm">
                <div class="flex justify-between items-center">
                    <h1 class="text-black font-bold">Buat IRS</h1>
                    <div class="text-sm text-green-500 font-semibold">Saatnya Isi IRS!</div>
                </div>

                <!-- Sidebar and Course List -->
                <div class="flex mt-4">
                    <div class="w-1/4 bg-white p-4 border-r border-gray-200">
                        <h2 class="text-gray-800 font-semibold mb-4">Semester 5</h2>

                        <!-- Search Bar for Filtering Courses -->
                        <div class="relative mb-4">
                            <input type="text" id="courseSearch" placeholder="Cari Matakuliah..."
                                class="w-full p-2 border rounded-md" onkeyup="searchCourses()">
                        </div>

                        <!-- Course List -->
                        <ul id="courseList" class="space-y-2">
                            @php
                                $schedules = [
                                    ['name' => 'Sistem Informasi', 'code' => 'PAIK6503', 'sks' => 3, 'description' => 'Belajar tentang sistem informasi.', 'day' => 1, 'time' => '10:00 - 11:30', 'kelas' => 'C', 'ruangan' => 'E102'],
                                    ['name' => 'Kewirausahaan', 'code' => 'UNW00007', 'sks' => 2, 'description' => 'Dasar-dasar kewirausahaan.', 'day' => 2, 'time' => '07:30 - 09:20', 'kelas' => 'A', 'ruangan' => 'E103'],
                                    ['name' => 'Proyek Perangkat Lunak', 'code' => 'PAIK6504', 'sks' => 3, 'description' => 'Manajemen proyek perangkat lunak.', 'day' => 3, 'time' => '10:00 - 11:30', 'kelas' => 'B', 'ruangan' => 'E104'],
                                    ['name' => 'Keamanan dan Jaminan Informasi', 'code' => 'PAIK6506', 'sks' => 3, 'description' => 'Keamanan data dan informasi.', 'day' => 4, 'time' => '08:30 - 10:00', 'kelas' => 'C', 'ruangan' => 'E105'],
                                    ['name' => 'Pengembangan Berbasis Platform', 'code' => 'PAIK6501', 'sks' => 4, 'description' => 'Pengembangan aplikasi berbasis platform.', 'day' => 5, 'time' => '09:00 - 10:30', 'kelas' => 'D', 'ruangan' => 'E106'],
                                    ['name' => 'Komputasi Terdistribusi dan Paralel', 'code' => 'PAIK6502', 'sks' => 3, 'description' => 'Konsep komputasi terdistribusi.', 'day' => 6, 'time' => '10:30 - 12:00', 'kelas' => 'A', 'ruangan' => 'E107'],
                                    ['name' => 'Pembelajaran Mesin', 'code' => 'PAIK6505', 'sks' => 3, 'description' => 'Pengenalan pembelajaran mesin.', 'day' => 7, 'time' => '08:00 - 09:30', 'kelas' => 'B', 'ruangan' => 'E108'],
                                ];
                            @endphp
                            @foreach ($schedules as $schedule)
                                <li id="course-{{ $schedule['code'] }}" class="course-item flex items-center p-2 border rounded-md bg-gray-50">
                                    <button onclick="toggleCourse('{{ $schedule['code'] }}')" class="mr-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 2C7.03 2 2.61 5.82 1 10.5a11.9 11.9 0 0010 7.5 11.9 11.9 0 0010-7.5c-1.61-4.68-6.03-8.5-10-8.5z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </button>
                                    <div>
                                        <p class="font-semibold">{{ $schedule['name'] }}</p>
                                        <p class="text-xs text-gray-600">{{ $schedule['code'] }} ({{ $schedule['sks'] }} SKS)</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        

                            <!-- drawer init and toggle -->
                            <div class="text-center">
                            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="button" data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example" data-drawer-placement="right" aria-controls="drawer-right-example">
                            List
                            </button>
                            </div>

                            <!-- drawer component -->
                            <div id="drawer-right-example" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
                                <h5 id="drawer-right-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>List pelajaran</h5>
                            <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close menu</span>
                            </button>
                            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">Supercharge your hiring by taking advantage of our <a href="#" class="text-blue-600 underline font-medium dark:text-blue-500 hover:no-underline">limited-time sale</a> for Flowbite Docs + Job Board. Unlimited access to over 190K top-ranked candidates and the #1 design job board.</p>
                            <div class="grid grid-cols-2 gap-4">
                                <a href="#" class="px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Learn more</a>
                                <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Get access <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg></a>
                            </div>
                            </div>

                    </div>

                    <!-- Weekly Schedule Grid -->
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
                                        @foreach ($schedules as $schedule)
                                            @php
                                                // Ambil jam mulai dan jam selesai dari 'time'
                                                [$start, $end] = explode(' - ', $schedule['time']);
                                            @endphp
                                            @if ($schedule['day'] == $day &&  $time >= intval(substr($start, 0, 2)) && $time < intval(substr($end, 0, 2)))
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
                                                        onclick="showCourseModal('{{ $schedule['name'] }}', '{{ $schedule['ruangan'] }}', '{{ $schedule['kelas'] }}', '{{ $day }}', '{{ $time }}')">
                                                    <p class="text-xs font-normal mb-px">{{ $schedule['name'] }}</p>
                                                    <p class="text-xs">{{ $schedule['ruangan'] }} | {{ $schedule['kelas'] }}</p>
                                                </button>
                                            @endif
                                        @endforeach
                                    </div>
                                @endfor
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function searchCourses() {
    const input = document.getElementById('courseSearch').value.toLowerCase();
    const courseItems = document.querySelectorAll('.course-item');

    courseItems.forEach(item => {
        const courseName = item.querySelector('p').innerText.toLowerCase();
        if (courseName.includes(input)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}

function toggleCourse(code) {
    const courseElement = document.getElementById(`course-${code}`);
    // Implement toggle functionality as needed
}

function showCourseModal(name, room, classType, day, time) {
    alert(`Mata Kuliah: ${name}\nRuangan: ${room}\nKelas: ${classType}\nHari: ${day}\nJam: ${time}`);
}
</script>
@endsection
