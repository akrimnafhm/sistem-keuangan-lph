<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Laporan Rekapitulasi Biaya Audit') }}
        </h2>
    </x-slot>

    @php
        $potonganTetap = ($rekap->potongan_bpjph ?? 0) + ($rekap->potongan_uin ?? 0) + ($rekap->biaya_admin_lph ?? 0);
    @endphp

    {{-- Container utama --}}
    <div class="p-6 border rounded-lg dark:border-gray-300 bg-gray-50 shadow-lg">

        {{-- HEADER INFO --}}
        <div class="mb-6 bg-white p-4 rounded-lg border border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase">No. Rekap</label>
                    <p class="text-lg font-bold text-gray-800">{{ $rekap->no_rekap ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase">Nama Usaha</label>
                    <p class="text-lg font-bold text-gray-800">{{ $rekap->pelakuUsaha->nama_usaha }}</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase">No. STTD</label>
                    <p class="text-lg font-bold text-gray-800">{{ $rekap->pelakuUsaha->no_sttd }}</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase">Status</label>
                    <p class="inline-block px-3 py-1 rounded-full text-sm font-bold text-white bg-blue-600">
                        {{ $rekap->status }}
                    </p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase">Skala Usaha</label>
                    <p class="text-sm font-bold text-gray-800">{{ ucfirst($rekap->pelakuUsaha->skala_usaha) }}</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase">Lokasi</label>
                    <p class="text-sm font-bold text-gray-800">{{ $rekap->pelakuUsaha->city->name ?? '-' }}, {{ $rekap->pelakuUsaha->city->province->name ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase">Wilayah Audit</label>
                    <p class="text-sm font-bold text-gray-800">{{ ucfirst(str_replace('_', ' ', $rekap->wilayah)) }}</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase">Total Biaya Kontrak</label>
                    <p class="text-sm font-bold text-indigo-600">Rp {{ number_format($rekap->total_kontrak, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>

        {{-- GRID 3 KOLOM --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ================= KOLOM 1: KOMPONEN BIAYA (POTONGAN TETAP) ================= --}}
            <div class="space-y-4 border-b lg:border-b-0 lg:border-r border-gray-300 pb-4 lg:pb-0 lg:pr-6">
                <h3 class="text-md font-bold text-gray-600 border-b border-gray-300 pb-2 mb-3">
                    Komponen Biaya
                </h3>

                <div class="bg-white p-4 rounded-lg space-y-2 border border-gray-200">
                    <p class="text-xs font-bold text-gray-600 uppercase">Potongan Tetap</p>
                    
                    <div class="flex justify-between text-sm text-gray-700">
                        <span>BPJPH</span>
                        <span class="font-semibold">Rp {{ number_format($rekap->potongan_bpjph, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between text-sm text-gray-700">
                        <span>LPH</span>
                        <span class="font-semibold">Rp {{ number_format($rekap->biaya_admin_lph, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between text-sm text-gray-700">
                        <span>UIN</span>
                        <span class="font-semibold">Rp {{ number_format($rekap->potongan_uin, 0, ',', '.') }}</span>
                    </div>

                    <div class="border-t pt-2 flex justify-between font-semibold text-gray-800">
                        <span>Total Potongan</span>
                        <span>Rp {{ number_format($rekap->potongan_bpjph + $rekap->biaya_admin_lph + $rekap->potongan_uin, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg space-y-2 border border-gray-200">
                    <p class="text-xs font-bold text-gray-600 uppercase">Biaya Operasional</p>
                    
                    <div class="flex justify-between text-sm text-gray-700">
                        <span>UHPD Auditor</span>
                        <span class="font-semibold">Rp {{ number_format($rekap->details->sum('total_uhpd'), 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Transport</span>
                        <span class="font-semibold">Rp {{ number_format($rekap->details->sum('biaya_transport'), 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Hotel</span>
                        <span class="font-semibold">Rp {{ number_format($rekap->details->sum('biaya_hotel'), 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Pesawat</span>
                        <span class="font-semibold">Rp {{ number_format($rekap->details->sum('biaya_pesawat'), 0, ',', '.') }}</span>
                    </div>

                    <div class="border-t pt-2 flex justify-between font-semibold text-gray-800">
                        <span>Total Operasional</span>
                        <span>Rp {{ number_format($rekap->total_biaya_ops, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- ================= KOLOM 2: HONORARIUM AUDITOR ================= --}}
            <div class="space-y-4 border-b lg:border-b-0 lg:border-r border-gray-300 pb-4 lg:pb-0 lg:pr-6">
                <h3 class="text-md font-bold text-gray-600 border-b border-gray-300 pb-2 mb-3">
                    Honorarium Auditor
                </h3>

                <div class="bg-slate-50 p-4 rounded-lg space-y-3 border border-gray-200">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase">Auditor Bertugas</label>
                        @php($auditorNames = $rekap->details->pluck('auditor.nama')->filter()->implode(', '))
                        <p class="text-sm font-semibold text-gray-700">{{ $auditorNames ?: '-' }}</p>
                    </div>
                </div>

                <div class="bg-blue-50 p-4 rounded-lg space-y-2 border border-blue-200">
                    <p class="text-xs font-bold text-blue-700 uppercase">Unit Cost</p>
                    
                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Unit Cost Auditor</span>
                        <span class="font-semibold">Rp {{ number_format($rekap->unit_cost_auditor, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="bg-purple-50 p-4 rounded-lg space-y-2 border border-purple-200">
                    <p class="text-xs font-bold text-purple-700 uppercase">Pajak</p>
                    
                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Pajak Berlaku</span>
                        <span class="font-semibold">{{ number_format($rekap->pajak, 0, ',', '.') }}%</span>
                    </div>

                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Unit Cost</span>
                        <span class="font-semibold">Rp {{ number_format($rekap->unit_cost_auditor, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Pajak atas Unit Cost</span>
                        <span class="font-semibold text-red-600">-Rp {{ number_format($rekap->unit_cost_auditor * $rekap->pajak / 100, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between text-sm font-semibold border-t pt-2">
                        <span>Unit Cost Setelah Pajak</span>
                        <span>Rp {{ number_format($rekap->unit_cost_auditor - ($rekap->unit_cost_auditor * $rekap->pajak / 100), 0, ',', '.') }}</span>
                    </div>
                </div>

            </div>

            {{-- ================= KOLOM 3: RINGKASAN PERHITUNGAN & SISA MARGIN ================= --}}
            <div class="space-y-4">
                <h3 class="text-md font-bold text-gray-600 border-b border-gray-300 pb-2 mb-3">
                    Ringkasan Perhitungan
                </h3>

                <div class="bg-gray-50 p-4 rounded-lg space-y-2 border border-gray-200">
                    <p class="text-xs font-bold text-gray-600 uppercase">Ringkasan Pengurangan</p>

                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Nilai Kontrak</span>
                        <span class="font-semibold">Rp {{ number_format($rekap->total_kontrak, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Potongan Tetap</span>
                        <span class="font-semibold text-red-600">-Rp {{ number_format($potonganTetap, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Biaya Operasional</span>
                        <span class="font-semibold text-red-600">-Rp {{ number_format($rekap->total_biaya_ops, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between text-sm text-gray-700">
                        <span>Unit Cost (Total)</span>
                        <span class="font-semibold text-red-600">-Rp {{ number_format($rekap->unit_cost_auditor, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between text-sm font-semibold border-t pt-2">
                        <span>Sisa Setelah Unit Cost</span>
                        <span>Rp {{ number_format($rekap->sisa_margin, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="bg-green-50 p-4 rounded-lg space-y-3 border border-green-200">
                    <p class="text-xs font-bold text-green-700 uppercase">Sisa Margin</p>
                    
                    <div class="flex justify-between text-lg">
                        <span class="font-semibold text-gray-700">Total Sisa Margin</span>
                        <span class="font-bold text-green-700">Rp {{ number_format($rekap->sisa_margin, 0, ',', '.') }}</span>
                    </div>

                    <hr class="border-green-200">

                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Bagian Auditor ({{ number_format($unit_cost_persen, 0) }}%)</span>
                        <span class="font-semibold">Rp {{ number_format(($rekap->sisa_margin * $unit_cost_persen / 100), 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Bagian LPH</span>
                        <span class="font-semibold text-blue-700">Rp {{ number_format($rekap->sisa_margin - ($rekap->sisa_margin * $unit_cost_persen / 100), 0, ',', '.') }}</span>
                    </div>
                </div>

            </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-300">
            <a href="{{ route('rekapitulasi.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 rounded-md text-sm text-white font-semibold transition">
                Kembali
            </a>
            
            <a href="{{ route('rekapitulasi.pdf', $rekap->id) }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-md text-sm text-white font-semibold transition">
                Download PDF
            </a>
        </div>

    </div>
</x-app-layout>
