<div x-data="{ open: false, selectedJurusan: 'Jurusan' }" class="relative">
    <button @click="open = !open" class="flex items-center justify-between px-6 py-2 w-55 text-white bg-blue-600 rounded-lg transition-all focus:outline-none mb-2" nama="jurusan">
        <span class="text-sm font-medium" x-text="selectedJurusan"></span>
        <svg class="h-5 w-5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <!-- Dropdown Items -->
    <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
            <a href="#" @click="selectedJurusan = 'Informatika'; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Informatika</a>
            <a href="#" @click="selectedJurusan = 'Fisika'; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Fisika</a>
            <a href="#" @click="selectedJurusan = 'Kimia'; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Kimia</a>
            <a href="#" @click="selectedJurusan = 'Matematika'; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Matematika</a>
        </div>
    </div>
</div>
