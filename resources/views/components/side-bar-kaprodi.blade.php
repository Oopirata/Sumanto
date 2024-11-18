<div class="flex h-screen font-poppins">
    <div class="flex flex-col w-64 bg-white shadow-lg h-full" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
        <!-- Logo dan Tulisan Dashboard Berdampingan -->
        <div class="flex items-center justify-center h-24 mx-5 bg-white px-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-[70px] h-[70px] object-contain">
            <span class="text-blue-600 text-2xl font-extrabold ml-4 tracking-wide">Dashboard</span>
        </div>
        <div class="flex flex-col mt-6 flex-grow mb-8">
            <!-- Link Sidebar -->
            <a href="/kaprodi/dashboard" class="inline-flex items-center mx-5 px-6 py-2 text-gray-600 hover:bg-[#5932EA] focus:bg-[#5932EA] hover:text-white focus:text-white rounded-lg transition-all mb-2">
                <span class="material-icons">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                    </svg>
                </span>
                <span class="ml-2 text-sm">Dashboard</span>
            </a>
            <!-- Dropdown Penjadwalan -->
            <div x-data="{ open: false }" class="mx-5">
                <a href="#" @click="open = !open" class="flex items-center px-6 py-2 text-gray-600 hover:bg-[#5932EA] focus:bg-[#5932EA] hover:text-white focus:text-white rounded-lg transition-all mb-2 w-full">
                    <span class="material-icons">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                            <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                        </svg>
                    </span>
                    <span class="ml-2 text-sm">Penjadwalan</span>
                    <span class="flex-shrink-0">
                        <svg x-show="!open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                        <svg x-show="open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                        </svg>
                    </span>
                </a>
                <!-- Dropdown items -->
                <div x-show="open" class="mt-2 space-y-1 pl-6">
                    <a href="/kaprodi/mk" class="flex items-center my-4 hover:bg-gray-100 rounded-lg px-2 transition-colors">
                        <label class="ml-2 text-sm text-gray-600">Pengajar Mata Kuliah</label> 
                    </a>
                    <a href="/kaprodi/jadwal" class="flex items-center my-4 mb-4 hover:bg-gray-100 rounded-lg px-2 transition-colors">
                        <label class="ml-2 text-sm text-gray-600">Jadwal</label> 
                    </a>
                </div>
            </div>
        </div>
        <!-- Profile (di bagian bawah sidebar) -->
        <div class="px-6 py-4 flex items-center">
            <img src="https://via.placeholder.com/40" alt="Profile Image" class="rounded-full h-10 w-10">
            <div class="ml-4">
                <p class="text-sm font-medium">{{ $userr->nama }}</p>
                <p class="text-xs text-gray-600">{{ $userr->nip }} - Informatika S1</p>
            </div>
        </div>
    </div>
</div>
