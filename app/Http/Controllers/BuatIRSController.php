<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

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

        $user = Auth::user();

        $mahasiswa = \App\Models\Mahasiswa::where('user_id', $user->id)->first();

        if ($mahasiswa) {
            // Ambil Dosen berdasarkan dosen_wali_id dari mahasiswa
            $dosenWali = \App\Models\Dosen::find($mahasiswa->dosen_wali_id);
        } else {
            $dosenWali = null; // Atau tangani kasus di mana mahasiswa tidak ditemukan
        }

        // Return the view with courses and schedules
        return view('mhsBuatIrs', compact('jadwals', 'courses', 'mahasiswa'));
    }
}

