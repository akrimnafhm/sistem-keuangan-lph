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
            padding: 2.54cm;
            margin: 0;
        }
        .kop-surat {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 5px;
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
            margin-bottom: 8px;
            padding-bottom: 0;
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
            margin-left: 20px;
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
                <td>{{ $rekap->pelakuUsaha->city->name ?? '-' }}, {{ $rekap->pelakuUsaha->city->province->name ?? '-' }} (Tarif {{ ucfirst(str_replace('_', ' ', $rekap->wilayah)) }})</td>
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
            <div class="subsection-title">A. BIAYA TETAP (INSTITUSIONAL)</div>
            <table class="auditor-table">
                <thead>
                    <tr>
                        <th style="text-align: center; width: 50px;">NO</th>
                        <th style="text-align: center;">URAIAN</th>
                        <th style="text-align: center; width: 150px;">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center;">1</td>
                        <td>BPJPH</td>
                        <td>Rp {{ number_format($rekap->potongan_bpjph, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">2</td>
                        <td>LPH</td>
                        <td>Rp {{ number_format($rekap->biaya_admin_lph, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">3</td>
                        <td>UIN</td>
                        <td>Rp {{ number_format($rekap->potongan_uin, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: right;"><strong>Subtotal Biaya Tetap</strong></td>
                        <td style="text-align: right;"><strong>Rp {{ number_format($rekap->potongan_bpjph + $rekap->biaya_admin_lph + $rekap->potongan_uin, 0, ',', '.') }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- B. BIAYA OPERASIONAL --}}
        <div class="subsection">
            <div class="subsection-title">B. BIAYA OPERASIONAL</div>
            @php
                $totalMandays = $rekap->details->sum('mandays');
                $jumlahAuditor = $rekap->details->count();
                // Hitung hari audit: jika semua auditor rata2 1.5 hari, berarti 2 hari audit (dibulatkan ke atas)
                $jumlahHariAudit = $jumlahAuditor > 0 ? (int) ceil($totalMandays / $jumlahAuditor) : 1;
                $jumlahMalam = max($jumlahHariAudit - 1, 0);
            @endphp
            <table class="auditor-table">
                <thead>
                    <tr>
                        <th style="text-align: center; width: 50px;">NO</th>
                        <th style="text-align: center;">URAIAN</th>
                        <th style="text-align: center; width: 150px;">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center;">1</td>
                        <td>UHPD (x{{ $totalMandays }} Mandays)</td>
                        <td>Rp {{ number_format($rekap->details->sum('total_uhpd'), 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">2</td>
                        <td>Transportasi (x{{ $jumlahAuditor }} Auditor)</td>
                        <td>Rp {{ number_format($rekap->details->sum('biaya_transport'), 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">3</td>
                        <td>Hotel (x{{ $jumlahMalam }} Malam)</td>
                        <td>Rp {{ number_format($rekap->details->sum('biaya_hotel'), 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">4</td>
                        <td>Tiket Pesawat (x{{ $jumlahAuditor }} Auditor)</td>
                        <td>Rp {{ number_format($rekap->details->sum('biaya_pesawat'), 0, ',', '.') }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: right;"><strong>Subtotal Operasional</strong></td>
                        <td style="text-align: right;"><strong>Rp {{ number_format($rekap->total_biaya_ops, 0, ',', '.') }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- C. HONORARIUM AUDITOR --}}
        <div class="subsection">
            <div class="subsection-title">C. UNIT COST (HONORARIUM AUDITOR)</div>
            <table class="auditor-table">
                <thead>
                    <tr>
                        <th style="text-align: center; width: 50px;">NO</th>
                        <th style="text-align: center;">URAIAN</th>
                        <th style="text-align: center; width: 150px;">JUMLAH</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center;">1</td>
                        <td>Unit Cost</td>
                        <td>Rp {{ number_format($rekap->unit_cost_auditor, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">2</td>
                        <td>Potongan Pajak ({{ number_format($rekap->pajak, 0) }}%)</td>
                        <td>Rp {{ number_format($rekap->unit_cost_auditor * $rekap->pajak / 100, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: right;"><strong>Total Honorarium Bersih</strong></td>
                        <td style="text-align: right;"><strong>Rp {{ number_format($rekap->unit_cost_auditor - ($rekap->unit_cost_auditor * $rekap->pajak / 100), 0, ',', '.') }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- SECTION III: REKAPITULASI AKHIR --}}
    <div class="section">
        <div class="section-title">III. REKAPITULASI AKHIR</div>
        <table class="auditor-table">
            <thead>
                <tr>
                    <th style="text-align: center;">KETERANGAN</th>
                    <th style="text-align: center; width: 10px;">JUMLAH</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: left;">Pemasukan dari Pelaku Usaha</td>
                    <td style="text-align: right;">Rp {{ number_format($rekap->total_kontrak, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td style="text-align: left;">Total Pengeluaran</td>
                    <td style="text-align: right;">Rp {{ number_format(
                        ($rekap->potongan_bpjph + $rekap->biaya_admin_lph + $rekap->potongan_uin) + 
                        $rekap->total_biaya_ops + $rekap->unit_cost_auditor
                    , 0, ',', '.') }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td style="text-align: right;"><strong>SISA MARGIN</strong></td>
                    <td style="text-align: right;"><strong>Rp {{ number_format($rekap->sisa_margin, 0, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>

    {{-- SECTION IV: RINCIAN PER AUDITOR --}}
    <div class="section">
        <div class="section-title">IV. RINCIAN DANA SETIAP AUDITOR</div>
        <p style="margin-bottom: 10px;">Berikut adalah rincian dana yang akan ditransfer ke masing-masing auditor:</p>
        
        <table class="auditor-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA AUDITOR</th>
                    <th>HONORARIUM</th>
                    <th>OPERASIONAL</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $jumlahAuditor = $rekap->details->count();
                    $honorNetPerAuditor = ($rekap->unit_cost_auditor - ($rekap->unit_cost_auditor * $rekap->pajak / 100)) / $jumlahAuditor;
                    
                    // Hitung total operasional untuk dibagi
                    $totalUHPD = $rekap->details->sum('total_uhpd');
                    $totalHotel = $rekap->details->sum('biaya_hotel');
                    
                    $totalHonorNet = 0;
                    $totalOperasional = 0;
                    $grandTotal = 0;
                @endphp
                @foreach($rekap->details as $index => $detail)
                    @php
                        // UHPD dan Hotel dibagi rata, Transport dan Pesawat penuh per auditor
                        $uhpdPerAuditor = $totalUHPD / $jumlahAuditor;
                        $hotelPerAuditor = $totalHotel / $jumlahAuditor;
                        $opsPerAuditor = $uhpdPerAuditor + $detail->biaya_transport + $hotelPerAuditor + $detail->biaya_pesawat;
                        
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
                    <td colspan="2" style="text-align: right">TOTAL</td>
                    <td style="text-align: right;">Rp {{ number_format($totalHonorNet, 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($totalOperasional, 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    {{-- CATATAN --}}
    <div class="catatan">
        Demikian rekapitulasi ini dibuat dengan sebenarnya.
    </div>

    {{-- SIGNATURE --}}
    <div class="signature">
        <div class="signature-box" style="margin-left: auto;">
            <p style="margin-bottom: 0;">Yogyakarta, {{ \Carbon\Carbon::parse($rekap->updated_at)->locale('id')->translatedFormat('d F Y') }}</p>
            <p>Menyetujui,</p>
            <p style="margin-top: 60px;">( .................... )</p>
            <p>Kepala LPH</p>
        </div>
    </div>

</body>
</html>
