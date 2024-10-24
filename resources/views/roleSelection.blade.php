@extends('main')

@section('title', 'Select Your Role')

@section('page')
<div class="flex justify-center items-start min-h-screen bg-gray-50 py-10 font-poppins">
    <div class="bg-white p-10 rounded-xl shadow-lg w-full max-w-lg">
        <h2 class="text-2xl text-center font-semibold mb-12">Select Your Role</h2>

        <form action="{{ route('selectRole.submit') }}" method="POST" @submit.prevent="if(roleId) { $el.submit(); }">
            @csrf
            
            <div x-data="{ open: false, selected: 'Role', roleId: null }" class="flex items-center mb-6">
                <label class="text-lg font-semibold text-black mr-4">Choose Your Role:</label>

                <div class="relative flex-grow">
                    <button type="button" @click="open = !open" class="flex items-center px-4 py-2 w-full text-gray-600 hover:bg-[#5932EA] focus:bg-[#5932EA] hover:text-white focus:text-white rounded-lg transition-all focus:outline-none">
                        <span class="ml-2 text-sm" x-text="selected"></span>
                        <svg class="ml-auto h-5 w-5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" class="mt-2 bg-white shadow-lg rounded-lg w-full absolute z-10">
                        <ul>
                            @foreach ($roles as $role)
                                <li @click="selected = '{{ $role->name }}'; roleId = {{ $role->id }}; open = false" class="px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 cursor-pointer">
                                    {{ $role->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <input type="hidden" name="role_id" :value="roleId" required>

            <div class="flex justify-center mt-20">
                <button type="submit" class="bg-[#5932EA] text-white px-6 py-2 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:bg-purple-700 focus:ring-opacity-50">
                    Processed
                </button>
            </div>
        </form>
    </div>
</div>
@endsection