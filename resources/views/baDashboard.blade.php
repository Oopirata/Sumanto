@extends('main')

@section('title', 'Bagian Akademik Dashboard')

@section('page')
<div class="bg-gray-100 h-screen flex flex-col">
    <div class="flex overflow-hidden">
        <!-- Sidebar -->
        <x-side-bar-ba></x-side-bar-ba>

        <!-- Konten Utama -->
        <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar></x-nav-bar>
            <div class="border-b-4"></div>

            <!-- Header dan Informasi Pengguna -->
            <div class="bg-white rounded-2xl shadow p-8 mb-6 mx-8 mt-8">
                <div class="flex items-center justify-between">
                    <!-- Foto Profil di sebelah kiri -->
                    <div class="w-24 h-24 rounded-full overflow-hidden ml-32">
                        <img src="path_to_image.jpg" alt="User Image" class="object-cover w-full h-full">
                    </div>
                    <!-- Nama dan NIP di tengah -->
                    <div class="flex flex-col items-center flex-grow mr-52">
                        <h1 class="text-2xl font-bold">Suteyo Tejo</h1>
                        <h1 class="text-gray-500">NIP: 100184433</h1>
                    </div>
                </div>

                <!-- Informasi Jabatan, Fakultas, Program Studi -->
                <div class="grid grid-cols-3 text-center font-bold py-6 mt-8">
                    <div class="px-4">
                        <h1 class="text-gray-500 mb-2">Jabatan Fungsional</h1>
                        <h1 class="font-bold">Staff Akademik</h1>
                    </div>
                    <div class="px-4 border-x-black border-x-2">
                        <h1 class="text-gray-500 mb-2">Fakultas</h1>
                        <h1 class="font-bold">Sains dan Matematika</h1>
                    </div>
                    <div class="px-4">
                        <h1 class="text-gray-500 mb-2">Program Studi</h1>
                        <h1 class="font-bold">Informatika</h1>
                    </div>
                </div>
            </div>

            <!-- Bagian Pesan -->
            <h2 class="text-xl font-bold mb-4 ml-8">Pesan 📬</h2>
            <div class="bg-white rounded-2xl shadow p-8 mx-8 mb-10">
                
                <div class="space-y-4">
                    <!-- List Pesan -->
                    <div class="flex justify-between items-center">
                        <p class="font-bold">Dr.Eng. Mukidi Sukidi, S.Si., M.Kom.</p>
                        <p class="text-gray-600">Mas, tolong untuk kelas K102 dirubah jadwalnya nggih. <span class="text-red-500">●</span></p>
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="font-bold">Joni Iskandar, S.Kom., M.Kom.</p>
                        <p class="text-gray-600">Mas Tejo, tolong review kembali IRS mahasiswa baru. <span class="text-red-500">●</span></p>
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="font-bold">Andri Hidayat, S.T., M.Kom.</p>
                        <p class="text-gray-600">Mas apakah nanti siang jadwalnya kosong?</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="font-bold">Dr. Andre Taufik Lany Lauv, S.Si., Ph.D.</p>
                        <p class="text-gray-600">Jangan lupa rapat nanti sore nggih mas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
