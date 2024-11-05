<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;



class DosenController extends Controller
{
    //
    public function index()
    {
        $dosens = Dosen::all();
        return view('kaprodiMatkulDosen', compact('dosens'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:dosen',
            'nama' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required'
        ]);

        Dosen::create($request->all());

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required'
        ]);

        $dosen = Dosen::findOrFail($id);
        $dosen->update($request->all());

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diupdate.');
    }
}
