@extends('main')

@section('title', 'Biaya Kuliah')

@section('page')

<div class="bg-gray-100 min-h-screen flex flex-col ">
    <div class="flex overflow-hidden">
        <x-side-bar-mhs :mahasiswa="$mahasiswa"></x-side-bar-mhs>
        <div id="main-content" class=" relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar :mahasiswa="$mahasiswa" :user="$user"></x-nav-bar>
            <h1 class="mx-9 my-6 font-semibold text-2xl text-center">Rincian Biaya Kuliah</h1>
            <div class="mx-32 bg-white py-8 px-6 rounded-2xl">
                <h1 class="my-6 text-2xl">Status Billkey:</h1>
                <h1 class="text-xl mb-1">Billkey:&emsp;&emsp;&emsp;{{ $mahasiswa->nim }}</h1>
                <h1 class="text-xl mb-1">Nama:&emsp;&emsp;&emsp;{{ $mahasiswa->nama }}</h1>
                <h1 class="text-xl mb-1">Semester:&emsp;&nbsp;{{ $mahasiswa->semester }}</h1>
                <h1 class="text-xl mb-1">Nominal:&emsp;&nbsp;&nbsp;&nbsp;20.000.000</h1>
                <h1 class="text-xl mb-1">Status:&emsp;&emsp;&emsp;Lunas</h1>
            </div>
            <div class="mx-32 mt-8 bg-white py-8 px-6 rounded-2xl">
                <table class="text-center w-[100%]">
                    <thead>
                        <tr>
                            <th>Semester</th>
                            <th>UKT</th>
                            <th>Tagihan</th>
                            <th>Pembayaran</th>
                            <th>Tanggal Bayar</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="pt-6">1</td>
                            <td class="pt-6">IX</td>
                            <td class="pt-6">20.000.000</td>
                            <td class="pt-6">20.000.000</td>
                            <td class="pt-6">2023-22-2</td>
                            <td class="pt-6">Lunas</td>
                        </tr>
                        <tr>
                        <td class="pt-6">2</td>
                            <td class="pt-6">IX</td>
                            <td class="pt-6">20.000.000</td>
                            <td class="pt-6">20.000.000</td>
                            <td class="pt-6">2024-22-2</td>
                            <td class="pt-6">Lunas</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection