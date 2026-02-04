<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\PelakuUsaha;
use App\Models\Auditor;
use App\Models\RekapitulasiBiaya;
use App\Models\RekapitulasiAuditor;
use App\Models\KonfigurasiBiaya;

class RekapitulasiBiayaController extends Controller
{
    /**
     * ===============================
     * INDEX
     * ===============================
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $pelaku_usahas = PelakuUsaha::with('rekapitulasi')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_usaha', 'like', "%{$search}%")
                        ->orWhere('no_sttd', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(5);

        return view('rekapitulasi.index', compact('pelaku_usahas'));
    }

    /**
     * ===============================
     * CREATE
     * ===============================
     */
    public function create(Request $request)
    {
        $pelakuUsahaId = $request->query('pelaku_usaha_id');

        if (!$pelakuUsahaId) {
            return redirect()->route('rekapitulasi.index')
                ->with('error', 'Pelaku usaha tidak ditemukan');
        }

        $pelakuUsaha = PelakuUsaha::with([
            'city.province',
            'auditors'
        ])->findOrFail($pelakuUsahaId);

        // Cegah double rekap
        if ($pelakuUsaha->rekapitulasi) {
            return redirect()
                ->route('rekapitulasi.edit', $pelakuUsaha->rekapitulasi->id);
        }

        /**
         * ===============================
         * FEE & PAJAK (BERDASARKAN SKALA)
         * ===============================
         */
        $skala = $pelakuUsaha->skala_usaha;

        $getFee = fn($komponen) =>
            KonfigurasiBiaya::where('komponen', $komponen)
                ->value($skala) ?? 0;

        $tarif_bpjph = $getFee('Fee BPJPH');
        $tarif_lph = $getFee('Fee LPH');
        $tarif_uin = $getFee('Fee UIN');
        $unit_cost = $getFee('Unit Cost');
        $pajak = $getFee('Pajak');

        /**
         * ===============================
         * BIAYA WILAYAH (PROVINSI)
         * ===============================
         */
        $province = $pelakuUsaha->city?->province;

        if (!$province) {
            return back()->withErrors('Provinsi pelaku usaha tidak ditemukan.');
        }

        return view('rekapitulasi.create', compact(
            'pelakuUsaha',
            'tarif_bpjph',
            'tarif_lph',
            'tarif_uin',
            'unit_cost',
            'pajak',
            'province'
        ));
    }

