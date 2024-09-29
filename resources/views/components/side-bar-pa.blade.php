<div class="flex h-screen font-poppins">
    <!-- Sidebar Blade Template -->
    <aside class="fixed flex flex-col w-64 bg-white shadow-lg h-full" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
        <!-- Logo dan Tulisan Dashboard Berdampingan -->
        <div class="flex items-center justify-center h-24 mx-5 bg-white px-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-[70px] h-[70px] object-contain">
            <span class="text-blue-600 text-2xl font-extrabold ml-4 tracking-wide">Dashboard</span>
        </div>

        <!-- Menu Items -->
        <div class="flex flex-col mt-6 flex-grow">
            <!-- Dashboard -->
            <a href="#" class="inline-flex items-center mx-5 px-6 py-2 text-gray-600 hover:bg-[#5932EA] focus:bg-[#5932EA] hover:text-white focus:text-white rounded-lg transition-all mb-2">
                <span class="material-icons">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                    </svg>
                </span>
                <span class="ml-2 text-sm">Dashboard</span>
            </a>

            <!-- Registrasi (Dropdown) -->
            <div x-data="{ open: false }" class="relative mx-5 mt-4">
                <button @click="open = !open" class="flex items-center px-6 py-2 w-full text-gray-600 hover:bg-[#5932EA] focus:bg-[#5932EA] hover:text-white focus:text-white rounded-lg transition-all focus:outline-none mb-2">
                    <span class="material-icons">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52z"/>
                        </svg>
                    </span>
                    <span class="ml-2 text-sm">Perwalian</span>
                    <svg class="ml-auto h-5 w-5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div x-show="open" class="mt-2 space-y-1 pl-6">
                    <a href="#" class="flex items-center my-4">
                        <input type="radio" name="akademik" class="form-radio text-purple-600" checked>
                        <label class="ml-2 text-sm text-gray-600">Mahasiswa</label>
                    </a>
                    <a href="#" class="flex items-center my-4">
                        <input type="radio" name="akademik" class="form-radio text-purple-600">
                        <label class="ml-2 text-sm text-gray-600">Ajuan IRS</label>
                    </a>
                </div>
            </div>

            <!-- Akademik (Input Nilai) -->
            <a href="#" class="inline-flex items-center mx-5 px-6 py-2 text-gray-600 hover:bg-[#5932EA] focus:bg-[#5932EA] hover:text-white focus:text-white rounded-lg transition-all mb-2">
                <span class="material-icons">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                    </svg>
                </span>
                <span class="ml-2 text-sm">Input Nilai</span>
            </a>
        </div>

        <!-- Profile (di bagian bawah sidebar) -->
        <div class="px-6 py-4 flex items-center">
            <img src="https://via.placeholder.com/40" alt="Profile Image" class="rounded-full h-10 w-10">
            <div class="ml-4">
                <p class="text-sm font-medium">Dul Samsi</p>
                <p class="text-xs text-gray-600">24060122120031 - Informatika S1</p>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="ml-64 flex-1 p-6">
        <!-- Your main content goes here -->
    </div>
</div>
