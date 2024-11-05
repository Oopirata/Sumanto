@extends('main')

@section('title', 'Buat IRS')

@section('page')
<div class="bg-gray-100 min-h-screen flex flex-col">
    <div class="flex overflow-hidden">
        <x-side-bar-mhs :mahasiswa="$mahasiswa"></x-side-bar-mhs>
        <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar></x-nav-bar>

            <!-- Header Section -->
            <div class="bg-white border rounded-3xl shadow-sm flex justify-between items-center p-8 mx-8 mt-6">
                <h1 class="text-black font-bold text-2xl">Buat IRS</h1>
            </div>

            <!-- Main IRS Creation Container -->
            <div class="p-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm">
                <!-- Course List Table -->
                <div class="w-full p-4">
                    <h2 class="font-semibold text-xl mb-4">Daftar Matakuliah</h2>
                    <div class="relative my-4">
                        <input type="text" id="courseSearch" placeholder="Cari Matakuliah..." class="w-full p-2 border rounded-md" onkeyup="searchCourses()">
                    </div>
                    <table class="w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-2 text-sm font-medium text-gray-900 border">Kode MK</th>
                                <th class="p-2 text-sm font-medium text-gray-900 border">Nama MK</th>
                                <th class="p-2 text-sm font-medium text-gray-900 border">SKS</th>
                                <th class="p-2 text-sm font-medium text-gray-900 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="courseList">
                            @foreach ($courses as $course)
                                @php
                                    // Get the schedule for the current course
                                    $courseSchedules = $jadwals->where('kode_mk', $course->kode_mk);
                                @endphp
                                @foreach ($courseSchedules as $schedule)
                                    <tr id="course-{{ $course->kode_mk }}" class="course-item">
                                        <td class="p-2 border">{{ $course->kode_mk }}</td>
                                        <td class="p-2 border">{{ $course->nama_mk }}</td>
                                        <td class="p-2 border">{{ $course->sks }}</td>
                                        <td class="p-2 border text-center">
                                            <button onclick="showCourseModal('{{ $course->kode_mk }}', '{{ $course->nama_mk }}', {{ $course->sks }}, '{{ $schedule->hari }}', '{{ $schedule->jam_mulai }}', '{{ $schedule->jam_selesai }}', '{{ $schedule->ruang }}', {{ $schedule->kapasitas }})" class="bg-blue-500 text-white px-2 py-1 rounded">Pilih</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Selected Courses Table -->
                <div class="w-full mt-6 p-4">
                    <h2 class="font-semibold text-xl mb-4">Matakuliah yang Dipilih</h2>
                    <table class="w-full border-t border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-2 font-normal">Kode MK</th>
                                <th class="p-2 font-normal">Nama MK</th>
                                <th class="p-2 font-normal">SKS</th>
                            </tr>
                        </thead>
                        <tbody id="selectedCoursesTable"></tbody>
                    </table>
                    <div class="p-4">
                        <button class="bg-green-500 text-white px-4 py-2 rounded">Ajukan</button>
                    </div>
                </div>
            </div>

            <!-- Selected SKS Indicator -->
            <div id="sksIndicator" class="fixed bottom-4 right-4">
                <button class="bg-blue-500 text-white p-3 rounded-lg">0 SKS Dipilih</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Course Selection -->
<div id="courseModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg w-96">
        <h2 class="text-lg font-semibold mb-4">Detail Matakuliah</h2>
        <p><strong>Kode MK:</strong> <span id="modalKodeMK"></span></p>
        <p><strong>Nama MK:</strong> <span id="modalNamaMK"></span></p>
        <p><strong>SKS:</strong> <span id="modalSKS"></span></p>
        <p><strong>Hari:</strong> <span id="modalHari"></span></p>
        <p><strong>Jam Mulai:</strong> <span id="modalJamMulai"></span></p>
        <p><strong>Jam Selesai:</strong> <span id="modalJamSelesai"></span></p>
        <p><strong>Ruang:</strong> <span id="modalRuang"></span></p>
        <p><strong>Kapasitas:</strong> <span id="modalKapasitas"></span></p>

        <div class="mt-4">
            <label for="kelas" class="block font-medium">Pilih Kelas:</label>
            <select id="kelas" class="w-full p-2 border rounded-md">
                @foreach ($jadwals as $jadwal)
                    <option value="{{ $jadwal->kelas }}">{{ $jadwal->kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-6 flex justify-end">
            <button onclick="selectCourse()" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Pilih</button>
            <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
        </div>
    </div>
</div>

<script>
    let selectedCourses = [];
    let totalSKS = 0;

    function toggleCourse(kodeMK, sks, namaMK) {
        const index = selectedCourses.findIndex(course => course.kodeMK === kodeMK);

        if (index === -1) {
            selectedCourses.push({ kodeMK, sks, namaMK }); // Menyimpan namaMK juga
            totalSKS += sks;
        } else {
            selectedCourses.splice(index, 1);
            totalSKS -= sks;
        }

        updateSelectedCourses();
    }

    function updateSelectedCourses() {
        const selectedCoursesTable = document.getElementById('selectedCoursesTable');
        selectedCoursesTable.innerHTML = '';

        selectedCourses.forEach(course => {
            const row = `<tr>
                <td class="p-2 border">${course.kodeMK}</td>
                <td class="p-2 border">${course.namaMK}</td> <!-- Pastikan namaMK ditampilkan di sini -->
                <td class="p-2 border">${course.sks}</td>
            </tr>`;
            selectedCoursesTable.innerHTML += row;
        });

        document.getElementById('sksIndicator').innerHTML = `<button class="bg-blue-500 text-white p-3 rounded-lg">${totalSKS} SKS Dipilih</button>`;
    }

    function searchCourses() {
        const input = document.getElementById('courseSearch').value.toLowerCase();
        const courseItems = document.querySelectorAll('.course-item');

        courseItems.forEach(item => {
            const courseName = item.querySelectorAll('td')[1].textContent.toLowerCase();
            item.style.display = courseName.includes(input) ? '' : 'none';
        });
    }

    function showCourseModal(kodeMK, namaMK, sks, hari, jamMulai, jamSelesai, ruang, kapasitas) {
        document.getElementById('modalKodeMK').textContent = kodeMK;
        document.getElementById('modalNamaMK').textContent = namaMK;
        document.getElementById('modalSKS').textContent = sks;
        document.getElementById('modalHari').textContent = hari;
        document.getElementById('modalJamMulai').textContent = jamMulai;
        document.getElementById('modalJamSelesai').textContent = jamSelesai;
        document.getElementById('modalRuang').textContent = ruang;
        document.getElementById('modalKapasitas').textContent = kapasitas;

        document.getElementById('courseModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('courseModal').classList.add('hidden');
    }

    function selectCourse() {
        const kodeMK = document.getElementById('modalKodeMK').textContent;
        const sks = parseInt(document.getElementById('modalSKS').textContent);
        const namaMK = document.getElementById('modalNamaMK').textContent; // Ambil namaMK dari modal
        
        // Tambahkan mata kuliah ke dalam daftar yang dipilih
        toggleCourse(kodeMK, sks, namaMK); // Sertakan namaMK di sini

        // Tutup modal setelah pemilihan
        closeModal();
    }
</script>
@endsection
