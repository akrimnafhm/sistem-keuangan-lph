<?php

namespace App\Http\Controllers;

use App\Models\KonfigurasiBiaya;
use Illuminate\Http\Request;

class KonfigurasiBiayaController extends Controller
{
    /**
     * Tampilkan halaman view (read-only) untuk alokasi biaya.
     */
    public function show()
    {
        $konfigurasi = KonfigurasiBiaya::firstOrFail();
        return view('alokasi-biaya.show', compact('konfigurasi'));
    }

    /**
     * Menampilkan halaman form untuk mengedit alokasi biaya.
     */
    public function edit()
    {
        $konfigurasi = KonfigurasiBiaya::firstOrFail();
        return view('alokasi-biaya.edit', compact('konfigurasi'));
    }

    /**
     * Memperbarui data alokasi biaya di database.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'pajak' => 'required|numeric|min:0|max:100',
            'fee_uin_mikro' => 'required|numeric|min:0',
            'fee_uin_menengah' => 'required|numeric|min:0',
            'fee_uin_besar' => 'required|numeric|min:0',
            'fee_lph_mikro' => 'required|numeric|min:0',
            'fee_lph_menengah' => 'required|numeric|min:0',
            'fee_lph_besar' => 'required|numeric|min:0',
            'unit_cost_audit_mikro' => 'required|numeric|min:0|max:100',
            'unit_cost_audit_menengah' => 'required|numeric|min:0|max:100',
            'unit_cost_audit_besar' => 'required|numeric|min:0|max:100',
        ]);

        $konfigurasi = KonfigurasiBiaya::firstOrFail();
        $konfigurasi->update($validatedData);

        // Ubah redirect ke halaman 'show' (view)
        return redirect()->route('alokasi-biaya.show')
                         ->with('success', 'Pengaturan alokasi biaya berhasil diperbarui.');
    }
}