<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

<<<<<<< HEAD
Route::get('/tes', function () {
    return view('tes');
=======
Route::get('/sidebar', function () {
    return view('sidebar');
>>>>>>> e7fbc998e8b8fe49d119ab7e40c43915d308e92f
});