@extends('main')

@section('title', 'Login')

@section('page')
<div class="login-container">
    <img src="{{ asset('images/logo.png') }}" alt="Logo">
    <h3>Sistem Unggulan Manajemen Akademik dan Terintegrasi Online</h3>
    <h2>Log in menggunakan SSO</h2>
    <form action="login.php" method="post">
        <input type="email" name="email" placeholder="Masukkan E-Mail" required>
        <input type="password" name="password" placeholder="Masukkan Password" required>
    </form>
    <button type="submit" class="button">Masuk</button>
    <a href="#">
        <span class="lupa-password">Lupa password?</span>
        <span class="reset-password"> RESET PASSWORD</span>
    </a>
</div>
@endsection