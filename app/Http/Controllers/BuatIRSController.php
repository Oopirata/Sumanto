<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Irs;
use App\Models\Matakuliah; // Model for courses
use Illuminate\Http\Request;

class BuatIRSController extends Controller
{
    public function tampil_jadwal() {
        // Fetch all courses
        $courses = Matakuliah::all();

        // Fetch all schedules
        $jadwals = Jadwal::all();

        // Return the view with courses and schedules
        return view('mhsBuatIrs', compact('jadwals', 'courses'));
    }
}
