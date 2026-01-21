<?php

namespace App\Http\Controllers; // <--- PASTIKAN HURUF BESAR KECILNYA SAMA PERSIS

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::all();
        return view('ruangan.index', compact('ruangans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ruangan' => 'required',
            'lokasi' => 'required'
        ]);

        Ruangan::create($request->all());
        return redirect()->back()->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Ruangan::destroy($id);
        return redirect()->back();
    }
}