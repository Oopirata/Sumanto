<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Route for displaying the login page
Route::get('login', [AuthController::class, 'showLogin'])->name('login');

// Route for handling login process
Route::post('login', [AuthController::class, 'login']);

// Route for logout
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Routes with middleware
Route::middleware(['auth'])->group(function () {
    // General dashboard route (can redirect based on role)
    Route::get('dashboard', function () {
        return view('dashboard');
    });

    // Student dashboard
    Route::get('mhs/dashboard', function () {
        return view('mhsDashboard');
    })->name('mhs.dashboard');

    // Dean dashboard
    Route::get('dekan/dashboard', function () {
        return view('dekanDashboard');
    })->name('dekan.dashboard');

    // Program Head dashboard
    Route::get('kaprodi/dashboard', function () {
        return view('programHeadDashboard');
    })->name('kaprodi.dashboard');

    // Academic Staff dashboard
    Route::get('staff/dashboard', function () {
        return view('academicStaffDashboard');
    })->name('staff.dashboard');

    // Academic Advisor dashboard
    Route::get('dosen/dashboard', function () {
        return view('advisorDashboard');
    })->name('dosen.dashboard');
});

// Example of other dashboard-related routes:
Route::get('dekan/jadwal', function () {
    return view('dekanJadwal');
})->name('dekan.jadwal');

// Add any other necessary routes here...