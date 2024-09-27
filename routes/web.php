<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/sidebar', function () {
    return view('dashboard');
});
Route::get('/tes', function () {
    return view('tes');
});

Route::get('/dekand', function () {
    return view('dekanDashboard');
});