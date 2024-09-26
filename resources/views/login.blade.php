@extends('main')

@section('title', 'Login')

@section('page')
<div class="flex justify-center items-center min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/gambar1.jpg') }}');">
    <div class="bg-[#C9E6FF] rounded-md shadow-lg p-8 text-center w-full max-w-md">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-48 mx-auto mb-6">
        <h3 class="font-poppins text-[#45ACFF] mb-6">Sistem Unggulan Manajemen Akademik dan Terintegrasi Online</h3>
        <h2 class="text-[#000000] mb-6">Log in menggunakan SSO</h2>
        <form action="login.php" method="post" class="space-y-4">
            <input type="email" name="email" placeholder="Masukkan E-Mail" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            <input type="password" name="password" placeholder="Masukkan Password" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="px-16 py-2 bg-[#5932EA] text-[#ffffff] rounded-lg hover:bg-[#5932EA]">Masuk</button>
        </form>
        <a href="#" class="block mt-6 text-pink-500">
            <span class="text-black">Lupa password?</span>
            <span class="font-bold text-[#DC2A2A]">RESET PASSWORD</span>
        </a>
    </div>
</div>
@endsection
