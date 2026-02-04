<?php

namespace App\Http\Controllers;

use Laravolt\Indonesia\Models\Province;
use Illuminate\Http\Request;

class PengaturanBiayaAuditController extends Controller
{
    /**
     * Menampilkan daftar semua pengaturan biaya provinsi.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Mengambil data provinsi dengan pencarian dan pagination
        $provinces = Province::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('name', 'asc') // Urutkan nama A-Z
            ->paginate(8);

        $provinces->appends(['search' => $search]);

        return view('pengaturan-biaya-audit.index', compact('provinces'));
    }

    /**
     * Menampilkan form "Edit" untuk satu provinsi spesifik.
     */
    // Ganti 'Wilayah $wilayah' menjadi 'Province $province' (Route Model Binding)
    public function edit(Province $province)
    {
        // Ganti 'wilayah' menjadi 'province'. 
        // Ini akan memperbaiki error 'Undefined variable $konfigurasiBiaya'
        // jika Anda mengganti variabel di view Anda menjadi '$province'
        return view('pengaturan-biaya-audit.edit', compact('province'));
    }

    /**
     * Menyimpan perubahan untuk satu provinsi.
     */
    // Ganti 'Wilayah $wilayah' menjadi 'Province $province'
    public function update(Request $request, Province $province)
    {
        // Validasi data yang masuk (nama kolom sudah sesuai dengan migrasi baru)
        $validatedData = $request->validate([
            'transport_dalam_kota' => 'required|numeric|min:0',
            'uhpd_dalam_kota' => 'required|numeric|min:0',
            'hotel_luar_kota' => 'required|numeric|min:0',
            'transport_luar_kota' => 'required|numeric|min:0',
            'tiket_pesawat_luar_kota' => 'required|numeric|min:0',
            'uhpd_luar_kota' => 'required|numeric|min:0',
        ]);

        // Update data 'province' di database
        $province->update($validatedData);

        // Ganti '$wilayah->nama_provinsi' menjadi '$province->name'
        return redirect()->route('pengaturan-biaya-audit.index')
            ->with('success', 'Biaya untuk ' . $province->name . ' berhasil diperbarui.');
    }
}