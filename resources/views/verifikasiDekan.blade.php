@extends('main')

@section('title', 'Verifikasi Jadwal')

@section('page')

<div class="bg-gray-100 min-h-screen flex flex-col">
    <div class="flex pt-12 overflow-hidden">
        {{-- sidebar --}}

        {{-- end sidebar --}}

        <div id="main-content" class="mt-8 relative text-black font-poppins w-full h-full overflow-y-auto lg:pl-52">
            <h1 class="mx-8 mb-4 font-semibold text-lg">Hello Ahmad Douglas</h1>
            <div
                class="p-10 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm 2xl:col-span-2 sm:p-6 dark:bg-white">
                <div class="flex text-center justify-between items-center">
                    <h1 class="font-semibold">LIST DAFTAR RUANG</h1>
                    <div class="bg-blue-700 rounded-3xl px-10 py-4 ">
                        <h1 class="font-semibold text-white">INFORMATIKA</h1>
                    </div>
                </div>

            </div>
            <div
                class="mt-8 p-10 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm 2xl:col-span-2 sm:p-6 dark:bg-white">
                <table id="tabelVeri">
                    <thead>
                        <tr>
                            <th>Kode Ruang</th>
                            <th>Nama Ruang</th>
                            <th>Kapasitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>E101</td>
                            <td>Ruang Kelas E101</td>
                            <td>Kapasitas</td>
                        </tr>
                        <tr>
                            <td>E101</td>
                            <td>Ruang Kelas E101</td>
                            <td>Kapasitas</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <script>
                $(document).ready(function () {
                    $('#tabelVeri').DataTable();
                });
            </script>

            @endsection