<?php

namespace App\Http\Controllers;

use App\Models\PelakuUsaha;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Import Rule untuk validasi

class PelakuUsahaController extends Controller
{
    private $skalaUsahaOptions = ['Mikro dan Kecil', 'Menengah', 'Besar'];
    private $jenisProdukOptions = [
        'Susu dan analognya', 'Lemak, minyak, dan emulsi minyak', 'Es untuk dimakan (edible ice)',
        'Buah dan sayur dengan pengolahan', 'Kembang gula/permen dan cokelat', 'Serealia dan produk serealia',
        'Produk bakeri', 'Daging dan produk olahan daging', 'Ikan dan produk perikanan', 'Telur olahan',
        'Gula dan pemanis', 'Garam, rempah, sup, saus, salad', 'Pangan olahan untuk keperluan gizi khusus',
        'Makanan ringan siap santap', 'Pangan siap saji', 'Minuman dengan pengolahan', 'Obat tradisional',
        'Suplemen kesehatan', 'Kosmetika', 'Jasa Penyembelihan',
    ];

    public function index()
    {
        $pelaku_usahas = PelakuUsaha::with('wilayah')->oldest()->get();
        return view('pelaku-usaha.index', compact('pelaku_usahas'));
    }

    public function create()
    {
        $wilayahs = Wilayah::orderBy('nama_provinsi')->get();
        return view('pelaku-usaha.create', [
            'wilayahs' => $wilayahs,
            'skalaUsahaOptions' => $this->skalaUsahaOptions,
            'jenisProdukOptions' => $this->jenisProdukOptions,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_sttd' => 'required|string|unique:pelaku_usahas',
            'nama_usaha' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'wilayah_id' => 'required|exists:wilayahs,id',
            'skala_usaha' => 'required|string',
            'jenis_produk' => 'required|string',
            'jumlah_produk' => 'required|integer',
            'biaya' => 'required|numeric',
            'jumlah_audit' => 'required|integer',
        ]);

        PelakuUsaha::create($request->all());

        return redirect()->route('pelaku-usaha.index')
                         ->with('success', 'Data Pelaku Usaha berhasil ditambahkan.');
    }

    public function show(PelakuUsaha $pelakuUsaha)
    {
        $pelakuUsaha->load('wilayah');
        
        return view('pelaku-usaha.show', compact('pelakuUsaha'));
    }

    /**
     * Menampilkan form untuk mengedit Pelaku Usaha.
     */
    public function edit(PelakuUsaha $pelakuUsaha)
    {
        $wilayahs = Wilayah::orderBy('nama_provinsi')->get();
        return view('pelaku-usaha.edit', [
            'pelakuUsaha' => $pelakuUsaha,
            'wilayahs' => $wilayahs,
            'skalaUsahaOptions' => $this->skalaUsahaOptions,
            'jenisProdukOptions' => $this->jenisProdukOptions,
        ]);
    }

    /**
     * Memperbarui data Pelaku Usaha di database.
     */
    public function update(Request $request, PelakuUsaha $pelakuUsaha)
    {
        $request->validate([
            // Aturan 'unique' di bawah ini mengabaikan ID dari data yang sedang diedit
            'no_sttd' => ['required', 'string', Rule::unique('pelaku_usahas')->ignore($pelakuUsaha->id)],
            'nama_usaha' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'wilayah_id' => 'required|exists:wilayahs,id',
            'skala_usaha' => 'required|string',
            'jenis_produk' => 'required|string',
            'jumlah_produk' => 'required|integer',
            'biaya' => 'required|numeric',
            'jumlah_audit' => 'required|integer',
        ]);

        $pelakuUsaha->update($request->all());

        return redirect()->route('pelaku-usaha.index')
                         ->with('success', 'Data Pelaku Usaha berhasil diperbarui.');
    }

    /**
     * Menghapus Pelaku Usaha dari database.
     */
    public function destroy(PelakuUsaha $pelakuUsaha)
    {
        $pelakuUsaha->delete();

        return redirect()->route('pelaku-usaha.index')
                         ->with('success', 'Data Pelaku Usaha berhasil dihapus.');
    }
}

