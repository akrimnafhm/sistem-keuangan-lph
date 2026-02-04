<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Berita Acara Rekapitulasi Biaya Audit</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Times New Roman', serif;
            font-size: 11px;
            color: #000;
            line-height: 1.5;
            padding: 15px;
        }
        .kop-surat {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .kop-surat h1 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 2px;
        }
        .kop-surat p {
            font-size: 10px;
            margin: 1px 0;
        }
        .title {
            text-align: center;
            margin: 20px 0;
        }
        .title h2 {
            font-size: 14px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 5px;
        }
        .title p {
            font-size: 11px;
        }
        .pembukaan {
            text-align: justify;
            margin-bottom: 20px;
            line-height: 1.6;
        }
        .section {
            margin-bottom: 15px;
        }
        .section-title {
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 5px;
            border-bottom: 1px solid #000;
            padding-bottom: 3px;
        }
        .info-table {
            width: 100%;
            margin-bottom: 10px;
        }
        .info-table td {
            padding: 3px 5px;
            vertical-align: top;
        }
        .info-table td:first-child {
            width: 150px;
            font-weight: bold;
        }
        .info-table td:nth-child(2) {
            width: 20px;
            text-align: center;
        }
        .subsection {
            margin-left: 0;
            margin-bottom: 10px;
        }
        .subsection-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .line-item {
            display: flex;
            justify-content: space-between;
            padding: 2px 0;
            margin-left: 20px;
        }
        .line-item span:first-child {
            flex: 1;
        }
        .line-item span:last-child {
            width: 150px;
            text-align: right;
        }
        .subtotal {
            border-top: 1px solid #000;
            margin: 5px 0 5px 20px;
            padding-top: 5px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
        }
        .subtotal span:last-child {
            width: 150px;
            text-align: right;
        }
        .total-box {
            border: 2px solid #000;
            padding: 10px;
            margin: 15px 0;
            background: #f9f9f9;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 3px 0;
            font-size: 11px;
        }
        .total-row.grand {
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            margin-top: 5px;
            padding-top: 8px;
            font-weight: bold;
            font-size: 12px;
        }
        table.auditor-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        table.auditor-table th,
        table.auditor-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        table.auditor-table th {
            background: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        table.auditor-table td:first-child {
            text-align: center;
            width: 40px;
        }
        table.auditor-table td:nth-child(3),
        table.auditor-table td:nth-child(4),
        table.auditor-table td:nth-child(5) {
            text-align: right;
        }
        table.auditor-table tfoot td {
            font-weight: bold;
            background: #f0f0f0;
        }
        .catatan {
            margin: 20px 0;
            font-size: 10px;
            text-align: justify;
        }
        .signature {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            width: 45%;
            text-align: center;
        }
        .signature-box p:first-child {
            margin-bottom: 60px;
        }
        .separator {
            border-top: 1px solid #000;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    {{-- KOP SURAT --}}
    <div class="kop-surat">
        <h1>LEMBAGA PEMERIKSA HALAL (LPH)</h1>
        <p>UIN Sunan Kalijaga Yogyakarta</p>
        <p>Jl. Marsda Adisucipto, Yogyakarta 55281</p>
        <p>Telp: (0274) 512840 | Email: lph@uin-suka.ac.id</p>
    </div>

    {{-- TITLE --}}
    <div class="title">
        <h2>BERITA ACARA REKAPITULASI BIAYA AUDIT</h2>
        <p>Nomor: {{ $rekap->no_rekap ?? 'RK-' . date('Ymd') . '-' . str_pad($rekap->id, 4, '0', STR_PAD_LEFT) }}</p>
    </div>

    {{-- PEMBUKAAN --}}
    <div class="pembukaan">
        Berdasarkan Surat Tanda Terima Dokumen (STTD) nomor <strong>{{ $rekap->pelakuUsaha->no_sttd }}</strong>, 
        dengan ini kami sampaikan rincian alokasi biaya pemeriksaan halal sebagai berikut:
    </div>

    {{-- SECTION I: IDENTITAS --}}
    <div class="section">
        <div class="section-title">I. IDENTITAS PELAKU USAHA</div>
        <table class="info-table">
            <tr>
                <td>Nama Usaha</td>
                <td>:</td>
                <td>{{ $rekap->pelakuUsaha->nama_usaha }}</td>
            </tr>
            <tr>
                <td>Lokasi Audit</td>
                <td>:</td>
                <td>{{ $rekap->pelakuUsaha->city->name ?? '-' }}, {{ $rekap->pelakuUsaha->city->province->name ?? '-' }} ({{ ucfirst(str_replace('_', ' ', $rekap->wilayah)) }})</td>
            </tr>
            <tr>
                <td>Nilai Kontrak</td>
                <td>:</td>
                <td><strong>Rp {{ number_format($rekap->total_kontrak, 0, ',', '.') }}</strong></td>
            </tr>
        </table>
    </div>

    {{-- SECTION II: RINCIAN PENGELUARAN --}}
    <div class="section">
        <div class="section-title">II. RINCIAN PENGELUARAN & ALOKASI DANA</div>

        {{-- A. KEWAJIBAN & BIAYA TETAP --}}
        <div class="subsection">
            <div class="subsection-title">A. KEWAJIBAN & BIAYA TETAP (INSTITUSIONAL)</div>
            <div class="line-item">
                <span>1. Setoran BPJPH</span>
                <span>Rp {{ number_format($rekap->potongan_bpjph, 0, ',', '.') }}</span>
            </div>
            <div class="line-item">
                <span>2. Hak LPH (Operasional Kantor)</span>
                <span>Rp {{ number_format($rekap->biaya_admin_lph, 0, ',', '.') }}</span>
            </div>
            <div class="line-item">
                <span>3. Setoran UIN / Lembaga</span>
                <span>Rp {{ number_format($rekap->potongan_uin, 0, ',', '.') }}</span>
            </div>
            <div class="subtotal">
                <span>Subtotal Kewajiban</span>
                <span>Rp {{ number_format($rekap->potongan_bpjph + $rekap->biaya_admin_lph + $rekap->potongan_uin, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- B. BIAYA OPERASIONAL --}}
        <div class="subsection">
            <div class="subsection-title">B. BIAYA OPERASIONAL AUDITOR (AT COST/REIMBURSEMENT)</div>
            @php
                $totalMandays = $rekap->details->sum('jumlah_mandays');
            @endphp
            <div class="line-item">
                <span>1. Uang Harian (UHPD) - {{ $totalMandays }} Mandays</span>
                <span>Rp {{ number_format($rekap->details->sum('total_uhpd'), 0, ',', '.') }}</span>
            </div>
            <div class="line-item">
                <span>2. Transportasi Lokal</span>
                <span>Rp {{ number_format($rekap->details->sum('biaya_transport'), 0, ',', '.') }}</span>
            </div>
            <div class="line-item">
                <span>3. Akomodasi (Hotel)</span>
                <span>Rp {{ number_format($rekap->details->sum('biaya_hotel'), 0, ',', '.') }}</span>
            </div>
            <div class="line-item">
                <span>4. Tiket Pesawat</span>
                <span>Rp {{ number_format($rekap->details->sum('biaya_pesawat'), 0, ',', '.') }}</span>
            </div>
            <div class="subtotal">
                <span>Subtotal Operasional</span>
                <span>Rp {{ number_format($rekap->total_biaya_ops, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- C. HONORARIUM AUDITOR --}}
        <div class="subsection">
            <div class="subsection-title">C. HONORARIUM AUDITOR (JASA PROFESI)</div>
            <div class="line-item">
                <span>1. Total Alokasi Honor</span>
                <span>Rp {{ number_format($rekap->unit_cost_auditor, 0, ',', '.') }}</span>
            </div>
            <div class="line-item">
                <span>2. Potongan Pajak ({{ number_format($rekap->pajak, 2) }}%)</span>
                <span>Rp {{ number_format($rekap->unit_cost_auditor * $rekap->pajak / 100, 0, ',', '.') }} (Dikurang)</span>
            </div>
            <div class="subtotal">
                <span>Total Honor Bersih (Net)</span>
                <span>Rp {{ number_format($rekap->unit_cost_auditor - ($rekap->unit_cost_auditor * $rekap->pajak / 100), 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    {{-- SECTION III: REKAPITULASI AKHIR --}}
    <div class="section">
        <div class="section-title">III. REKAPITULASI AKHIR</div>
        <div class="total-box">
            <div class="total-row">
                <span>(+) Pemasukan dari PU</span>
                <span>Rp {{ number_format($rekap->total_kontrak, 0, ',', '.') }}</span>
            </div>
            <div class="total-row">
                <span>(-) Total Pengeluaran (A+B+C)</span>
                <span>Rp {{ number_format(
                    ($rekap->potongan_bpjph + $rekap->biaya_admin_lph + $rekap->potongan_uin) + 
                    $rekap->total_biaya_ops + 
                    ($rekap->unit_cost_auditor - ($rekap->unit_cost_auditor * $rekap->pajak / 100))
                , 0, ',', '.') }}</span>
            </div>
            <div class="total-row grand">
                <span>SISA MARGIN LPH</span>
                <span>Rp {{ number_format($rekap->sisa_margin, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    {{-- SECTION IV: RINCIAN PER AUDITOR --}}
    <div class="section">
        <div class="section-title">IV. RINCIAN TRANSFER PENERIMA (TAKE HOME PAY)</div>
        <p style="margin-bottom: 10px;">Berikut adalah rincian dana yang akan ditransfer ke masing-masing auditor:</p>
        
        <table class="auditor-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA AUDITOR</th>
                    <th>HONOR NET</th>
                    <th>OPERASIONAL</th>
                    <th>TOTAL TRANSFER</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $jumlahAuditor = $rekap->details->count();
                    $honorNetPerAuditor = ($rekap->unit_cost_auditor - ($rekap->unit_cost_auditor * $rekap->pajak / 100)) / $jumlahAuditor;
                    $totalHonorNet = 0;
                    $totalOperasional = 0;
                    $grandTotal = 0;
                @endphp
                @foreach($rekap->details as $index => $detail)
                    @php
                        $opsPerAuditor = $detail->total_uhpd + $detail->biaya_transport + $detail->biaya_hotel + $detail->biaya_pesawat;
                        $totalTransfer = $honorNetPerAuditor + $opsPerAuditor;
                        $totalHonorNet += $honorNetPerAuditor;
                        $totalOperasional += $opsPerAuditor;
                        $grandTotal += $totalTransfer;
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $detail->auditor->nama }}</td>
                        <td>Rp {{ number_format($honorNetPerAuditor, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($opsPerAuditor, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($totalTransfer, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">TOTAL</td>
                    <td>Rp {{ number_format($totalHonorNet, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($totalOperasional, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    {{-- CATATAN --}}
    <div class="catatan">
        <strong>CATATAN:</strong><br>
        Demikian rekapitulasi ini dibuat dengan sebenarnya. Pembayaran akan diproses 
        melalui transfer bank ke rekening yang terdaftar.
    </div>

    {{-- SIGNATURE --}}
    <div class="signature">
        <div class="signature-box">
            <p>Yogyakarta, {{ now()->locale('id')->translatedFormat('d F Y') }}</p>
            <p>Dibuat Oleh,</p>
            <p style="margin-top: 60px;">( .................... )</p>
            <p>Admin Keuangan</p>
        </div>
        <div class="signature-box">
            <p>&nbsp;</p>
            <p>Menyetujui,</p>
            <p style="margin-top: 60px;">( .................... )</p>
            <p>Kepala LPH</p>
        </div>
    </div>

</body>
</html>
