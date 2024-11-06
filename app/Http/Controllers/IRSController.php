<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Irs;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;

class IRSController extends Controller
{
    public function all()
    {
        $email = Auth::user()->email;
        // dd($email);
        // Join the mahasiswa table to group by semester in matakuliah and sum SKS
        $data = Irs::select('matakuliah.semester as semester', DB::raw('SUM(matakuliah.sks) as total_sks'))
            ->join('matakuliah', 'irs.kode_mk', '=', 'matakuliah.kodemk')
            ->where('irs.status', 'Disetujui')
            ->where('email', $email)
            ->groupBy('matakuliah.semester')
            ->orderBy('matakuliah.semester', 'asc')
            ->get();



        return view('mhsIrs', compact('data', 'email'));
    }

    public function index(Request $request, $semester)
    {
        $email = Auth::user()->email;
        // Get the specific records for the selected semester from matakuliah
        $query = "SELECT m.kode_mk as kode_mk, m.nama as matakuliah, j.ruang as ruang, m.sks as sks FROM irs i JOIN matakuliah m ON i.kode_mk = m.kode_mk JOIN mahasiswa ma ON ma.email = " . $email . " WHERE email = '" . $email . "' AND i.status = 'Disetujui'  AND ma.semester='" . $semester . "'";

        $data = DB::select($query);

        //change data to object
        $data = json_decode(json_encode($data));
        return response()->json(['data' => $data]);



        if ($request->ajax()) {
            return response()->json($data);
        }
    }

    public function tampil_jadwal()
    {
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
        return view('mhsIrs', compact('jadwals', 'courses', 'mahasiswa'));
    }
}
