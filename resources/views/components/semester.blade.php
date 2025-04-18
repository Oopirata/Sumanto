<div x-data="{ open: false, selectedJurusan: 'Semester' }" class="relative">
    <button @click="open = !open" class="flex items-center justify-between px-6 py-2 w-55 text-white bg-blue-600 rounded-lg transition-all focus:outline-none mb-2">
        <span class="text-sm font-medium" x-text="selectedJurusan"></span>
        <svg class="h-5 w-5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <!-- Dropdown Items -->
    <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
            <a href="#" @click="selectedJurusan = 'Semester 1'; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Semester 1</a>
            <a href="#" @click="selectedJurusan = 'Semester 3'; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Semester 3</a>
            <a href="#" @click="selectedJurusan = 'Semester 5'; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Semester 5</a>
            <a href="#" @click="selectedJurusan = 'Semester 7'; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Semester 7</a>
        </div>
    </div>
</div>
