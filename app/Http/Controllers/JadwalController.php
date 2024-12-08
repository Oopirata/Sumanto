<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kaprodi;
use App\Models\Matakuliah;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    //
    public function index(){
        $user = Auth::user();
        $userr = Kaprodi::where('user_id', $user->id)->first();

        $data = Jadwal::where('prodi', $userr->nama_prodi)->get();
        // dd($data);
        $mk = MataKuliah::all();
        $ruangan = Ruangan::where('status', 'Disetujui')->get();

        
        return view('kaprodiBuatJadwal', compact('data', 'user', 'mk', 'ruangan', 'userr'));


    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'kode_mk' => 'required|exists:matakuliah,kode_mk',
            'ruangan' => 'required|exists:ruangan,id',
            'kapasitas' => 'required|numeric|min:1',
            'sifat' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kelas' => 'required',
        ]);

        $user = Auth::user();
        $kaprodi = Kaprodi::where('user_id', $user->id)->first();

        if (!$kaprodi) {
            return redirect()->back()->with('error', 'Data Kaprodi tidak ditemukan.');
        }

        $matakuliah = Matakuliah::where('kode_mk', $request->kode_mk)->first();
        $ruangan = Ruangan::where('id', $request->ruangan)->first();

        // Check for duplicate schedule
        $jadwalExists = DB::table('jadwal')
            ->where('kode_mk', $request->kode_mk)
            ->where('kelas', $request->kelas)
            ->exists();

        if ($jadwalExists) {
            return redirect()->back()->with('sweetAlert', [
                'title' => 'Error!',
                'text' => 'Jadwal Sudah Ada.',
                'icon' => 'error'
            ]);
        }

        // Check for room conflicts
        $conflictingSchedule = DB::table('jadwal')
            ->where('hari', $request->hari)
            ->where(function ($query) use ($request) {
                // Konflik waktu
                $query->where(function ($q) use ($request) {
                    $q->where('jam_mulai', '<=', $request->jam_mulai)
                    ->where('jam_selesai', '>', $request->jam_mulai);
                })
                ->orWhere(function ($q) use ($request) {
                    $q->where('jam_mulai', '<', $request->jam_selesai)
                    ->where('jam_selesai', '>=', $request->jam_selesai);
                })
                ->orWhere(function ($q) use ($request) {
                    $q->where('jam_mulai', '>=', $request->jam_mulai)
                    ->where('jam_selesai', '<=', $request->jam_selesai);
                });
            })
            ->where(function ($query) use ($request) {
                // Konflik ruangan ATAU kelas yang sama
                $query->where('ruang', $request->ruangan)
                    ->orWhere('kelas', $request->kelas);
            })
            ->first();

        if ($conflictingSchedule) {
            $conflictType = $conflictingSchedule->ruang == $request->ruangan ? 'ruangan' : 'kelas';
            return redirect()->back()->with('sweetAlert', [
                'title' => 'Error!',
                'text' => 'Jadwal Bentrok.',
                'icon' => 'error'
            ]);
        }

        // dd($request->all());

        DB::table('jadwal')->insert([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruang' => $ruangan->id_ruang,
            'kode_mk' => $request->kode_mk,
            'nama_mk' => $matakuliah->nama_mk,
            'sks' => $matakuliah->sks,
            'semester' => $matakuliah->semester,
            'kelas' => $request->kelas,
            'kapasitas' => $request->kapasitas,
            'status' => 'Belum Disetujui',
            'prodi' => $kaprodi->nama_prodi,
            'sifat' => $request->sifat,
        ]);

        return redirect()->back()->with('sweetAlert', [
            'title' => 'Berhasil!',
            'text' => 'Jadwal berhasil ditambahkan.',
            'icon' => 'success'
        ]);
    }

    public function destroy(Request $request)
    {
        // Validasi bahwa jadwal_id harus ada dalam request
        $request->validate([
            'id' => 'required|exists:jadwal,id',
        ]);
        // dd($request->all());

        // Cari jadwal berdasarkan jadwal_id yang dikirim dari form
        DB::table('jadwal')->where('id', $request->id)->delete();
        
        return redirect()->back()->with('sweetAlert', [
            'title' => 'Berhasil!',
            'text' => 'Jadwal berhasil dihapus.',
            'icon' => 'success'
        ]);
    }

    // Dalam JadwalController.php
    public function updateAllStatus(Request $request)
    {
        // Logika untuk mengubah status semua jadwal menjadi "Diajukan"
        DB::table('jadwal')
            ->update(['status' => 'Diajukan']);

        return response()->json(['message' => 'Semua jadwal berhasil diajukan.']);
    }   
}