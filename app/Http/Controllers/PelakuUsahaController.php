<?php

namespace App\Http\Controllers;

use App\Models\PelakuUsaha;
use App\Models\Auditor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PelakuUsahaController extends Controller
{
    // Konstanta batas minimal dan maksimal auditor per pelaku usaha
    private const MIN_AUDITORS = 2;
    private const MAX_AUDITORS = 4;

    // Opsi dropdown (tetap sama)
    private $skalaUsahaOptions = ['Mikro', 'Kecil', 'Menengah', 'Besar'];
    private $jenisProdukOptions = [
        'Susu dan analognya',
        'Lemak, minyak, dan emulsi minyak',
        'Es untuk dimakan (edible ice) termasuk sherbet dan sorbet',
        'Buah dan sayur dengan pengolahan dan penambahan bahan tambahan pangan',
        'Kembang gula/permen dan cokelat',
        'Serealia dan produk serealia yang merupakan produk turunan dari biji serealia, akar dan umbi, kacang-kacangan dan empulur dengan pengolahan dan penambahan bahan tambahan pangan',
        'Produk bakeri',
        'Daging dan produk olahan daging',
        'Daging dan produk olahan daging (Gelatin)',
        'Ikan dan produk perikanan, termasuk moluska, krustase, dan ekinodermata dengan pengolahan dan penambahan bahan tambahan pangan',
        'Telur olahan dan produk-produk telur hasil olahan',
        'Gula dan pemanis termasuk madu',
        'Garam, rempah, sup, saus, salad, serta produk protein',
        'Pangan olahan untuk keperluan gizi khusus',
        'Makanan ringan siap santap',
        'Pangan siap saji',
        'Penyediaan makanan dan minuman dengan pengolahan',
        'Bahan tambahan pangan',
        'Kelompok bahan lainnya',
        'Minuman dengan pengolahan',
        'Kelompok bahan minuman',
        'Obat tradisional',
        'Suplemen kesehatan',
        'Obat kuasi',
        'Obat bebas',
        'Obat bebas terbatas',
        'Obat keras dikecualikan narkotika dan psikotropika',
        'Bahan obat',
        'Kosmetika',
        'Kelompok bahan penolong',
        'Bahan kimiawi lainnya',
        'Bahan kimiawi lainnya (Flavor dan Fragrance)',
        'Produk biologi',
        'Produk biologi (Vaksin)',
        'Produk rekayasa genetik',
        'Sandang',
        'Penutup kepala',
        'Aksesoris',
        'Perbekalan kesehatan rumah tangga',
        'Peralatan rumah tangga',
        'Peralatan peribadatan bagi umat Islam',
        'Kemasan produk',
        'Alat tulis dan perlengkapan kantor',
        'Alat kesehatan',
        'Bahan penyusun barang gunaan',
        'Jasa Penyembelihan',
        'Jasa Pengolahan',
        'Jasa penyimpanan',
        'Jasa pengemasan',
        'Jasa pendistribusian',
        'Jasa penjualan tanpa proses pengolahan/memasak',
        'Jasa penyajian tanpa proses pengolahan/memasak',
    ];

    /**
     * Menampilkan daftar Pelaku Usaha.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Mengambil data dengan pencarian
        $pelaku_usahas = PelakuUsaha::with('city') // Eager load city
            ->when($search, function ($query, $search) {
                $query->where('nama_usaha', 'like', "%{$search}%")
                    ->orWhere('no_sttd', 'like', "%{$search}%");
            })
            ->latest() // Urutkan terbaru
            ->paginate(10); // Batasi 10 per halaman

        $pelaku_usahas->appends(['search' => $search]);

        return view('pelaku-usaha.index', compact('pelaku_usahas'));
    }
    /**
     * Menampilkan form 'create' dengan data provinsi.
     */
    public function create()
    {
        Log::debug('PelakuUsahaController@create called', ['user' => auth()->user() ? auth()->user()->only(['id', 'username', 'level']) : null]);
        $provinces = Province::pluck('name', 'id');
        $auditors = Auditor::where('status', 'Aktif')->pluck('nama', 'id');
        $maxAuditors = min($auditors->count(), self::MAX_AUDITORS);

        return view('pelaku-usaha.create', [
            'provinces' => $provinces,
            'auditors' => $auditors,
            'maxAuditors' => $maxAuditors,
            'skalaUsahaOptions' => $this->skalaUsahaOptions,
            'jenisProdukOptions' => $this->jenisProdukOptions,
        ]);
    }

    /**
     * Menyimpan data baru. Validasi diubah ke 'city_id'.
     */
    public function store(Request $request)
    {
        $maxAuditors = min(Auditor::where('status', 'Aktif')->count(), self::MAX_AUDITORS);
        $request->validate([
            'no_sttd' => 'required|string|unique:pelaku_usahas',
            'nama_usaha' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'city_id' => ['required', Rule::exists(config('laravolt.indonesia.table_prefix') . 'cities', 'code')], // Validasi yang lebih aman
            'skala_usaha' => 'required|string',
            'jenis_produk' => 'required|string',
            'jumlah_produk' => 'required|integer',
            'biaya' => 'required|numeric',
            'jumlah_audit' => 'required|integer|min:' . self::MIN_AUDITORS . '|max:' . $maxAuditors,
            'mandays' => 'required|integer|min:1',
            'auditor_ids' => 'required|array|size:' . $request->jumlah_audit,
            'auditor_ids.*' => 'exists:auditors,id',
        ]);

        $pelakuUsaha = PelakuUsaha::create($request->except('auditor_ids'));

        $syncData = [];
        foreach (array_values($request->auditor_ids) as $index => $auditorId) {
            $syncData[$auditorId] = ['sort_order' => $index];
        }

        $pelakuUsaha->auditors()->attach($syncData);

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
        $pelakuUsaha->load(['city.province', 'auditors']);
        $provinces = Province::pluck('name', 'id');
        $auditors = Auditor::where('status', 'Aktif')->pluck('nama', 'id');
        $maxAuditors = min($auditors->count(), self::MAX_AUDITORS);
        $provinceCode = $pelakuUsaha->city->province_code ?? null;
        $cities = City::where('province_code', $provinceCode)
            ->pluck('name', 'code');

        return view('pelaku-usaha.edit', [
            'pelakuUsaha' => $pelakuUsaha,
            'provinces' => $provinces,
            'cities' => $cities,
            'auditors' => $auditors,
            'maxAuditors' => $maxAuditors,
            'skalaUsahaOptions' => $this->skalaUsahaOptions,
            'jenisProdukOptions' => $this->jenisProdukOptions,
        ]);
    }

    /**
     * Menyimpan perubahan. Validasi diubah ke 'city_id'.
     */
    public function update(Request $request, PelakuUsaha $pelakuUsaha)
    {
        // 1. Ambil Max Auditor untuk Validasi (maksimal 4 per pelaku usaha)
        $maxAuditors = min(Auditor::where('status', 'Aktif')->count(), self::MAX_AUDITORS);

        // 2. Validasi Input
        $request->validate([
            'no_sttd' => ['required', 'string', Rule::unique('pelaku_usahas')->ignore($pelakuUsaha->id)],
            'nama_usaha' => ['required', 'string', 'max:255'],
            'alamat_lengkap' => 'required|string',
            'city_id' => ['required', Rule::exists(config('laravolt.indonesia.table_prefix') . 'cities', 'code')],
            'skala_usaha' => 'required|string',
            'jenis_produk' => 'required|string',
            'jumlah_produk' => 'required|integer',
            'biaya' => 'required|numeric',
            'jumlah_audit' => 'required|integer|min:' . self::MIN_AUDITORS . '|max:' . $maxAuditors,
            'mandays' => 'required|integer|min:1',
            // Validasi Array Auditor
            'auditor_ids' => 'required|array|size:' . $request->jumlah_audit,
            'auditor_ids.*' => 'required|exists:auditors,id', // Pastikan ID valid & tidak kosong
        ], [
            // Custom Error Message agar kamu tahu letak salahnya
            'auditor_ids.size' => 'Jumlah auditor yang dipilih harus sama dengan angka Jumlah Audit.',
            'auditor_ids.*.required' => 'Silakan pilih nama auditor pada semua kolom yang tersedia.',
            'jumlah_audit.max' => 'Jumlah audit melebihi total auditor aktif (' . $maxAuditors . ' orang).',
        ]);

        // 3. Update Data Utama
        $pelakuUsaha->update($request->except(['auditor_ids']));

        // 4. Update Relasi Auditor (Sync)
        // filter array_filter berguna membuang nilai null/kosong jika ada
        if ($request->has('auditor_ids')) {
            $ids = array_values(array_filter($request->auditor_ids, fn($value) => !is_null($value) && $value !== ''));
            $syncData = [];
            foreach ($ids as $index => $auditorId) {
                $syncData[$auditorId] = ['sort_order' => $index];
            }
            $pelakuUsaha->auditors()->sync($syncData);
        } else {
            $pelakuUsaha->auditors()->detach();
        }

        // 5. Redirect ke Index (Pasti Jalan jika tidak ada error validasi)
        return redirect()->route('pelaku-usaha.index')
                         ->with('success', 'Data pelaku usaha berhasil diperbarui.');
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
        // 1. Validasi input MENGGUNAKAN Rule::exists
        $request->validate([
            'province_id' => [
                'required',
                Rule::exists((new Province())->getTable(), 'id')
            ]
        ]);

        // 2. Ambil ID provinsi dari request
        $provinceId = $request->province_id;

        // 3. Cari provinsi berdasarkan ID
        $province = Province::find($provinceId);

        // 4. Periksa jika provinsinya ada
        if (!$province) {
            return response()->json(['message' => 'Province not found'], 404);
        }

        // 5. Ambil 'code' provinsi
        $provinceCode = $province->code;

        // 6. Cari kota berdasarkan 'province_code'
        $cities = City::where('province_code', $provinceCode)
            ->select('code', 'name')
            ->get();

        // 7. Kembalikan sebagai JSON
        return response()->json($cities);
    }
}