@extends('main')

@section('title', 'Sidebar')
@section('page')
<div class="flex h-screen">
    <!-- Sidebar Blade Template -->
    <div class="flex flex-col w-64 bg-white shadow-lg h-full" style="border-top-right-radius: 20px; border-bottom-right-radius: 20px;">
        <!-- Logo dan Tulisan Dashboard Berdampingan -->
        <div class="flex items-center justify-center h-24 mx-5 bg-white px-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12 object-contain">
            <span class="text-blue-600 text-xl font-semibold ml-4 tracking-wide">Dashboard</span>
        </div>

        <!-- Menu Items -->
        <div class="flex flex-col mt-6 flex-grow margin-bottom: 50px;">
            <!-- Dashboard -->
            <a href="#" class="inline-flex items-center mx-5 px-6 py-2 text-gray-500 hover:bg-purple-200 focus:bg-purple-200 focus:text-purple-700 hover:text-purple-700 rounded-lg transition-all mb-2">
                <span class="material-icons">#</span>
                <span class="ml-2 text-sm">Dashboard</span>
            </a>

            <!-- Registrasi -->
            <div x-data="{ open: false }" class="relative mx-5">
                <button @click="open = !open" class="flex items-center px-6 py-2 w-full text-gray-500 hover:bg-purple-200 focus:bg-purple-200 focus:text-purple-700 hover:text-purple-700 rounded-lg transition-all focus:outline-none mb-2">
                    <span class="material-icons">#</span>
                    <span class="ml-2 text-sm">Registrasi</span>
                    <svg class="ml-auto h-5 w-5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div x-show="open" class="mt-2 space-y-1 pl-6">
                    <div class="flex items-center my-4"> <!-- Added margin-bottom -->
                        <input type="radio" name="akademik" class="form-radio text-purple-600" checked>
                        <label class="ml-2 text-sm text-gray-500">Biaya Kuliah</label>
                    </div>
                    <div class="flex items-center my-4"> <!-- Added margin-bottom -->
                        <input type="radio" name="akademik" class="form-radio text-purple-600">
                        <label class="ml-2 text-sm text-gray-500">Status Kuliah</label>
                    </div>
                </div>
            </div>

            <!-- Akademik (Dropdown) -->
            <div x-data="{ open: false }" class="relative mx-5">
                <button @click="open = !open" class="flex items-center px-6 py-2 w-full text-gray-500 hover:bg-purple-200 focus:bg-purple-200 focus:text-purple-700 hover:text-purple-700 rounded-lg transition-all focus:outline-none mb-2">
                    <span class="material-icons">#</span>
                    <span class="ml-2 text-sm">Akademik</span>
                    <svg class="ml-auto h-5 w-5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Dropdown Items -->
                <div x-show="open" class="mt-2 pl-6">
                    <div class="flex items-center my-5"> <!-- Added margin-bottom -->
                        <input type="radio" name="akademik" class="form-radio text-purple-600" checked>
                        <label class="ml-2 text-sm text-gray-500">Buat IRS</label>
                    </div>
                    <div class="flex items-center my-5"> <!-- Added margin-bottom -->
                        <input type="radio" name="akademik" class="form-radio text-purple-600">
                        <label class="ml-2 text-sm text-gray-500">IRS</label>
                    </div>
                    <div class="flex items-center my-5"> <!-- Added margin-bottom -->
                        <input type="radio" name="akademik" class="form-radio text-purple-600">
                        <label class="ml-2 text-sm text-gray-500">KHS</label>
                    </div>
                    <div class="flex items-center my-5"> <!-- Added margin-bottom -->
                        <input type="radio" name="akademik" class="form-radio text-purple-600">
                        <label class="ml-2 text-sm text-gray-500">Transkrip</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile (di bagian bawah sidebar) -->
        <div class="px-6 py-4 flex items-center">
            <img src="https://via.placeholder.com/40" alt="Profile Image" class="rounded-full h-10 w-10">
            <div class="ml-4">
                <p class="text-sm font-medium">Dul Samsi</p>
                <p class="text-xs text-gray-500">24060122120031 - Informatika S1</p>
            </div>
        </div>
    </div>
</div>
@endsection
