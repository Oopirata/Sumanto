@extends('main')

@section('title', 'Buat Jadwal')

@section('page')

<div class="bg-gray-100 min-h-screen flex flex-col ">
    <div class="flex overflow-hidden">
        <x-side-bar-kaprodi></x-side-bar-kaprodi>
        <div id="main-content" class=" relative text-black font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar></x-nav-bar>

            <div class="p-10 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm 2xl:col-span-2 sm:p-6 dark:bg-white">
                
            </div>
            <div class="mt-10 p-8 mx-8 bg-white rounded-xl shadow-md overflow-hidden overflow-y-auto" style="max-height: 550px;">
                <table id="tabelDekan" class ="display">
                    <thead>
                        <tr>
                            <th class="px-6 py-3">Mata Kuliah</th>
                            <th class="px-6 py-3">Semester</th>
                            <th class="px-6 py-3">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">1</td>
                            <td class="px-6 py-4">2022</td>
                            <td>
                                <button 
                                    class="bg-black text-white py-2 px-4 rounded">
                                    Detail
                                </button>
                            </td>
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
                        },
                    columnDefs: [
                        { className: "dt-head-center", targets: [0,1,2] },
                        { className: "dt-body-center", targets: [0,1,2] }
                    ]
                    
                });
            });
</script>

@endsection