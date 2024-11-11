<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;

class BuatIRSController extends Controller
{
    public function tampil_jadwal()
    {
        // Fetch the authenticated user
        $user = Auth::user();

        // Get Mahasiswa (Student) details
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        // dd($mahasiswa);
        if ($mahasiswa) {
            // Since both mahasiswa.semester and matakuliah.semester are strings,
            // we can directly compare them
            $currentSemester = $mahasiswa->semester;

            // Fetch the course codes for current semester
            $currentSemesterCourses = Matakuliah::where('semester', $currentSemester)
                ->pluck('semester')
                ->toArray();

            // Fetch only schedules for courses in the student's semester
            $jadwals = Jadwal::whereIn('semester', $currentSemesterCourses)->get();

            // Get dosen wali information
            $dosenWali = Dosen::find($mahasiswa->dosen_wali_id);

            // For debugging (optional)
            // \Log::info('Current semester: ' . $currentSemester);
            // \Log::info('Available courses: ', $currentSemesterCourses);
            // \Log::info('Filtered schedules: ', $jadwals->toArray());
        } else {
            $jadwals = collect();
            $dosenWali = null;
        }

        return view('mhsBuatIrs', compact('jadwals', 'mahasiswa', 'dosenWali'));
    }
}
