<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});


Route::get('/tes', function () {
    return view('tes');
});

Route::get('/dekand', function () {
    return view('dekanDashboard');
});