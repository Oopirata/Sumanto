<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DekanController extends Controller
{
    public function dekanDashboard()
    {

        $user = Auth::user();

        $dekan = \App\Models\Dekan::where('user_id', $user->id)->first();

        return view('dekanDashboard', compact('dekan', 'user'));
    }

    public function dekanRuangan()
    {

        $user = Auth::user();

        $dekan = \App\Models\Dekan::where('user_id', $user->id)->first();

        return view('dekanVerifikasi', compact('dekan', 'user'));
    }

    public function dekanJadwal()
    {

        $user = Auth::user();

        $dekan = \App\Models\Dekan::where('user_id', $user->id)->first();

        return view('dekanJadwal', compact('dekan', 'user'));
    }
}
