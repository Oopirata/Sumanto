<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Irs;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IRSController extends Controller
{
    public function all()
    {
        $email = Auth::user()->email;
        dd($email);
        // Join the mahasiswa table to group by semester in matakuliah and sum SKS
        $data = Irs::select('mata_kuliah.plotsemester as semester', DB::raw('SUM(mata_kuliah.sks) as total_sks'))
            ->join('mata_kuliah', 'irs_test.kodemk', '=', 'mata_kuliah.kodemk')
            ->where('irs_test.status', 'Disetujui')  // Filter by status 'Disetujui'
            ->where('email', $email)
            ->groupBy('mata_kuliah.plotsemester')
            ->orderBy('mata_kuliah.plotsemester', 'asc')
            ->get();



        return view('mhsIrs', compact('data', 'email'));
    }

    public function index(Request $request, $semester,$email)
    {

        // Get the specific records for the selected semester from matakuliah
        $query = "SELECT m.kodemk as kodemk, m.nama as mata_kuliah, j.ruang as ruang, m.sks as sks FROM irs_test i JOIN mata_kuliah m ON i.kodemk = m.kodemk JOIN jadwal j ON i.kodejadwal = j.id JOIN mahasiswa ma ON ma.email = ".$email." WHERE email = '".$email."' AND i.status = 'Disetujui'  AND ma.semester_berjalan='".$semester."'";

        $data = DB::select($query);

        //change data to object
        $data = json_decode(json_encode($data));
        return response()->json(['data' => $data]);



        if ($request->ajax()) {
            return response()->json($data);
        }
    }
}
