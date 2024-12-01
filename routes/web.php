<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuatIRSController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\IRSController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MhsDashboard;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\DekanVerifController;
use App\Http\Controllers\BaController;
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

Route::get('dekan/dashboard', [DekanVerifController::class, 'dekanDashboard'])->name('dekan.dashboard');


Route::get('dekan/jadwal', [DekanVerifController::class, 'dekanJadwal'])->name('dekan.jadwal');

Route::post('dekan/jadwal', [DekanVerifController::class, 'updateStatus'])->name('updateStatus');

Route::post('/dekan/jadwal/update-all-status', [DekanVerifController::class, 'updateAllStatus'])->name('updateAllStatus');



// Route::get('dekan/jadwal', [DekanVerifController::class, 'verifJadwal'])->name('dekan.jadwal');

Route::get('dekan/ruangan', [DekanVerifController::class, 'dekanRuangan'])->name('dekan.ruangan');

Route::get('kaprodi/jadwal', [JadwalController::class, 'index'])->name('kaprodi.jadwal');

Route::post('kaprodi/jadwal', [JadwalController::class, 'store'])->name('storeKaprodi.jadwal');

Route::post('kaprodi/jadwal/delete', [JadwalController::class, 'destroy'])->name('deleteKaprodi.jadwal');

Route::get('kaprodi/dashboard', [MatakuliahController::class, 'showKaprodiDashboard'])->name('kaprodi.dashboard');

Route::get('/kaprodi/mk/{mataKuliahId}', [MatakuliahController::class, 'dosenHapusOption']);

Route::get('/kaprodi/mk', [MatakuliahController::class, 'index'])->name('matakuliah.index');

Route::post('/kaprodi/mk', [MatakuliahController::class, 'store'])->name('store.jadwal');

Route::post('kaprodimk/delete', [MatakuliahController::class, 'deleteJadwal'])->name('delete.jadwal');

Route::get('mhs/dashboard', [MhsDashboard::class, 'dashboardMhs'])->name('mhs.dashboard');

Route::get('/mhs/BuatIrs', [BuatIRSController::class, 'tampil_jadwal'])->name('buat.irs');

Route::post('/mhs/BuatIrs', [BuatIRSController::class, 'store'])->name('store.irs');

Route::get('/mhs/irs', [IRSController::class, 'tampil_jadwal'])->name('mhs.irs');

Route::get('/mhs/khs', [MhsDashboard::class, 'KhsMhs'])->name('mhs.khs');

Route::get('/mhs/bayar', [MhsDashboard::class, 'BayarMhs'])->name('mhs.bayar');

Route::get('/mhs/status', [MhsDashboard::class, 'StatusMhs'])->name('mhs.status');

Route::get('/mhs/transkrip', [MhsDashboard::class, 'TranskripMhs'])->name('mhs.transkrip');

Route::get('staff/irs', [BaController::class, 'IrsBA']);

Route::get('staff/ruangan', [RuanganController::class, 'index'])->name('ba.ruangan');

Route::post('staff/ruangan/keterangan', [RuanganController::class, 'update'])->name('ruangan.update');

Route::get('staff/dashboard', [BaController::class, 'DashboardBA'])->name('staff.dashboard');

Route::get('staff/detailirs', [BaController::class, 'DetailIrsBA'])->name('staff.irs.detail');

// Dosen
Route::get('dosen/dashboard', [DosenController::class, 'dashboardPA'])->name('dosen.dashboard');

Route::get('/dosen/PengajuanIrs', [DosenController::class, 'pengajuanIrsPA']);

Route::get('/dosen/Perwalian', function () {
    return view('paPerwalian');
});

Route::get('/dosen/DetailPerwalian', function () {
    return view('paDetailPerwalian');
});

Route::get('/dosen/PengajuanIrs', [DosenController::class, 'pengajuanIrsPA']);