    /**
     * ===============================
     * STORE
     * ===============================
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $pelakuUsaha = PelakuUsaha::with('auditors')
                ->findOrFail($request->pelaku_usaha_id);

            // =========================
            // STATUS (DARI BUTTON)
            // =========================
            $action = $request->input('submit_action', $request->input('action'));

            // Validasi: FINAL wajib ada auditor
            if ($action === 'final' && $pelakuUsaha->auditors->isEmpty()) {
                throw new \Exception('Auditor tidak ditemukan. Tambahkan auditor terlebih dahulu sebelum menyimpan final.');
            }

            $status = ($action === 'final') ? 'Final' : 'Draft';

            // =========================
            // BIAYA DARI FORM
            // =========================
            $tarifUhpd = (float) ($request->tarif_uhpd ?? 0);
            $transport = (float) ($request->biaya_transport ?? 0);
            $hotel = (float) ($request->biaya_hotel ?? 0);
            $pesawat = (float) ($request->biaya_pesawat ?? 0);
            $unitCostAuditor = (float) ($request->unit_cost_nominal ?? 0);

            // =========================
            // BIAYA TETAP
            // =========================
            $skala = $pelakuUsaha->skala_usaha;
            $getFee = fn($k) => KonfigurasiBiaya::where('komponen', $k)->value($skala) ?? 0;

            $bpjph = $getFee('Fee BPJPH');
            $uin = $getFee('Fee UIN');
            $lph = $getFee('Fee LPH');
            $pajak = $getFee('Pajak');

            // =========================
            // SIMPAN REKAP BIAYA
            // =========================
            $rekap = RekapitulasiBiaya::create([
                'pelaku_usaha_id' => $pelakuUsaha->id,
                'status' => $status,
                'wilayah' => $request->wilayah,
                'total_kontrak' => $pelakuUsaha->biaya,
                'unit_cost_auditor' => $unitCostAuditor,
                'potongan_bpjph' => $bpjph,
                'potongan_uin' => $uin,
                'biaya_admin_lph' => $lph,
                'pajak' => $pajak,
            ]);

            // =========================
            // DETAIL AUDITOR (LOOP JIKA ADA)
            // =========================
            $totalOps = 0;
            $totalMandays = (int) ($pelakuUsaha->mandays ?? 1);
            $auditorCount = $pelakuUsaha->auditors->count();
            
            // ATURAN BARU:
            // - UHPD: Total UHPD dibagi rata ke semua auditor
            // - Transport: Setiap auditor dapat 1x transport
            // - Pesawat: Setiap auditor dapat 1x pesawat
            // - Hotel: 1 nilai hotel untuk SEMUA auditor (bukan per auditor)
            
            $totalUhpdKeseluruhan = $tarifUhpd * $totalMandays;
            $uhpdPerAuditor = $auditorCount > 0 ? $totalUhpdKeseluruhan / $auditorCount : $totalUhpdKeseluruhan;
            $mandaysPerAuditor = $auditorCount > 0 ? $totalMandays / $auditorCount : $totalMandays;

            foreach ($pelakuUsaha->auditors as $index => $auditor) {
                $totalTransportPerAuditor = $transport;  // 1x per auditor
                $totalPesawatPerAuditor = $pesawat;      // 1x per auditor
                
                // Hotel: Hanya auditor pertama yang mencatat total hotel untuk semua
                // Auditor lainnya = 0 (karena 1 nilai hotel untuk semua auditor)
                $totalHotelPerAuditor = ($index === 0) ? $hotel : 0;
                
                RekapitulasiAuditor::create([
                    'rekapitulasi_biaya_id' => $rekap->id,
                    'auditor_id' => $auditor->id,
                    'mandays' => $mandaysPerAuditor,
                    'tarif_uhpd' => $tarifUhpd,
                    'total_uhpd' => $uhpdPerAuditor,
                    'biaya_transport' => $totalTransportPerAuditor,
                    'biaya_hotel' => $totalHotelPerAuditor,
                    'biaya_pesawat' => $totalPesawatPerAuditor,
                ]);

                $totalOps += $uhpdPerAuditor + $totalTransportPerAuditor + $totalHotelPerAuditor + $totalPesawatPerAuditor;
            }

            // =========================
            // UPDATE HASIL HITUNG
            // =========================
            // Step 1: Kontrak - Potongan Tetap (BPJPH, LPH, UIN)
            $setelahPotonganTetap = $rekap->total_kontrak - ($bpjph + $uin + $lph);

            // Step 2: Kurangi Total Biaya Operasional (Akomodasi)
            $setelahAkomodasi = $setelahPotonganTetap - $totalOps;

            // Step 3: Kurangi Unit Cost yang diberikan ke auditor (nilai total, bukan per auditor)
            $totalUnitCost = $unitCostAuditor;
            $setelahUnitCost = $setelahAkomodasi - $totalUnitCost;

            // Step 4: Pembagian sisa margin berdasarkan % Unit Cost dari DB
            $unitCostPersen = $getFee('Unit Cost');
            $bagianAuditor = $setelahUnitCost * ($unitCostPersen / 100);
            $pendapatanLph = $setelahUnitCost - $bagianAuditor;

            $rekap->update([
                'no_rekap' => $rekap->no_rekap ?? $this->generateNoRekap($rekap),
                'total_biaya_ops' => $totalOps,
                'sisa_margin' => $setelahUnitCost,
                'pendapatan_lph' => $pendapatanLph,
            ]);

            DB::commit();

            return redirect()->route('rekapitulasi.index')
                ->with('success', "Rekapitulasi berhasil disimpan sebagai {$status}");

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }
    }




    /**
     * ===============================
     * EDIT
     * ===============================
     */
    public function edit($id)
    {
        $rekap = RekapitulasiBiaya::with([
            'pelakuUsaha.city.province',
            'auditors.auditor'
        ])->findOrFail($id);

        // Ambil konfigurasi biaya untuk perhitungan real-time di frontend
        $skala = $rekap->pelakuUsaha->skala_usaha;
        $getFee = fn($komponen) => KonfigurasiBiaya::where('komponen', $komponen)->value($skala) ?? 0;
        
        $unit_cost_persen = $getFee('Unit Cost');
        $pajak_persen = $getFee('Pajak');

        return view('rekapitulasi.edit', compact('rekap', 'unit_cost_persen', 'pajak_persen'));
    }

