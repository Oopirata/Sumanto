<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;
use App\Models\Irs;
use App\Models\Matakuliah;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;

class KaprodiController extends Controller
{
    //
    public function verifikasiIRS()
    {
        $user = Auth::user();
        $userr = Kaprodi::where('user_id', $user->id)->first();

        // Ambil semua mahasiswa dengan IRS mereka
        $mahasiswa = Mahasiswa::with('irs')->get(); // Use eager loading to get IRS
        $irs = Irs::all();  // Get all IRS records for verification
        
        // Check if IRS status is approved
        $allApproved = $irs->groupBy('nim')->map(function ($group) {
            return $group->every(fn($item) => $item->status == 'Disetujui');
        });

        // Pass to the view
        return view('kaprodiIrs', compact('user', 'userr', 'mahasiswa', 'irs', 'allApproved'));
    }

    
    
}
