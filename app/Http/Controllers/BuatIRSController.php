<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;
use App\Models\Irs;
use App\Models\Matakuliah; // Model for courses
use App\Models\Mahasiswa;
use App\Models\Dosen; // Model for Dosen
use Illuminate\Http\Request;

class BuatIRSController extends Controller
{
    public function tampil_jadwal() 
    {
        // Fetch all courses
        $courses = Matakuliah::all();

        // Fetch all schedules
        $jadwals = Jadwal::all();

        // Fetch the authenticated user
        $user = Auth::user();

        // Get Mahasiswa (Student) details
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if ($mahasiswa) {
            // If Mahasiswa exists, fetch the Dosen (advisor) information
            $dosenWali = Dosen::find($mahasiswa->dosen_wali_id);
        } else {
            // If Mahasiswa doesn't exist, set Dosen to null (or handle error)
            $dosenWali = null;
        }

        // Return the view with courses, schedules, and Mahasiswa details
        return view('mhsBuatIrs', compact('jadwals', 'courses', 'mahasiswa', 'dosenWali'));
    }
}