<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RuanganController extends Controller
{
    public function index(Request $request)
    {
        $dosens = Auth::user();
        $dosen = DB::table('bagian_akademik')->where('user_id', $dosens->id)->first();

        if ($request->ajax()) {
            $query = Ruangan::query();
            
            $selectedJurusan = $request->input('jurusan');
            if ($selectedJurusan) {
                $query->where(function($q) use ($selectedJurusan) {
                    $q->where('prodi', $selectedJurusan)
                    ->orWhereNull('prodi');
                });
            }
        
            $ruang = $query->get();
            
            return response()->json(['ruang' => $ruang]);
        }

        // Ambil satu ruangan default untuk form tambah
        $defaultRuang = (object)[
            'keterangan' => 'Tidak Tersedia' // Set default value untuk keterangan
        ];

        $ruang = Ruangan::all();
        return view('baRuangan', [
            'ruang' => $ruang,
            'dosen' => $dosen, 
            'dosens' => $dosens,
            'defaultRuang' => $defaultRuang  // Tambahkan defaultRuang ke view
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'lokasi' => 'required',
            'id_ruang' => 'required',
            'kapasitas' => 'required|numeric|min:1',
        ]);

        if (Ruangan::where('id_ruang', $request->id_ruang)->exists()) {
            return redirect()->back()->with('error', 'ID Ruangan sudah ada');
        }

        DB::table('ruangan')->insert([
            'id_ruang' => $request->id_ruang,
            'nama' => 'Ruangan Kuliah' . $request->id_ruang,
            'kapasitas' => $request->kapasitas,
            'lokasi' => $request->lokasi,
            'status' => 'Pending',
            'keterangan' => 'Tidak Tersedia',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function destroy($id_ruang)
    {
        DB::table('ruangan')->where('id_ruang', $id_ruang)->delete();
        return redirect()->back()->with('success', 'Ruangan berhasil dihapus');
    }

    public function updateKapasitas(Request $request, $id_ruang)
    {
        $request->validate([
            'kapasitas' => 'required|numeric|min:1'
        ]);

        DB::table('ruangan')
            ->where('id_ruang', $id_ruang)
            ->update(['kapasitas' => $request->kapasitas]);

        return redirect()->back()->with('success', 'Kapasitas ruangan berhasil diperbarui');
    }

    public function update(Request $request, $id_ruang)
    {
        $validatedData = $request->validate([
            'keterangan' => 'required|in:Tersedia,Terpakai',
            'prodi' => 'nullable|string'
        ]);

        // Debug untuk melihat data yang diterima
        // dd($request->all());

        $updateData = [
            'keterangan' => $validatedData['keterangan'],
            'prodi' => $validatedData['prodi'] ?? null,  // Gunakan null coalescing operator
            'status' => 'Diajukan',
        ];

        DB::table('ruangan')
            ->where('id_ruang', $id_ruang)
            ->update($updateData);

        return redirect()->back()->with('success', 'Status ruangan berhasil diperbarui');
    }
}