<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use App\Models\Ruangan; 
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TamuController extends Controller
{
    public function dashboard()
    {
        $tamus = Tamu::all();
        return view('dashboard', compact('tamus'));
    }

    public function index()
    {
        $tamus = Tamu::with('ruangan')->latest()->get();
        $ruangans = Ruangan::all(); 
        return view('tamu.index', compact('tamus', 'ruangans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
            'pesan' => 'required',
            'ruangan_id' => 'required|exists:ruangans,id'
        ]);

        Tamu::create($request->all());
        
        return redirect()->route('tamu.index')->with('success', 'Data tamu berhasil ditambah');
    }

    public function update(Request $request, $id)
    {
        $tamu = Tamu::findOrFail($id);
        
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
            'pesan' => 'required',
            'ruangan_id' => 'required|exists:ruangans,id'
        ]);

        $tamu->update($request->all());
        
        return redirect()->route('tamu.index')->with('success', 'Data tamu berhasil diupdate');
    }

    public function destroy($id)
    {
        Tamu::destroy($id);
        return redirect()->route('tamu.index')->with('success', 'Data tamu dihapus');
    }

    public function cetakPDF()
    {
        $tamus = Tamu::with('ruangan')->latest()->get();
        $pdf = Pdf::loadView('tamu.laporan-pdf', compact('tamus'));
        return $pdf->download('laporan-tamu-' . date('Y-m-d') . '.pdf');
    }

    // --- FUNGSI BARU UNTUK MONITORING KANTOR ---

    public function monitoring()
    {
        // Mengambil tamu yang datang hari ini
        $tamus = Tamu::with('ruangan')
                    ->whereDate('created_at', Carbon::today())
                    ->orderBy('created_at', 'desc')
                    ->get();

        // Hitung statistik singkat
        $totalHadir = $tamus->count();
        $diDalam = $tamus->where('jam_keluar', null)->count();
        $sudahPulang = $tamus->where('jam_keluar', '!=', null)->count();

        return view('tamu.monitoring', compact('tamus', 'totalHadir', 'diDalam', 'sudahPulang'));
    }

    // Fungsi untuk tombol Check-out
    public function checkout($id)
    {
        $tamu = Tamu::findOrFail($id);
        
        // Mengupdate jam_keluar dengan waktu sekarang
        $tamu->update([
            'jam_keluar' => now()
        ]);
        
        return redirect()->back()->with('success', 'Tamu telah berhasil check-out.');
    }

    public function survey() {
        return view('tamu.survey');
    }

    public function kirimSurvey(Request $request) {
    $request->validate([
        'nama_tamu' => 'required',
        'skor' => 'required|integer|between:1,5',
    ]);

    \App\Models\Penilaian::create([
        'nama_tamu' => $request->nama_tamu,
        'skor' => $request->skor,
        'komentar' => $request->komentar,
    ]);

    return redirect()->back()->with('success', 'Terima kasih atas penilaian Anda!');
    }
}