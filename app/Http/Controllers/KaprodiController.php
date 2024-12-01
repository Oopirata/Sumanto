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
        $mahasiswa = Mahasiswa::with('irs')->get(); // Gunakan with untuk eager loading
        $irs = Irs::all();
    
        // Periksa apakah semua IRS memiliki status "Disetujui"
        $allApproved = $irs->groupBy('mhs_id')->map(function ($group) {
            return $group->every(fn($item) => $item->status == 'Disetujui');
        });
        
        // Kirimkan data ke view
        return view('kaprodiIrs', compact('user', 'userr', 'mahasiswa', 'irs', 'allApproved'));
    }
    
    

    // Method untuk menyetujui IRS
    public function updateAllStatus(Request $request, $mhs_id)
    {
        // Validasi status yang dikirim
        $request->validate([
            'status' => 'required|in:Disetujui,Tidak Disetujui', // Status yang valid
        ]);

        // Temukan IRS berdasarkan mhs_id
        $irs = Irs::where('mhs_id', $mhs_id)->first();

        if ($irs) {
            // Update status IRS yang relevan
            $irs->update(['status' => $request->status]);

            // Redirect kembali ke halaman verifikasi IRS
            return redirect()->route('kaprodi.irs')->with('success', 'Status berhasil diubah!');
        }
        
        // Jika tidak ditemukan IRS
        return redirect()->route('kaprodi.irs')->with('error', 'IRS tidak ditemukan!');
    }

    
}
