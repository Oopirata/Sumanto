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
        $data = Irs::select('matakuliah.plotsemester as semester', DB::raw('SUM(matakuliah.sks) as total_sks'))
            ->join('matakuliah', 'irs.kodemk', '=', 'matakuliah.kodemk')
            ->where('irs.status', 'Disetujui')
            ->where('email', $email)
            ->groupBy('matakuliah.plotsemester')
            ->orderBy('matakuliah.plotsemester', 'asc')
            ->get();

        return view('mhsIrs', compact('data', 'email'));
    }
}