    /**
     * ===============================
     * UPDATE
     * ===============================
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $rekap = RekapitulasiBiaya::with('pelakuUsaha.auditors')
                ->findOrFail($id);

            // Cegah update jika sudah Final
            if ($rekap->status === 'Final') {
                throw new \Exception('Rekapitulasi sudah Final dan tidak dapat diedit.');
            }

            $pelakuUsaha = $rekap->pelakuUsaha;
            $auditors = $pelakuUsaha->auditors;

            // =========================
            // BIAYA TETAP (DB)
            // =========================
            $skala = $pelakuUsaha->skala_usaha;

            $getFee = fn($komponen) =>
                KonfigurasiBiaya::where('komponen', $komponen)
                    ->value($skala) ?? 0;

            $bpjph = $getFee('Fee BPJPH');
            $lph = $getFee('Fee LPH');
            $uin = $getFee('Fee UIN');
            $pajak = $getFee('Pajak');

            // =========================
            // BIAYA DARI FORM
            // =========================
            $tarifUhpd = (float) ($request->tarif_uhpd ?? 0);
            $transport = (float) ($request->biaya_transport ?? 0);
            $hotel = (float) ($request->biaya_hotel ?? 0);
            $pesawat = (float) ($request->biaya_pesawat ?? 0);

            $unitCostAuditor = (float) ($request->unit_cost_nominal ?? 0);

            // =========================
            // STATUS (DARI BUTTON)
            // =========================
            $action = $request->input('submit_action', $request->input('action'));

            if ($action === 'final') {
                // Untuk simpan FINAL, wajib ada auditor
                if ($auditors->count() === 0) {
                    throw new \Exception('Auditor tidak ditemukan. Tambahkan auditor terlebih dahulu sebelum menyimpan final.');
                }
                $status = 'Final';
            } else {
                // Simpan DRAFT boleh tanpa auditor
                $status = 'Draft';
            }

            // =========================
            // UPDATE REKAP BIAYA
            // =========================
            $rekap->update([
                'wilayah' => $request->wilayah,
                'unit_cost_auditor' => $unitCostAuditor,
                'potongan_bpjph' => $bpjph,
                'potongan_uin' => $uin,
                'biaya_admin_lph' => $lph,
                'pajak' => $pajak,
                'status' => $status,
            ]);

            // =========================
            // UPDATE DETAIL AUDITOR
            // =========================
            // Hapus detail lama
            RekapitulasiAuditor::where('rekapitulasi_biaya_id', $rekap->id)->delete();

            $totalUhpdGlobal = 0;
            $totalTransport = 0;
            $totalHotel = 0;
            $totalPesawat = 0;
            
            $totalMandays = (int) ($pelakuUsaha->mandays ?? 1);
            $auditorCount = $auditors->count();
            
            // ATURAN BARU:
            // - UHPD: Total UHPD dibagi rata ke semua auditor
            // - Transport: Setiap auditor dapat 1x transport
            // - Pesawat: Setiap auditor dapat 1x pesawat
            // - Hotel: 1 nilai hotel untuk SEMUA auditor (bukan per auditor)
            
            $totalUhpdKeseluruhan = $tarifUhpd * $totalMandays;
            $uhpdPerAuditor = $auditorCount > 0 ? $totalUhpdKeseluruhan / $auditorCount : $totalUhpdKeseluruhan;
            $mandaysPerAuditor = $auditorCount > 0 ? $totalMandays / $auditorCount : $totalMandays;

            foreach ($auditors as $index => $auditor) {
                $totalTransportPerAuditor = $transport;  // 1x per auditor
                $totalPesawatPerAuditor = $pesawat;      // 1x per auditor
                
                // Hotel: Hanya auditor pertama yang mencatat total hotel untuk semua
                // Auditor lainnya = 0 (karena 1 nilai hotel untuk semua auditor)
                $totalHotelPerAuditor = ($index === 0) ? $hotel : 0;
                
                RekapitulasiAuditor::create([
                    'rekapitulasi_biaya_id' => $rekap->id,
                    'auditor_id' => $auditor->id,
                    'mandays' => $mandaysPerAuditor,
                    'tarif_uhpd' => $tarifUhpd,
                    'total_uhpd' => $uhpdPerAuditor,
                    'biaya_transport' => $totalTransportPerAuditor,
                    'biaya_hotel' => $totalHotelPerAuditor,
                    'biaya_pesawat' => $totalPesawatPerAuditor,
                ]);

                $totalUhpdGlobal += $uhpdPerAuditor;
                $totalTransport += $totalTransportPerAuditor;
                $totalHotel += $totalHotelPerAuditor;
                $totalPesawat += $totalPesawatPerAuditor;
            }

            // =========================
            // HITUNG TOTAL BIAYA OPS
            // =========================
            $totalBiayaOps =
                $totalUhpdGlobal +
                $totalTransport +
                $totalHotel +
                $totalPesawat;

            // Step 1: Kontrak - Potongan Tetap (BPJPH, LPH, UIN)
            $setelahPotonganTetap = $rekap->total_kontrak - ($bpjph + $uin + $lph);

            // Step 2: Kurangi Total Biaya Operasional (Akomodasi)
            $setelahAkomodasi = $setelahPotonganTetap - $totalBiayaOps;

            // Step 3: Kurangi Unit Cost yang diberikan ke auditor (nilai total, bukan per auditor)
            $totalUnitCost = $unitCostAuditor;
            $setelahUnitCost = $setelahAkomodasi - $totalUnitCost;

            // Step 4: Pembagian sisa margin berdasarkan % Unit Cost dari DB
            $unitCostPersen = $getFee('Unit Cost');
            $bagianAuditor = $setelahUnitCost * ($unitCostPersen / 100);
            $pendapatanLph = $setelahUnitCost - $bagianAuditor;

            $rekap->update([
                'no_rekap' => $rekap->no_rekap ?? $this->generateNoRekap($rekap),
                'total_biaya_ops' => $totalBiayaOps,
                'sisa_margin' => $setelahUnitCost,
                'pendapatan_lph' => $pendapatanLph,
            ]);

            DB::commit();

            return redirect()
                ->route('rekapitulasi.index')
                ->with('success', 'Rekapitulasi berhasil diupdate');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }
    }

    private function generateNoRekap(RekapitulasiBiaya $rekap): string
    {
        $id = $rekap->getKey(); // safer than direct property access

        return 'RK-' . now()->format('Ymd') . '-' . str_pad((string) $id, 4, '0', STR_PAD_LEFT);
    }

    /**
     * ===============================
     * SHOW
     * ===============================
     */
    public function show($id)
    {
        $rekap = RekapitulasiBiaya::with([
            'pelakuUsaha.city.province',
            'auditors.auditor',
            'details.auditor'
        ])->findOrFail($id);

        // Ambil Unit Cost % berdasarkan skala usaha
        $skala = $rekap->pelakuUsaha->skala_usaha;
        $getFee = fn($komponen) => KonfigurasiBiaya::where('komponen', $komponen)->value($skala) ?? 0;
        $unit_cost_persen = $getFee('Unit Cost');

        return view('rekapitulasi.show', compact('rekap', 'unit_cost_persen'));
    }

    /**
     * ===============================
     * DOWNLOAD PDF
     * ===============================
     */
    public function downloadPdf($id)
    {
        $rekap = RekapitulasiBiaya::with([
            'pelakuUsaha.city.province',
            'details.auditor'
        ])->findOrFail($id);

        // Validasi: hanya bisa download jika status Final
        if ($rekap->status !== 'Final') {
            return back()->withErrors('Laporan hanya bisa diunduh setelah status menjadi Final');
        }

        // Ambil Unit Cost % berdasarkan skala usaha untuk PDF
        $skala = $rekap->pelakuUsaha->skala_usaha;
        $getFee = fn($komponen) => KonfigurasiBiaya::where('komponen', $komponen)->value($skala) ?? 0;
        $unit_cost_persen = $getFee('Unit Cost');

        $pdf = Pdf::loadView('rekapitulasi.pdf', compact('rekap', 'unit_cost_persen'));
        
        return $pdf->download('Laporan-Rekap-' . $rekap->no_rekap . '.pdf');
    }
}
