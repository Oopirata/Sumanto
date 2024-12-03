@extends('main')

@section('title', 'Presensi Mahasiswa')

@section('page')
<div class="bg-gray-100 h-screen flex flex-col">
    <div class="flex overflow-hidden">
        <x-side-bar-ba :dosen="$dosen" :dosens="$dosens"></x-side-bar-ba>
        <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar :dosens="$dosens" :dosen="$dosen"></x-nav-bar>
            <div class="border-b-4"></div>
            <div class="bg-white px-4 py-8 rounded-xl mx-8 mt-8 flex items-center justify-between">
                <div class="font-semibold text-xl">Presensi Mahasiswa</div>
                <!-- Dropdown Section (Right aligned) -->
                <div class="flex space-x-4 items-center">
                    <div>
                        <div x-data="{ open: false, selected: 'Strata' }" class="relative">
                            <button @click="open = !open" class="bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center justify-between w-40">
                                <span x-text="selected"></span>
                                <svg class="w-4 h-4 transform transition-transform" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <!-- Dropdown menu with smooth transition -->
                            <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="absolute mt-2 w-40 bg-white rounded-md shadow-lg z-10">
                                <ul class="py-2">
                                    <li><button @click="selected = 'S1'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">S1</button></li>
                                    <li><button @click="selected = 'S2'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">S2</button></li>
                                    <li><button @click="selected = 'S3'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">S3</button></li>
                                    <li><button @click="selected = 'D3'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">D3</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div x-data="{ open: false, selected: 'Jurusan' }" class="relative">
                            <button @click="open = !open" class="bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center justify-between w-40">
                                <span x-text="selected"></span>
                                <svg class="w-4 h-4 transform transition-transform" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <!-- Dropdown menu with smooth transition -->
                            <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="absolute mt-2 w-40 bg-white rounded-md shadow-lg z-10">
                                <ul class="py-2">
                                    <li><button @click="selected = 'Informatika'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">Informatika</button></li>
                                    <li><button @click="selected = 'Fisika'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">Fisika</button></li>
                                    <li><button @click="selected = 'Kimia'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">Kimia</button></li>
                                    <li><button @click="selected = 'Matematika'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">Matematika</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div x-data="{ open: false, selected: 'Tahun' }" class="relative">
                            <button @click="open = !open" class="bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center justify-between w-40">
                                <span x-text="selected"></span>
                                <svg class="w-4 h-4 transform transition-transform" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <!-- Dropdown menu with smooth transition -->
                            <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="absolute mt-2 w-40 bg-white rounded-md shadow-lg z-10">
                                <ul class="py-2">
                                    <li><button @click="selected = '2021'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">2021</button></li>
                                    <li><button @click="selected = '2022'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">2022</button></li>
                                    <li><button @click="selected = '2023'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">2023</button></li>
                                    <li><button @click="selected = '2024'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">2024</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 p-8 mx-8 bg-white rounded-xl shadow-md overflow-hidden" style="max-height: 550px;">
                <div class="flex justify-between mb-4">
                    <div>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-full mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                            <span>Search</span>
                        </button>
                        <input type="text" class="bg-gray-100 px-4 py-2 rounded-full w-64 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="Search students">
                    </div>
                </div>
                <table class="min-w-full bg-white border rounded-lg shadow-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-6 text-left text-xs font-medium text-gray-600">No</th>
                            <th class="py-3 px-6 text-left text-xs font-medium text-gray-600">Nama</th>
                            <th class="py-3 px-6 text-left text-xs font-medium text-gray-600">NIM</th>
                            <th class="py-3 px-6 text-center text-xs font-medium text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="border-b">
                            <td class="py-4 px-6 text-sm">1</td>
                            <td class="py-4 px-6 text-sm">Muhammad Mirza Faiz Rabbani</td>
                            <td class="py-4 px-6 text-sm">24060122140127</td>
                            <td class="py-4 px-6 text-center">
                                <button class="btn-izin bg-[#000CB0] text-white px-3 py-1 rounded-full mr-2" onclick="setIzin(this)">Izin</button>
                                <button class="btn-hadir bg-[#4BD37B] text-white px-3 py-1 rounded-full mr-2" onclick="setHadir(this)">Hadir</button>
                                <button class="btn-tidak bg-red-600 text-white px-3 py-1 rounded-full mr-2" onclick="setTidak(this)">Tidak</button>
                                <button class="btn-reset bg-gray-500 text-white px-3 py-1 rounded-full" onclick="resetStatus(this)">Reset</button>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-4 px-6 text-sm">2</td>
                            <td class="py-4 px-6 text-sm">Andi Sulistyo</td>
                            <td class="py-4 px-6 text-sm">24060122140128</td>
                            <td class="py-4 px-6 text-center">
                                <button class="btn-izin bg-[#000CB0] text-white px-3 py-1 rounded-full mr-2" onclick="setIzin(this)">Izin</button>
                                <button class="btn-hadir bg-[#4BD37B] text-white px-3 py-1 rounded-full mr-2" onclick="setHadir(this)">Hadir</button>
                                <button class="btn-tidak bg-red-600 text-white px-3 py-1 rounded-full mr-2" onclick="setTidak(this)">Tidak</button>
                                <button class="btn-reset bg-gray-500 text-white px-3 py-1 rounded-full" onclick="resetStatus(this)">Reset</button>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-4 px-6 text-sm">3</td>
                            <td class="py-4 px-6 text-sm">Siti Khadijah</td>
                            <td class="py-4 px-6 text-sm">24060122140129</td>
                            <td class="py-4 px-6 text-center">
                                <button class="btn-izin bg-[#000CB0] text-white px-3 py-1 rounded-full mr-2" onclick="setIzin(this)">Izin</button>
                                <button class="btn-hadir bg-[#4BD37B] text-white px-3 py-1 rounded-full mr-2" onclick="setHadir(this)">Hadir</button>
                                <button class="btn-tidak bg-red-600 text-white px-3 py-1 rounded-full mr-2" onclick="setTidak(this)">Tidak</button>
                                <button class="btn-reset bg-gray-500 text-white px-3 py-1 rounded-full" onclick="resetStatus(this)">Reset</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function setIzin(button) {
        const row = button.closest('tr');
        const hadirButton = row.querySelector('.btn-hadir');
        const tidakButton = row.querySelector('.btn-tidak');

        hadirButton.classList.add('opacity-50', 'pointer-events-none');
        tidakButton.classList.add('opacity-50', 'pointer-events-none');

        button.innerText = "Izin";
        button.classList.remove("bg-[#000CB0]");
        button.classList.add("bg-[#000CB0]", "text-white");
        button.disabled = true;
    }

    function setHadir(button) {
        const row = button.closest('tr');
        const izinButton = row.querySelector('.btn-izin');
        const tidakButton = row.querySelector('.btn-tidak');

        izinButton.classList.add('opacity-50', 'pointer-events-none');
        tidakButton.classList.add('opacity-50', 'pointer-events-none');

        button.innerText = "Hadir";
        button.classList.remove("bg-[#4BD37B]");
        button.classList.add("bg-green-600", "text-white");
        button.disabled = true;
    }

    function setTidak(button) {
        const row = button.closest('tr');
        const izinButton = row.querySelector('.btn-izin');
        const hadirButton = row.querySelector('.btn-hadir');

        izinButton.classList.add('opacity-50', 'pointer-events-none');
        hadirButton.classList.add('opacity-50', 'pointer-events-none');

        button.innerText = "Tidak";
        button.classList.remove("bg-red-600");
        button.classList.add("bg-red-800", "text-white");
        button.disabled = true;
    }

    function resetStatus(button) {
        const row = button.closest('tr');
        const izinButton = row.querySelector('.btn-izin');
        const hadirButton = row.querySelector('.btn-hadir');
        const tidakButton = row.querySelector('.btn-tidak');

        // Remove disabled state and opacity from all buttons
        izinButton.classList.remove('opacity-50', 'pointer-events-none');
        hadirButton.classList.remove('opacity-50', 'pointer-events-none');
        tidakButton.classList.remove('opacity-50', 'pointer-events-none');

        // Restore the initial button states
        izinButton.disabled = false;
        hadirButton.disabled = false;
        tidakButton.disabled = false;

        izinButton.classList.remove('bg-[#000CB0]', 'text-white');
        izinButton.classList.add('bg-[#000CB0]', 'text-white');

        hadirButton.classList.remove('bg-green-600', 'text-white');
        hadirButton.classList.add('bg-[#4BD37B]', 'text-white');

        tidakButton.classList.remove('bg-red-800', 'text-white');
        tidakButton.classList.add('bg-red-600', 'text-white');
    }
</script>
@endsection