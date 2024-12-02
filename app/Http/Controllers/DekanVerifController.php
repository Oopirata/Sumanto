<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kaprodi;
use App\Models\Matakuliah;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;

class DekanVerifController extends Controller
{
    //
    public function dekanDashboard()
    {

        $user = Auth::user();

        $dekan = \App\Models\Dekan::where('user_id', $user->id)->first();

        return view('dekanDashboard', compact('dekan', 'user'));
    }

    public function dekanRuangan(Request $request)
    {
        $user = Auth::user();
        $dekan = \App\Models\Dekan::where('user_id', $user->id)->first();
        
        // Base query untuk ruangan dengan status Diajukan
        $ruang = Ruangan::where('status', 'Diajukan');
    
        // Jika ada jurusan yang dipilih
        if ($request->jurusan) {
            $ruang = $ruang->where('prodi', $request->jurusan);
        }
    
        $ruang = $ruang->get();
        
        if ($request->ajax()) {
            return response()->json(['ruang' => $ruang]);
        }
        
        return view('dekanVerifikasi', compact('dekan', 'user', 'ruang'));
    }

    public function dekanJadwal()
    {

        $user = Auth::user();

        $dekan = \App\Models\Dekan::where('user_id', $user->id)->first();
  

        
        $data = Jadwal::all();
        // dd($data);
        $mk = MataKuliah::all();
        $ruangan = Ruangan::all();

        $allApproved = $data->every(fn($item) => $item->status == 'Disetujui');
    
        return view('dekanJadwal', compact('data', 'user', 'mk', 'ruangan', 'dekan', 'allApproved'));

    }

    public function updateStatus(Request $request)
    {
        // Validasi status yang dikirim
        $request->validate([
            'status' => 'required|in:Setuju,Tidak Setuju,Disetujui,Tidak Disetujui', // Sesuaikan dengan nilai status yang diinginkan
            'id' => 'required|exists:jadwals,id', // Pastikan id jadwal ada di database
        ]);

        $jadwal = Jadwal::findOrFail($request->id);
        $jadwal->status = $request->status;  // Update status
        $jadwal->save();

        return response()->json(['status' => $jadwal->status]);
    }

    public function updateAllStatusDekan(Request $request)
    {
        // Validasi status yang dikirim
        $request->validate([
            'status' => 'required|in:Disetujui,Tidak Disetujui', // Status yang valid
        ]);

        // Update status untuk semua jadwal
        Jadwal::query()->update(['status' => $request->status]);

        // Redirect kembali ke halaman jadwal
        return redirect()->route('dekan.jadwal')->with('success', 'Status semua matakuliah berhasil diubah!');
    }

    public function updateRuanganStatus(Request $request, $id_ruang)
    {
        $status = $request->status === 'Disetujui' ? 'Disetujui' : 'Tidak Disetujui';
        $keterangan = $request->status === 'Disetujui' ? 'Terpakai' : 'Tidak Tersedia';
        // dd($status, $keterangan);
        
        DB::table('ruangan')
            ->where('id_ruang', $id_ruang)
            ->update([
                'status' => $status,
                'keterangan' => $keterangan
            ]);

        return redirect()->back()->with('success', 'Status ruangan berhasil diperbarui');
    }
}