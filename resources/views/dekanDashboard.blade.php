@extends('main')

@section('title', 'Buat Jadwal')

@section('page')


<div class="bg-gray-100 min-h-screen flex flex-col ">
    <div class="flex pt-12 overflow-hidden">
        {{-- sidebar --}}
        {{-- end sidebar --}}

        <div id="main-content" class="mt-8 relative text-black font-poppins w-full h-full overflow-y-auto lg:pl-52">
            <h1 class="mx-8 mb-4 font-semibold text-lg">Hello Ahmad Douglas</h1>
            <div
                class="p-10 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm 2xl:col-span-2 sm:p-6 dark:bg-white">
                <div class="grid grid-cols-3 text-center">
                    <div class="justify-center px-48">
                        <h1 class="font-bold pb-4">Pengajuan IRS</h1>
                        <div class="bg-blue-700 rounded-3xl px-2 py-3">
                            <h1 class="text-white font-semibold">180</h1>
                        </div>
                    </div>
                    <div class="justify-center px-48">
                        <h1 class="font-bold pb-4">IRS Disetujui</h1>
                        <div class="bg-green-400 rounded-3xl px-2 py-3">
                            <h1 class="text-white font-semibold">180</h1>
                        </div>
                    </div>
                    <div class="justify-center px-48">
                        <h1 class="font-bold pb-4">IRS Ditolak</h1>
                        <div class="bg-red-500 rounded-3xl px-2 py-3">
                            <h1 class="text-white font-semibold">180</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-10 p-8 mx-8 bg-white rounded-xl shadow-md overflow-hidden">
                <table id="tabelDekan" class ="display">
                    <thead>
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Tahun Ajaran</th>
                            <th class="px-6 py-3">Semester</th>
                            <th class="px-6 py-3">Program Studi</th>
                            <th class="px-6 py-3">IPK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">1</td>
                            <td class="px-6 py-4">2022</td>
                            <td class="px-6 py-4">S1</td>
                            <td class="px-6 py-4">Informatika</td>
                            <td class="px-6 py-4">3.9</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">2</td>
                            <td class="px-6 py-4">2022</td>
                            <td class="px-6 py-4">S1</td>
                            <td class="px-6 py-4">Informatika</td>
                            <td class="px-6 py-4">3.9</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">3</td>
                            <td class="px-6 py-4">2022</td>
                            <td class="px-6 py-4">S1</td>
                            <td class="px-6 py-4">Informatika</td>
                            <td class="px-6 py-4">4.0</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">1</td>
                            <td class="px-6 py-4">2022</td>
                            <td class="px-6 py-4">S1</td>
                            <td class="px-6 py-4">Informatika</td>
                            <td class="px-6 py-4">3.9</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">1</td>
                            <td class="px-6 py-4">2022</td>
                            <td class="px-6 py-4">S1</td>
                            <td class="px-6 py-4">Informatika</td>
                            <td class="px-6 py-4">3.9</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<script>
    $(document).ready( function () {
                $('#tabelDekan').DataTable({
                    layout :{
                            topStart: null,
                            
                            bottomStart: null,
                            bottomEnd: null
                        },
                    columnDefs: [
                        { className: "dt-head-center", targets: [0,1,2,3,4] },
                        { className: "dt-body-center", targets: [0,1,2,3,4] }
                    ]
                    
                });
            });
</script>

@endsection