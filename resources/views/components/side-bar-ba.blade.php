<div class="flex h-screen font-poppins">
    <!-- Sidebar Blade Template -->
    <aside class="flex flex-col w-64 bg-white shadow-lg fixed top-0 left-0 h-full z-10" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
        <!-- Logo and Dashboard Title -->
        <div class="flex items-center justify-center h-24 mx-5 bg-white px-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-[70px] h-[70px] object-contain">
            <span class="text-blue-600 text-2xl font-extrabold ml-4 tracking-wide">Dashboard</span>
        </div>

        <!-- Menu Items -->
        <div class="flex flex-col mt-6 flex-grow margin-bottom: 50px;">
            <!-- Dashboard -->
            <a href="/mhs/dashboard" class="inline-flex items-center mx-5 px-6 py-2 text-gray-600 hover:bg-[#5932EA] focus:bg-[#5932EA] hover:text-white focus:text-white rounded-lg transition-all mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5M9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8m1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5m-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96q.04-.245.04-.5M7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0"/>
                  </svg>
                <span class="ml-2 text-sm">IRS</span>
            </a>

            <!-- Registrasi -->
                <a href="/mhs/dashboard" class="inline-flex items-center mx-5 px-6 py-2 mt-4 text-gray-600 hover:bg-[#5932EA] focus:bg-[#5932EA] hover:text-white focus:text-white rounded-lg transition-all mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5M9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8m1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5m-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96q.04-.245.04-.5M7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0"/>
                      </svg>
                    <span class="ml-2 text-sm">Perkuliahan</span>
                </a>


            <!-- Akademik -->
            <!-- Akademik (Dropdown) -->
            <div x-data="{ open: false }" class="relative mx-5 mt-4">
                <button @click="open = !open" class="flex items-center px-6 py-2 w-full text-gray-600 hover:bg-[#5932EA] focus:bg-[#5932EA] hover:text-white focus:text-white rounded-lg transition-all focus:outline-none mb-2">
                    <span class="material-icons"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mortarboard" viewBox="0 0 16 16">
                    <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917zM8 8.46 1.758 5.965 8 3.052l6.242 2.913z"/>
                    <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46z"/>
                    </svg></span>
                    <span class="ml-2 text-sm">Manaj.Mahasiswa</span>
                    <svg class="ml-auto h-5 w-5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Dropdown Items -->
                <div x-show="open" class="mt-2 pl-6">
                    <div class="flex items-center my-5">
                        <a href="/mhs/BuatIrs" class="ml-2 text-sm text-gray-600 hover:text-blue-600 transition-colors">Presensi Mahasiswa</a>
                    </div>
                    <div class="flex items-center my-5">
                        <a href="/mhs/irs" class="ml-2 text-sm text-gray-600 hover:text-blue-600 transition-colors">SKS Mahasiswa</a>
                    </div>
                    <div class="flex items-center my-5">
                        <a href="/mhs/khs" class="ml-2 text-sm text-gray-600 hover:text-blue-600 transition-colors">Nilai Mahasiswa</a>
                    </div>
                </div>
            </div>
        </div>
            <!-- Profile (di bagian bawah sidebar) -->
            <div class="px-6 py-4 flex items-center">
            <img src="https://via.placeholder.com/40" alt="Profile Image" class="rounded-full h-10 w-10">
            <div class="ml-4">
                <p class="text-sm font-medium">Suteyo Tejo</p>
                <p class="text-xs text-gray-600">100184433</p>
                <p class="text-xs text-gray-600">Admin Akademik</p>
            </div>
        </div>
    </aside>
</div>