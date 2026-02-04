<?php

namespace App\Http\Controllers;

use App\Models\KonfigurasiBiaya;
use Illuminate\Http\Request;

class KonfigurasiBiayaController extends Controller
{
    // Menampilkan halaman tabel konfigurasi (View Only)
    public function show()
    {
        $biaya = KonfigurasiBiaya::all();
        return view('alokasi-biaya.show', compact('biaya'));
    }

    // Menampilkan form edit (Tabel Input)
    public function edit()
    {
        // Ambil semua data untuk ditampilkan di form edit
        $biaya = KonfigurasiBiaya::all();
        return view('alokasi-biaya.edit', compact('biaya'));
    }
    // -----------------------------

    // Menyimpan perubahan (Batch Update)
    public function update(Request $request)
    {
        $request->validate([
            'biaya' => 'required|array', 
            'biaya.*.id' => 'required|exists:konfigurasi_biayas,id',
            'biaya.*.mikro' => 'required|numeric|min:0',
            'biaya.*.kecil' => 'required|numeric|min:0',
            'biaya.*.menengah' => 'required|numeric|min:0',
            'biaya.*.besar' => 'required|numeric|min:0',
        ]);

        foreach ($request->biaya as $id => $data) {
            $item = KonfigurasiBiaya::find($id);
            if ($item) {
                $item->update([
                    'mikro' => $data['mikro'],
                    'kecil' => $data['kecil'],
                    'menengah' => $data['menengah'],
                    'besar' => $data['besar'],
                ]);
            }
        }

        // Redirect kembali ke halaman SHOW setelah simpan
        return redirect()->route('alokasi-biaya.show')
                         ->with('success', 'Aturan Fee & Pajak berhasil diperbarui.');
    }
}