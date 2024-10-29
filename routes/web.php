<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Route for displaying the login page
Route::get('login', [AuthController::class, 'showLogin'])->name('login');

// Route for handling login process
Route::post('login', [AuthController::class, 'login']);

// Route for logout
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Routes for role selection
Route::middleware(['auth'])->group(function () {
    // Route to display the role selection page
    Route::get('/select-role', [AuthController::class, 'selectRolePage'])->name('selectRole');

    // Route to handle role selection submission
    Route::post('/select-role', [AuthController::class, 'selectRole'])->name('selectRole.submit');
});

// Dashboard Routes with middleware
Route::middleware(['auth'])->group(function () {
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

Route::get('dekan/jadwal', function () {
    return view('dekanJadwal');
});


Route::get('kaprodid', function () {
    return view('kaprodiDashboard');
});

Route::get('kaprodimk', function () {
    return view('kaprodiMatkulDosen');
});

Route::get('kaprodij', function () {
    return view('kaprodiBuatJadwal');
});

Route::get('mhsBuatIrs', function () {
    return view('mhsBuatIrs');
});
