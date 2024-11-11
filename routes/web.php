<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuatIRSController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\IRSController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MhsDashboard;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\RuanganController;
use App\Models\Ruangan;
use Illuminate\Container\Attributes\Auth;
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
Route::get('dekan/dashboard', [AuthController::class, 'dekanDashboard'])->name('dekan.dashboard');

Route::get('dekan/jadwal', [AuthController::class, 'dekanJadwal'])->name('dekan.jadwal');

Route::get('dekan/ruangan', [AuthController::class, 'dekanRuangan'])->name('dekan.ruangan');

// Program Head dashboard

// Academic Staff dashboard
Route::get('staff/dashboard', function () {
    return view('baDashboard');
})->name('staff.dashboard');

// Academic Advisor dashboard
Route::get('dosen/dashboard', [DosenController::class, 'dashboardPA'])->name('dosen.dashboard');

Route::get('kaprodid', function () {
    return view('kaprodiDashboard');
});

Route::get('kaprodi/jadwal', [JadwalController::class, 'index'])->name('kaprodi.jadwal');

Route::get('kaprodi/dashboard', [MatakuliahController::class, 'showKaprodiDashboard'])->name('kaprodi.dashboard');

Route::get('kaprodij', [JadwalController::class, 'index'])->name('BuatIrs.index');

Route::post('kaprodij', [JadwalController::class, 'store'])->name('store.jadwal');


Route::get('/kaprodi/mk/{mataKuliahId}', [MatakuliahController::class, 'dosenHapusOption']);

Route::get('/kaprodi/mk', [MatakuliahController::class, 'index'])->name('matakuliah.index');

Route::post('/kaprodi/mk', [MatakuliahController::class, 'store'])->name('store.jadwal');

Route::post('kaprodimk/delete', [MatakuliahController::class, 'deleteJadwal'])->name('delete.jadwal');

Route::get('mhs/dashboard', [MhsDashboard::class, 'dashboardMhs'])->name('mhs.dashboard');

Route::get('/mhs/BuatIrs', [BuatIRSController::class, 'tampil_jadwal'])->name('buat.irs');

Route::get('/mhs/irs', [IRSController::class, 'tampil_jadwal'])->name('mhs.irs');

Route::get('/mhs/khs', function () {
    return view('mhsKhs');
});

Route::get('/mhs/transkip', function () {
    return view('mhsTranskip');
});

Route::get('/dosen/PengajuanIrs', function () {
    return view('paPengajuanIrs');
});

Route::get('staff/irs', function () {
    return view('baIrs');
});

Route::get('staff/ruangan', [RuanganController::class, 'index'])->name('ba.ruangan');

Route::put('staff/ruangan/{id_ruang}', [RuanganController::class, 'update'])->name('ruangan.update');

Route::get('pa/dashboard', [DosenController::class, 'dashboardPA']);
