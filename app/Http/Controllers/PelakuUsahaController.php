<?php

namespace App\Http\Controllers;

use App\Models\PelakuUsaha;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Illuminate\Support\Facades\DB;

class PelakuUsahaController extends Controller
{
    // Opsi dropdown (tetap sama)
    private $skalaUsahaOptions = ['Mikro dan Kecil', 'Menengah', 'Besar'];
    private $jenisProdukOptions = [
        'Susu dan analognya', 'Lemak, minyak, dan emulsi minyak', 'Es untuk dimakan (edible ice)',
        'Buah dan sayur dengan pengolahan', 'Kembang gula/permen dan cokelat', 'Serealia dan produk serealia',
        'Produk bakeri', 'Daging dan produk olahan daging', 'Ikan dan produk perikanan', 'Telur olahan',
        'Gula dan pemanis', 'Garam, rempah, sup, saus, salad', 'Pangan olahan untuk keperluan gizi khusus',
        'Makanan ringan siap santap', 'Pangan siap saji', 'Minuman dengan pengolahan', 'Obat tradisional',
        'Suplemen kesehatan', 'Kosmetika', 'Jasa Penyembelihan',
    ];

    /**
     * Menampilkan daftar Pelaku Usaha.
     * Kita ganti relasi 'wilayah' menjadi 'city.province'
     */
    public function index()
    {
        // Menggunakan relasi baru: city, dan dari city ke province
        $pelaku_usahas = PelakuUsaha::with('city.province')->oldest()->get();
        return view('pelaku-usaha.index', compact('pelaku_usahas'));
    }

    /**
     * Menampilkan form 'create' dengan data provinsi.
     */
    public function create()
    {
        // Mengambil data dari tabel 'provinces' (BUKAN 'wilayahs')
        $provinces = Province::pluck('name', 'id'); 

        return view('pelaku-usaha.create', [
            'provinces' => $provinces, // Mengirim variabel $provinces
            'skalaUsahaOptions' => $this->skalaUsahaOptions,
            'jenisProdukOptions' => $this->jenisProdukOptions,
        ]);
    }

    /**
     * Menyimpan data baru. Validasi diubah ke 'city_id'.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_sttd' => 'required|string|unique:pelaku_usahas',
            'nama_usaha' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'city_id' => 'required|exists:cities,code',
            'skala_usaha' => 'required|string',
            'jenis_produk' => 'required|string',
            'jumlah_produk' => 'required|integer',
            'biaya' => 'required|numeric',
            'jumlah_audit' => 'required|integer',
        ]);

        // 'city_id' akan otomatis terisi karena ada di $fillable Model
        PelakuUsaha::create($request->all());

        return redirect()->route('pelaku-usaha.index')
                         ->with('success', 'Data Pelaku Usaha berhasil ditambahkan.');
    }

    /**
     * Menampilkan halaman 'show' (view)
     */
    public function show(PelakuUsaha $pelakuUsaha)
    {
        $pelakuUsaha->load('city.province'); // Muat relasi bertingkat
        return view('pelaku-usaha.show', compact('pelakuUsaha'));
    }

    /**
     * Menampilkan form 'edit' dengan data provinsi dan kota yang sudah ada.
     */
    public function edit(PelakuUsaha $pelakuUsaha)
    {
        // 1. Muat relasi yang diperlukan (city dan province dari city)
        $pelakuUsaha->load('city.province');

        // 2. Ambil semua provinsi (untuk dropdown provinsi)
        $provinces = Province::pluck('name', 'id');

        // 3. Ambil 'province_code' dari relasi yang sudah dimuat
        //    ($pelakuUsaha->city->province_code)
        $provinceCode = $pelakuUsaha->city->province_code;
        
        // 4. Ambil SEMUA kota yang termasuk dalam provinsi tersebut
        //    Kita butuh 'code' (untuk value) dan 'name' (untuk display)
        $cities = City::where('province_code', $provinceCode)
                      ->select('code', 'name')
                      ->get();

        return view('pelaku-usaha.edit', [
            'pelakuUsaha' => $pelakuUsaha,
            'provinces' => $provinces,
            'cities' => $cities, // Kirim daftar kota yang sudah difilter
            'skalaUsahaOptions' => $this->skalaUsahaOptions,
            'jenisProdukOptions' => $this->jenisProdukOptions,
        ]);
    }

    /**
     * Menyimpan perubahan. Validasi diubah ke 'city_id'.
     */
    public function update(Request $request, PelakuUsaha $pelakuUsaha)
    {
        $request->validate([
            'no_sttd' => ['required', 'string', Rule::unique('pelaku_usahas')->ignore($pelakuUsaha->id)],
            'nama_usaha' => ['required', 'string', 'max:255'],
            'alamat_lengkap' => 'required|string',
            'city_id' => 'required|exists:cities,code',
            'skala_usaha' => 'required|string',
            'jenis_produk' => 'required|string',
            'jumlah_produk' => 'required|integer',
            'biaya' => 'required|numeric',
            'jumlah_audit' => 'required|integer',
        ]);

        $pelakuUsaha->update($request->all());

        // Arahkan kembali ke halaman show
        return redirect()->route('pelaku-usaha.show', $pelakuUsaha->id) 
                         ->with('success', 'Data Pelaku Usaha berhasil diperbarui.');
    }

    /**
     * Menghapus data.
     */
    public function destroy(PelakuUsaha $pelakuUsaha)
    {
        $pelakuUsaha->delete();
        return redirect()->route('pelaku-usaha.index')
                         ->with('success', 'Data Pelaku Usaha berhasil dihapus.');
    }

    // --- METHOD BARU UNTUK AJAX DROPDOWN ---
    /**
     * Mengambil daftar kota berdasarkan province_id.
     */
    public function getCities(Request $request)
    {
        // 1. Validasi input (ini sudah benar)
        $request->validate(['province_id' => 'required|exists:provinces,id']);

        // 2. Ambil ID provinsi dari request
        $provinceId = $request->province_id;

        // 3. Cari provinsi berdasarkan ID untuk mendapatkan 'code'-nya
        //    (Kita butuh model Province untuk ini)
        $province = Province::find($provinceId);

        if (!$province) {
            return response()->json([], 404); // Seharusnya tidak terjadi, tapi aman
        }

        // 4. Ambil 'code' provinsi (misal: "34" untuk Yogyakarta)
        $provinceCode = $province->code;

        // 5. Cari kota berdasarkan 'province_code' (sesuai skema database Anda)
        //    DAN pilih 'code' dan 'name' (BUKAN 'id')
        $cities = City::where('province_code', $provinceCode)
                      ->select('code', 'name') // <-- PENTING: Pilih 'code'
                      ->get();
        
        // 6. Kembalikan sebagai JSON
        return response()->json($cities);
    }
}