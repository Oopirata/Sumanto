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
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\KhsController;
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
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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

Route::post('/dekan/jadwal/update-all-status', [DekanVerifController::class, 'updateAllStatusDekan'])->name('updateAllStatusDekan');

Route::get('dekan/ruangan', [DekanVerifController::class, 'dekanRuangan'])->name('dekan.ruangan');

Route::post('/ruangan/{id_ruang}', [DekanVerifController::class, 'updateRuanganStatus'])->name('DekanRuangan.update');


// Route::get('dekan/jadwal', [DekanVerifController::class, 'verifJadwal'])->name('dekan.jadwal');


Route::get('kaprodi/jadwal', [JadwalController::class, 'index'])->name('kaprodi.jadwal');

Route::post('kaprodi/jadwal', [JadwalController::class, 'store'])->name('storeKaprodi.jadwal');

Route::post('kaprodi/jadwal/delete', [JadwalController::class, 'destroy'])->name('deleteKaprodi.jadwal');

Route::get('kaprodi/dashboard', [MatakuliahController::class, 'showKaprodiDashboard'])->name('kaprodi.dashboard');

Route::get('/kaprodi/mk/{mataKuliahId}', [MatakuliahController::class, 'dosenHapusOption']);

Route::get('/kaprodi/mk', [MatakuliahController::class, 'index'])->name('matakuliah.index');

Route::post('/kaprodi/mk', [MatakuliahController::class, 'handleStore'])->name('store.jadwal');

Route::post('kaprodimk/delete', [MatakuliahController::class, 'handleDelete'])->name('delete.jadwal');


Route::get('kaprodi/irs', [KaprodiController::class, 'verifikasiIRS'])->name('kaprodi.irs');

Route::post('kaprodi/irs/update/{mhs_id}', [KaprodiController::class, 'updateAllStatus'])->name('updateAllStatus');




// mhs

Route::get('mhs/dashboard', [MhsDashboard::class, 'dashboardMhs'])->name('mhs.dashboard');

Route::get('/mhs/BuatIrs', [BuatIRSController::class, 'tampil_jadwal'])->name('buat.irs');

Route::post('/mhs/BuatIrs', [BuatIRSController::class, 'store'])->name('store.irs');

Route::get('/mhs/irs', [IRSController::class, 'index'])->name('mhs.irs');

Route::get('/mhs/khs', [KhsController::class, 'all'])->name('mhs.khs');
Route::get('/khs/download/{semester}', [KhsController::class, 'download'])->name('khs.download');

Route::get('/mhs/bayar', [MhsDashboard::class, 'BayarMhs'])->name('mhs.bayar');

Route::get('/mhs/status', [MhsDashboard::class, 'StatusMhs'])->name('mhs.status');

Route::get('/mhs/transkrip', [MhsDashboard::class, 'TranskripMhs'])->name('mhs.transkrip');

//BA

Route::get('staff/irs', [BaController::class, 'IrsBA']);

Route::get('staff/ruangan', [RuanganController::class, 'index'])->name('ba.ruangan');

Route::delete('staff/ruangan/{id_ruang}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');

Route::post('staff/ruangan/store', [RuanganController::class, 'store'])->name('store.ruangan');

Route::delete('/staff/ruangan/keterangan/{id_ruang}', [RuanganController::class, 'update'])->name('ruangan.update');

Route::post('staff/ruangan/kapasitas/{id_ruang}', [RuanganController::class, 'updateKapasitas'])->name('ruangan.updateKapasitas');

Route::get('staff/dashboard', [BaController::class, 'DashboardBA'])->name('staff.dashboard');

Route::get('staff/detailirs', [BaController::class, 'DetailIrsBA'])->name('staff.irs.detail');


// Dosen
Route::get('/dosen/dashboard', [DosenController::class, 'dashboardPA'])->name('dosen.dashboard');

Route::get('/dosen/PengajuanIrs', [DosenController::class, 'pengajuanIrsPA'])->name('DosenPengajuan.irs');

Route::post('dosen/irs/update/{nim}', [DosenController::class, 'updateStatusIrs'])->name('updateStatusIrs');

Route::get('/dosen/irs/detail/{nim}', [DosenController::class, 'detailIrsPA'])->name('Dosen.DetailIrs');

Route::get('/dosen/Perwalian', [DosenController::class, 'perwalianPA'])->name('Dosen.perwalian');

Route::get('/dosen/Perwalian/detail', [DosenController::class, 'detailPerwalianPA'])->name('DosenPerwalian.detail');

Route::get('/dosen/PengajuanNilai', [DosenController::class, 'pengajuanNilaiPA']);

Route::get('/dosen/PengajuanNilai/detail', [DosenController::class, 'detailNilaiPA']);

Route::get('/dosen/PengajuanNilai/detail/inputNilai', [DosenController::class, 'inputNilaiPA']);



