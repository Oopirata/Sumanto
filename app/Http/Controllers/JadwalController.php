<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kaprodi;
use App\Models\Matakuliah;
use App\Models\Dosen;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    //
    public function index(){
        $userr = Auth::user();
        $user = Kaprodi::where('user_id', $userr->id)->first();

        $data = Jadwal::all();

        

        return view('kaprodiBuatJadwal', compact('data', 'user'));


    }

    public function deleteJadwal(Request $request)
    {
    // Validasi data request
    $request->validate([
        'mata_kuliah_id' => 'required|string|exists:matakuliah,kode_mk', // validasi untuk mata kuliah
        'dosen_nip' => 'required|string|exists:dosen,nip', // validasi untuk dosen
    ]);

    // Menemukan mata kuliah dan dosen
    $mataKuliah = Matakuliah::where('kode_mk', $request->mata_kuliah_id)->first();
    $dosen = Dosen::where('nip', $request->dosen_nip)->first();

    // Memeriksa apakah data ditemukan dan hubungan dosen ada
    if ($mataKuliah && $dosen) {
        // Menghapus relasi dosen dan mata kuliah dari tabel pivot
        DB::table('dosen_matakuliah')
            ->where('kode_mk', $mataKuliah->kode_mk)
            ->where('dosen_nip', $dosen->nip)
            ->delete();
    }

    // Redirect dengan pesan sukses
    return redirect()->route('matakuliah.index')->with('success', 'Dosen berhasil dihapus dari Mata Kuliah.');
    }

    public function store(Request $request)
    {
        // Validasi data request
        $request->validate([
            'mata_kuliah_id' => 'required|string|exists:matakuliah,kode_mk', // validasi untuk mata kuliah
            'dosen_nip' => 'required|string|exists:dosen,nip', // validasi untuk dosen
        ]);

        // Menambahkan data dosen ke mata kuliah (hubungan dosen dengan mata kuliah)
        $mataKuliah = Matakuliah::where('kode_mk', $request->mata_kuliah_id)->first();
        $dosen = Dosen::where('nip', $request->dosen_nip)->first();

        // Memeriksa apakah mata kuliah ditemukan
        if ($mataKuliah) {
            // Mengecek apakah sudah ada entri dengan dosen_nip dan kode_mk yang sama di tabel pivot
            $exists = DB::table('dosen_matakuliah')
                ->where('dosen_nip', $dosen->nip)
                ->where('kode_mk', $mataKuliah->kode_mk)
                ->exists();

            if ($exists) {
                // Jika sudah ada, berikan respons atau pesan
                return redirect()->back()->with('error', 'Dosen ini sudah terhubung dengan mata kuliah ini.');
            }

            // Jika belum ada, tambahkan data ke tabel pivot
            DB::table('dosen_matakuliah')->insert([
                'dosen_nip' => $dosen->nip,
                'kode_mk' => $mataKuliah->kode_mk,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        

        // Redirect dengan pesan sukses
        return redirect()->route('matakuliah.index')->with('success', 'Dosen berhasil ditambahkan ke Mata Kuliah.');
        }

        public function dosenHapusOption($mataKuliahId)
        {
            $dosen = DB::table('dosen')
                ->join('dosen_matakuliah', 'dosen.nip', '=', 'dosen_matakuliah.dosen_nip')
                ->where('dosen_matakuliah.kode_mk', $mataKuliahId)
                ->select('dosen.nip', 'dosen.nama')
                ->get();

            return response()->json(['dosen' => $dosen]);
        }
}
