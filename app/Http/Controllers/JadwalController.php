<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kaprodi;
use App\Models\Matakuliah;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        // Validasi waktu
        $jamMulai = $request->jam_mulai;

        // Waktu minimal dan maksimal
        $minTime = '07:00';
        $maxTime = '18:30';

        if ($jamMulai < $minTime || $jamMulai > $maxTime) {
            return redirect()->back()->with('sweetAlert', [
                'title' => 'Error!',
                'text' => 'Jam mulai harus antara 07:00 dan 18:30.',
                'icon' => 'error'
            ]);
        }

        $request->validate([
            'kode_mk' => 'required|exists:matakuliah,kode_mk',
            'ruangan' => 'required|exists:ruangan,id',
            'kapasitas' => 'required|numeric|min:1',
            'sifat' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'nullable|date_format:H:i|after:jam_mulai',
            'kelas' => 'required',
        ]);
    
        $user = Auth::user();
        $kaprodi = Kaprodi::where('user_id', $user->id)->first();
    
        if (!$kaprodi) {
            return redirect()->back()->with('error', 'Data Kaprodi tidak ditemukan.');
        }
    
        $matakuliah = Matakuliah::where('kode_mk', $request->kode_mk)->first();
        $ruangan = Ruangan::where('id', $request->ruangan)->first();

        if (!$matakuliah || !$request->jam_mulai) {
            return redirect()->back()->with('error', 'Data mata kuliah atau waktu mulai tidak valid.');
        }

                // Ambil jumlah SKS
        $sks = $matakuliah->sks;

        // Perhitungan durasi berdasarkan SKS
        $durationMinutes = $sks * 50;
    
        // Perhitungan durasi berdasarkan SKS
        $durationMinutes = $matakuliah->sks * 50;
    
        // Konversi jam_mulai ke format waktu menggunakan Carbon
        $jamMulai = Carbon::createFromFormat('H:i', $request->jam_mulai);
        $jamSelesai = $jamMulai->copy()->addMinutes($durationMinutes);
    
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
    
        // Standardisasi format waktu
        $jamMulai = $request->jam_mulai . ':00';
        $jamSelesai = $request->jam_selesai . ':00';
    
        // Check for room conflicts - PERBAIKAN: menggunakan id_ruang yang benar
        $conflictingSchedule = DB::table('jadwal')
            ->where('hari', $request->hari)
            ->where('ruang', $ruangan->id_ruang)  // Menggunakan id_ruang bukan ID
            ->where(function ($query) use ($jamMulai, $jamSelesai) {
                $query->where('jam_selesai', '>', $jamMulai)
                      ->where('jam_mulai', '<', $jamSelesai);
            })
            ->first();
    
        if ($conflictingSchedule) {
            return redirect()->back()->with('sweetAlert', [
                'title' => 'Error!',
                'text' => "Jadwal Bentrok dengan mata kuliah {$conflictingSchedule->nama_mk} ({$conflictingSchedule->jam_mulai} - {$conflictingSchedule->jam_selesai})",
                'icon' => 'error'
            ]);
        }
    
        // PERBAIKAN: Menggunakan format waktu yang sudah distandarisasi
        DB::table('jadwal')->insert([
            'hari' => $request->hari,
            'jam_mulai' => $jamMulai,        // Menggunakan format yang distandarisasi
            'jam_selesai' => $jamSelesai,    // Menggunakan format yang distandarisasi
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