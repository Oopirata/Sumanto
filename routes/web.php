<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('login');
// });

//Route untuk menampilkan halaman login
Route::get('login', [AuthController::class, 'showLogin'])->name('login');

//Route untuk proses login
Route::post('login', [AuthController::class, 'login']);

//Route untuk proses logout
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//Route untuk menampilkan halaman dashboard
Route::get('dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('dekand', function () {
    return view('dekanDashboard');
});


Route::get('dekanv', function () {
    return view('verifikasiDekan');
});

Route::get('dekanj', function () {
    return view('dekanJadwal');
});