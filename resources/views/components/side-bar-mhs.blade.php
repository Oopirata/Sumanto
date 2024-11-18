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
                <span class="material-icons"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                </svg></span>
                <span class="ml-2 text-sm">Dashboard</span>
            </a>

            <!-- Registrasi -->
            <div x-data="{ open: false }" class="relative mx-5 mt-4">
                <button @click="open = !open" class="flex items-center px-6 py-2 w-full text-gray-600 hover:bg-[#5932EA] focus:bg-[#5932EA] hover:text-white focus:text-white rounded-lg transition-all focus:outline-none mb-2">
                    <span class="material-icons"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                        <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                        <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
                    </svg></span>
                    <span class="ml-2 text-sm">Registrasi</span>
                    <svg class="ml-auto h-5 w-5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div x-show="open" class="mt-2 space-y-1 pl-6">
                    <div class="flex items-center my-5">
                        <a href="/mhs/bayar" class="ml-2 text-sm text-gray-600 hover:text-blue-600 transition-colors">Biaya Kuliah</a>
                    </div>
                    <div class="flex items-center my-5">
                        <a href="/mhs/status" class="ml-2 text-sm text-gray-600 hover:text-blue-600 transition-colors">Status kuliah</a>
                    </div>
                </div>
            </div>

            <!-- Akademik -->
            <!-- Akademik (Dropdown) -->
            <div x-data="{ open: false }" class="relative mx-5 mt-4">
                <button @click="open = !open" class="flex items-center px-6 py-2 w-full text-gray-600 hover:bg-[#5932EA] focus:bg-[#5932EA] hover:text-white focus:text-white rounded-lg transition-all focus:outline-none mb-2">
                    <span class="material-icons"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mortarboard" viewBox="0 0 16 16">
                    <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917zM8 8.46 1.758 5.965 8 3.052l6.242 2.913z"/>
                    <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46z"/>
                    </svg></span>
                    <span class="ml-2 text-sm">Akademik</span>
                    <svg class="ml-auto h-5 w-5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Dropdown Items -->
                <div x-show="open" class="mt-2 pl-6">
                    <div class="flex items-center my-5">
                        <a href="/mhs/BuatIrs" class="ml-2 text-sm text-gray-600 hover:text-blue-600 transition-colors">Buat IRS</a>
                    </div>
                    <div class="flex items-center my-5">
                        <a href="/mhs/irs" class="ml-2 text-sm text-gray-600 hover:text-blue-600 transition-colors">IRS</a>
                    </div>
                    <div class="flex items-center my-5">
                        <a href="/mhs/khs" class="ml-2 text-sm text-gray-600 hover:text-blue-600 transition-colors">KHS</a>
                    </div>
                    <div class="flex items-center my-5">
                        <a href="/mhs/transkrip" class="ml-2 text-sm text-gray-600 hover:text-blue-600 transition-colors">Transkrip</a>
                    </div>
                </div>
            </div>
        </div>
            <!-- Profile (di bagian bawah sidebar) -->
            <div class="px-6 py-4 flex items-center">
            <img src="https://via.placeholder.com/40" alt="Profile Image" class="rounded-full h-10 w-10">
            <div class="ml-4">
                <p class="text-sm font-medium">{{ $mahasiswa ->nama }}</p>
                <p class="text-xs text-gray-600">{{ $mahasiswa -> nim }} - Informatika S1</p>
            </div>
        </div>
    </aside>
</div>