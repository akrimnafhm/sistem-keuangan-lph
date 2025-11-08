<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;

class PengaturanBiayaAuditController extends Controller
{
    /**
     * Menampilkan halaman "View" (daftar) semua pengaturan biaya wilayah.
     */
    public function index()
    {
        // Ambil semua data wilayah, urutkan berdasarkan nama provinsi
        $wilayahs = Wilayah::orderBy('nama_provinsi', 'asc')->get();
        
        return view('pengaturan-biaya-audit.index', compact('wilayahs'));
    }

    /**
     * Menampilkan form "Edit" untuk satu wilayah spesifik.
     */
    public function edit(Wilayah $wilayah)
    {
        // $wilayah sudah otomatis diambil dari database berdasarkan ID di URL
        return view('pengaturan-biaya-audit.edit', compact('wilayah'));
    }

    /**
     * Menyimpan perubahan untuk satu wilayah.
     */
    public function update(Request $request, Wilayah $wilayah)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'transport_dalam_kota' => 'required|numeric|min:0',
            'uhpd_dalam_kota' => 'required|numeric|min:0',
            'hotel_luar_kota' => 'required|numeric|min:0',
            'transport_luar_kota' => 'required|numeric|min:0',
            'tiket_pesawat_luar_kota' => 'required|numeric|min:0',
            'uhpd_luar_kota' => 'required|numeric|min:0',
        ]);

        // Update data wilayah di database
        $wilayah->update($validatedData);

        // Redirect kembali ke halaman "View" (index) dengan pesan sukses
        return redirect()->route('pengaturan-biaya-audit.index')
                         ->with('success', 'Biaya untuk ' . $wilayah->nama_provinsi . ' berhasil diperbarui.');
    }
}