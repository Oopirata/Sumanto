@extends('main')

@section('title', 'Dashboard')

@section('page')

<div class="bg-gray-100 min-h-screen flex flex-col ">
    <div class="flex overflow-hidden">
        <x-side-bar-mhs :mahasiswa="$mahasiswa"></x-side-bar-mhs>
        <div id="main-content" class=" relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar :mahasiswa="$mahasiswa" :user="$user"></x-nav-bar>
            <div class="my-8">
                <h1 class="my-2 font-semibold text-2xl text-center">Pilih Status Akademik</h1>
                <h1 class="my-2 font-semibold text-lg text-center">Silakan pilih salah satu status akademik berikut untuk semester ini:</h1>
            </div>
            <div class="grid grid-cols-2 mx-32 gap-40">
                <div class="bg-white px-6 py-6 h-[70vh] flex flex-col justify-between rounded-2xl">
                    <div>
                        <div class="grid grid-cols-2">
                            <div class="ml-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-mortarboard-fill" viewBox="0 0 16 16">
                            <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917z"/>
                            <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466z"/>
                            </svg>
                            </div>
                            <div class="mt-4 mr-12">
                                <h1 class="text-right text-xl font-bold">Status Akademik :</h1>
                                <h1 class="text-center bg-[#4BD37B] text-black py-2 rounded-3xl mx-[20%] mt-2 font-bold text-xl">Aktif</h1>
                            </div>
                        </div>

                        <h1 class="pt-6 px-10 font-medium">Anda akan mengikuti kegiatan perkuliahan pada semester ini serta mengisi Isian Rencana Studi (IRS).</h1>
                    </div>
                    <div class="bg-[#5932EA] text-white text-center mx-20 rounded-lg py-2">
                        <a href="">
                            <button>Pilih</button>
                        </a>
                    </div>
                </div>
                <div class="bg-white px-6 py-6 h-[70vh] flex flex-col justify-between rounded-2xl">
                    <div>
                        <div class="grid grid-cols-2">
                            <div class="ml-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z"/>
                            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z"/>
                            </svg>
                            </div>
                            <div class="mt-4 mr-12">
                                <h1 class="text-right text-xl font-bold">Status Akademik :</h1>
                                <h1 class="text-center bg-[#C8AB1C] text-black py-2 rounded-3xl mx-[20%] mt-2 font-bold text-xl">Cuti</h1>
                            </div>
                        </div>

                        <h1 class="pt-6 px-10 font-medium">Menghentikan kuliah sementara untuk semester ini tanpa kehilangan status sebagai mahasiswa Undip.</h1>
                    </div>
                    <div class="bg-[#5932EA] text-white text-center mx-20 rounded-lg py-2">
                        <a href="">
                            <button>Pilih</button>
                        </a>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>
@endsection