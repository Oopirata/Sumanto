@extends('main')

@section('title', 'Select Your Role')
@section('title', 'Select Your Role')

@section('page')
<div class="flex justify-center items-start min-h-screen bg-gray-50 py-10 font-poppins">
    <div class="bg-white p-10 rounded-xl shadow-lg w-full max-w-lg">
        <h2 class="text-2xl text-center font-semibold mb-12">Select Your Role</h2>
<div class="flex justify-center items-start min-h-screen bg-gray-50 py-10 font-poppins">
    <div class="bg-white p-10 rounded-xl shadow-lg w-full max-w-lg">
        <h2 class="text-2xl text-center font-semibold mb-12">Select Your Role</h2>

        <form action="{{ route('selectRole.submit') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label class="text-lg font-semibold text-black mb-2">Choose Your Role:</label>
                <div class="relative">
                    <select name="role_id" required 
                            class="appearance-none w-full px-4 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-[#5932EA] transition-all hover:bg-[#5932EA] hover:text-white">
                        <option value="" disabled selected>Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                </div>
            </div>

            <div class="flex justify-center mt-20">
                <button type="submit" class="bg-[#5932EA] text-white px-6 py-2 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:bg-purple-700 focus:ring-opacity-50">
                    Proceed
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
