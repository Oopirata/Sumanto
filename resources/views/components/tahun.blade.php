<div x-data="{ open: false, selected: '2024' }" class="relative">
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
