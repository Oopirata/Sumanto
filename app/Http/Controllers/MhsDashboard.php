<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MhsDashboard extends Controller
{
    public function dashboardMhs()
    {
        $user = Auth::user();

        $mahasiswa = \App\Models\Mahasiswa::where('user_id', $user->id)->first();

        if ($mahasiswa) {
            // Ambil Dosen berdasarkan dosen_wali_id dari mahasiswa
            $dosenWali = \App\Models\Dosen::find($mahasiswa->dosen_wali_id);
        } else {
            $dosenWali = null; // Atau tangani kasus di mana mahasiswa tidak ditemukan
        }

        dd(compact('user','mahasiswa', 'dosenWali'));
        return view('mhsDashboard', compact('user','mahasiswa', 'dosenWali'));
    }
}
