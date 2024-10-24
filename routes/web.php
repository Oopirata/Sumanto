<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

<<<<<<< Updated upstream
Route::get('/', function () {
    return view('login');
});

//Route untuk menampilkan halaman login
Route::get('login', [AuthController::class, 'showLogin'])->name('login');

//Route untuk proses login
Route::post('login', [AuthController::class, 'login']);

//Route untuk proses logout
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//Route untuk menampilkan halaman dashboard
Route::get('mhsDashboard', function () {
    return view('mhsDashboard');
})->middleware('auth');

Route::get('dekand', function () {
    return view('dekanDashboard');
});

Route::get('mhsd', function () {
    return view('mhsDashboard');
});

Route::get('mhsbk', function () {
    return view('mhsBiayakuliah');
});

Route::get('mhssk', function () {
    return view('mhsStatuskuliah');
});

Route::get('mhsIrs', function () {
    return view('mhsIrs');
});

Route::get('mhsKhs', function () {
    return view('mhsKhs');
});

Route::get('mhsTranskip', function () {
    return view('mhsTranskip');
});

Route::get('dekanv', function () {
    return view('verifikasiDekan');
});

Route::get('dekanj', function () {
    return view('dekanJadwal');
});

=======
// // Route for displaying the login page
// Route::get('login', [AuthController::class, 'showLogin'])->name('login');

// // Route for handling login process
// Route::post('login', [AuthController::class, 'login']);

// // Route for logout
// Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// // Dashboard Routes with middleware
// Route::middleware(['auth'])->group(function () {
//     // General dashboard route (can redirect based on role)
//     Route::get('dashboard', function () {
//         return view('dashboard');
//     });

//     // Student dashboard
//     Route::get('mhs/dashboard', function () {
//         return view('mhsDashboard');
//     })->name('mhs.dashboard');

//     // Dean dashboard
//     Route::get('dekan/dashboard', function () {
//         return view('dekanDashboard');
//     })->name('dekan.dashboard');

//     // Program Head dashboard
//     Route::get('kaprodi/dashboard', function () {
//         return view('programHeadDashboard');
//     })->name('kaprodi.dashboard');

//     // Academic Staff dashboard
//     Route::get('staff/dashboard', function () {
//         return view('academicStaffDashboard');
//     })->name('staff.dashboard');

//     // Academic Advisor dashboard
//     Route::get('dosen/dashboard', function () {
//         return view('advisorDashboard');
//     })->name('dosen.dashboard');
// });

// // Example of other dashboard-related routes:
// Route::get('dekan/jadwal', function () {
//     return view('dekanJadwal');
// });

// // Add any other necessary routes here...

Route::get('/mhsd', function () {
    return view('mhsDashboard');
});

Route::get('/mhsbk', function () {
    return view('mhsBiayaKuliah');
});

Route::get('/mhssk', function () {
    return view('mhsStatusKuliah');
});

Route::get('/mhsIrs', function () {
    return view('mhsIrs');
});

Route::get('/mhsKhs', function () {
    return view('mhsKhs');
});

Route::get('/mhsTrnaskip', function () {
    return view('mhsTranskip');
});

Route::get('/pad', function () {
    return view('paDashboard');
});
>>>>>>> Stashed changes
