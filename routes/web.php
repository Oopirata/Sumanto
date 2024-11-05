<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\DosenMatakuliahController;
use App\Http\Controllers\BuatIRSController;
use App\Http\Controllers\IRSController;
use App\Http\Controllers\JadwalController;
use Illuminate\Support\Facades\Route;

// Route for displaying the login page
Route::get('/', [AuthController::class, 'showLogin'])->name('login');

// Route for handling login process
Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Route for logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes for role selection
Route::middleware(['auth'])->group(function () {
    // Route to display the role selection page
    Route::get('/select-role', [AuthController::class, 'selectRolePage'])->name('selectRole');

    // Route to handle role selection submission
    Route::post('/select-role', [AuthController::class, 'selectRole'])->name('selectRole.submit');
});

// Dashboard Routes with middleware
// Route::middleware(['auth'])->group(function () {
// Student dashboard

// Dean dashboard
Route::get('dekan/dashboard', function () {
    return view('dekanDashboard');
})->name('dekan.dashboard');

// Program Head dashboard
Route::get('kaprodi/dashboard', function () {
    return view('kaprodiDashboard');
})->name('kaprodi.dashboard');

// Academic Staff dashboard
Route::get('staff/dashboard', function () {
    return view('academicStaffDashboard');
})->name('staff.dashboard');

// Academic Advisor dashboard
Route::get('dosen/dashboard', function () {
    return view('paDashboard');
})->name('dosen.dashboard');
// });

Route::get('dekan/jadwal', function () {
    return view('dekanJadwal');
});

Route::get('dekan/ruangan', function () {
    return view('dekanVerifikasi');
});

Route::get('kaprodid', function () {
    return view('kaprodiDashboard');
});

// Route::get('kaprodimk', function () {
//     return view('kaprodiMatkulDosen');
// });
Route::get('kaprodimk', [MatakuliahController::class, 'index'])->name('matakuliah.index');

Route::get('kaprodij', function () {
    return view('kaprodiBuatJadwal');
});

Route::get('mhs/dashboard', [MhsDashboard::class, 'dashboardMhs'])->name('mhs.dashboard');

Route::get('/mhs/BuatIrs', [BuatIRSController::class, 'tampil_jadwal'])->name('buat.irs');

Route::get('/mhs/irs', [IRSController::class, 'all'])->name('mhs.irs');

Route::get('/mhs/khs', function () {
    return view('mhsKhs');
});

Route::get('/mhs/transkip', function () {
    return view('mhsTranskip');
});
