<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use Illuminate\Support\Facades\Auth;



class DosenController extends Controller
{
    //
    public function dashboardPA()
    {
        $dosens = Auth::user();
        $dosen = \App\Models\Dosen::where('user_id', $dosens->id)->first();
        // dd($dosens, $dosen);
        return view('paDashboard', compact('dosens', 'dosen'));
    }

}
