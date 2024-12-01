<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function dashboardPA()
    {
        $dosens = Auth::user();
        $dosen = Dosen::where('user_id', $dosens->id)->first(); // Ambil data dosen berdasarkan user_id
        // Ambil jadwal berdasarkan hari ini
        $hariIni = now()->locale('id')->translatedFormat('l'); // Mengambil hari dalam bahasa Indonesia

        // Ambil jadwal dosen untuk hari ini
        $jadwals = Jadwal::where('hari', $hariIni) // Menyesuaikan hari ini dengan kolom 'hari' di tabel jadwals
            ->whereIn('kode_mk', function ($query) use ($dosen) {
                $query->select('kode_mk')
                    ->from('dosen_matakuliah')
                    ->where('dosen_nip', $dosen->nip); // Dosen yang sedang login
            })
            ->orderBy('jam_mulai', 'asc') // Urutkan berdasarkan jam mulai
            ->get();

        // Mengirim data ke view
        return view('paDashboard', compact('dosens', 'dosen', 'jadwals'));
    }

    public function pengajuanIrsPA()
    {
        $dosens = Auth::user();
        $dosen = Dosen::where('user_id', $dosens->id)->first();
        $mahasiswa = Mahasiswa::where('dosen_wali_id', $dosen->id)->get(); // Ambil mahasiswa yang dibimbing dosen ini
        return view('paPengajuanIrs', compact('dosens', 'dosen', 'mahasiswa'));
    }

    public function perwalianPA()
    {
        $dosens = Auth::user();
        $dosen = Dosen::where('user_id', $dosens->id)->first(); // Ambil data dosen berdasarkan user_id
        $mahasiswa = Mahasiswa::where('dosen_wali_id', $dosen->id)->get(); // Ambil mahasiswa yang dibimbing dosen ini
        return view('paPerwalian', compact('dosens', 'dosen', 'mahasiswa')); // Kirim data dosen ke view
    }
}
