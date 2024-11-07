<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    //
    public function index(){

        $data = Jadwal::all();

        

        return view('kaprodiBuatJadwal', compact('data'));


    }
}
