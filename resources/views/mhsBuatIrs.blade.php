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
                    <div class="text-sm text-red-500 font-semibold">Belum Saatnya Isi IRS!</div>
                </div>

                <!-- Sidebar and Course List -->
                <div class="flex mt-4">
                    <div class="w-1/4 bg-white p-4 border-r border-gray-200">
                        <div class="bg-purple-500 px-2 py-1 rounded-3xl">
                            <h2 class="text-white font-semibold text-center">Semester 5</h2>
                        </div>
                        <!-- Search Bar for Filtering Courses -->
                        <div class="relative mb-4 mt-5">
                            <input type="text" id="courseSearch" placeholder="Cari Matakuliah..."
                                class="w-full p-2 border rounded-md" onkeyup="searchCourses()">
                        </div>

                        <!-- Course List -->
                        <ul id="courseList" class="space-y-2">
                            @php
                            $courses = $jadwals->unique('kode_mk')->map(function ($jadwal) {
                                return [
                                    'code' => $jadwal->kode_mk,
                                    'name' => $jadwal->nama_mk,
                                ];
                            })->values()->toArray();

                            $irss = $irs->unique('kode_mk')->map(function ($irs) {
                                return [
                                    'code' => $irs->kode_mk,
                                    'sks' => $irs->sks,
                                ];
                            })->values()->toArray();
                            @endphp

                            @foreach ($courses as $course)
                                @php
                                    $irsItem = collect($irss)->firstWhere('code', $course['code']);
                                @endphp
                                <li id="course-{{ $course['code'] }}" class="course-item flex items-center p-2 border rounded-md bg-gray-50" data-sks="{{ $irsItem ? $irsItem['sks'] : 0 }}">
                                    <button onclick="toggleCourse('{{ $course['code'] }}')" class="mr-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M12 2C7.03 2 2.61 5.82 1 10.5a11.9 11.9 0 0010 7.5 11.9 11.9 0 0010-7.5c-1.61-4.68-6.03-8.5-10-8.5z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </button>
                                    <div>
                                        <p class="font-semibold">{{ $course['name'] }}</p>
                                        <p class="text-xs text-gray-600">
                                            {{ $course['code'] }} (SMT 5) ({{ $irsItem ? $irsItem['sks'] : 'N/A' }} SKS)
                                        </p>
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
                        <!-- Header row for days of the week and time slot -->
                        <div class="grid grid-cols-7 bg-white border-t border-gray-200 sticky top-0 left-0 w-full">
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Jam
                            </div> <!-- Time header -->
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Senin
                            </div>
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Selasa
                            </div>
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Rabu
                            </div>
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Kamis
                            </div>
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Jumat
                            </div>
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Sabtu
                            </div>
                        </div>

                        <!-- Time slots and courses -->
                        @for ($time = 7; $time <= 15; $time += 1) <!-- Adjust times as needed -->
                            <div class="grid grid-cols-7 border-t border-gray-200">
                                <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">
                                    {{ $time }}:00 - {{ $time + 1 }}:00</div>

                                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $day)
                                    <div class="flex items-center justify-center p-2 border-r border-gray-200">
                                        @php
                                            // Cari course pada hari dan jam yang sesuai
                                            $courses = $jadwals->where('hari', $day)->where('jam_mulai', $time . ':00');
                                        @endphp

                                        @if ($courses->isNotEmpty())
                                            <!-- Tampilkan semua course yang sesuai -->
                                            @foreach ($courses as $course)
                                                <div class="rounded-lg bg-blue-100 text-blue-900 text-sm font-semibold p-2 course-slot"
                                                    data-code="{{ $course->kode_mk }}" data-day="{{ $day }}" data-time="{{ $time }}"
                                                    onclick="showCourseModal('{{ $course->nama_mk }}', '{{ $course->kode_mk }}', '{{ $day }}', '{{ $time }}')">
                                                    {{ $course->nama_mk }}<br>{{ $course->sks }} SKS
                                                </div>
                                            @endforeach
                                        @else
                                            <!-- Tampilkan "Kosong" hanya jika tidak ada course yang ditemukan -->
                                            <div class="text-sm text-gray-500">Kosong</div>
                                        @endif
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

<!-- Modal for Course Description -->
<div id="courseModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 id="modalCourseName" class="text-lg font-semibold"></h2>
            <p id="modalCourseDescription" class="mt-2"></p>
            <div class="mt-4">
                <button onclick="document.getElementById('courseModal').classList.add('hidden');"
                    class="bg-gray-200 px-4 py-2 rounded mr-2">Batal</button>
                <button id="selectCourseButton" class="bg-blue-500 text-white px-4 py-2 rounded">Pilih</button>
            </div>
        </div>
    </div>
</div>

<script>
    const selectedCourses = {};

    // Toggle visibility of course items and search
    function toggleCourse(code) {
        const courseItem = document.getElementById('course-' + code);
        courseItem.classList.toggle('hidden');
        searchCourses(); // Re-check visibility on search
    }

    // Function to show course modal with additional parameters
    function showCourseModal(name, description, code, day, time) {
        document.getElementById('modalCourseName').innerText = name;
        document.getElementById('modalCourseDescription').innerText = description;
        document.getElementById('selectCourseButton').onclick = function () {
            selectCourse(code, day, time);
            document.getElementById('courseModal').classList.add('hidden');
        };
        document.getElementById('courseModal').classList.remove('hidden');
    }

    // Select course and manage schedule for specific day and time
    function selectCourse(code, day, time) {
        // Mark the course as selected
        selectedCourses[code] = selectedCourses[code] || [];

        // Add the selected time and day to the array
        if (!selectedCourses[code].some(slot => slot.day === day && slot.time === time)) {
            selectedCourses[code].push({ day: day, time: time });

            // Hide the course in the schedule only for that specific day and time
            const courseElement = document.querySelector(`.course-slot[data-code='${code}'][data-day='${day}'][data-time='${time}']`);
            if (courseElement) {
                courseElement.style.display = 'none'; // Hide the selected slot
            }

            alert("Course " + code + " selected for " + day + " at " + time + ":00!");
        } else {
            alert("Course " + code + " is already selected for " + day + " at " + time + ":00.");
        }
    }


</script>
@endsection
