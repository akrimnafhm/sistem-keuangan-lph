<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Edit Rekapitulasi Biaya') }}
        </h2>
    </x-slot>

    <div class="p-6 border rounded-lg dark:border-gray-300 bg-[#E8E8E8] shadow-lg">

        <form method="POST" action="{{ route('rekapitulasi.update', $rekap->id) }}">
            @csrf
            @method('PUT')

            <input type="hidden" name="pelaku_usaha_id" value="{{ $rekap->pelaku_usaha_id }}">

            {{-- LOGIC WARNA BADGE SKALA USAHA --}}
            @php
                $badgeClass = match ($rekap->pelakuUsaha->skala_usaha) {
                    'Mikro' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                    'Kecil' => 'bg-green-100 text-green-800 border border-green-200',
                    'Menengah' => 'bg-blue-100 text-blue-800 border border-blue-200',
                    'Besar' => 'bg-purple-100 text-purple-800 border border-purple-200',
                    default => 'bg-gray-100 text-gray-800 border border-gray-200',
                };
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- KOLOM 1: PELAKU USAHA --}}
                <div class="space-y-4 border-b lg:border-b-0 lg:border-r border-gray-300 pb-4 lg:pb-0 lg:pr-6">
                    <h3 class="text-md font-bold text-gray-600 border-b border-gray-300 pb-2 mb-3">
                        Pelaku Usaha
                    </h3>

                    <div class="bg-slate-50 p-4 rounded-xl border border-gray-200 space-y-3">
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase">Nama Usaha</label>
                            <p class="text-sm font-semibold text-gray-700">{{ $rekap->pelakuUsaha->nama_usaha }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase">No. STTD</label>
                            <p class="text-sm font-semibold text-gray-700">{{ $rekap->pelakuUsaha->no_sttd }}</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase">No. Rekap</label>
                            <p class="text-sm font-semibold text-gray-700">{{ $rekap->no_rekap ?? '-' }}</p>
                        </div>

                        {{-- SKALA USAHA (Badge Style) --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Skala Usaha</label>
                            <span class="inline-block px-3 py-1 text-xs font-bold rounded-full {{ $badgeClass }}">
                                {{ ucfirst($rekap->pelakuUsaha->skala_usaha) }}
                            </span>
                        </div>

                        {{-- LOKASI (Terpisah) --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase">Lokasi</label>
                            <p class="text-sm text-gray-600">
                                {{ $rekap->pelakuUsaha->city->name ?? '-' }},
                                {{ $rekap->pelakuUsaha->city->province->name ?? '-' }}
                            </p>
                        </div>

                        <div class="pt-2 border-t border-gray-200 mt-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase">Total Kontrak</label>
                            <p class="text-lg font-bold text-indigo-600">
                                Rp {{ number_format($rekap->total_kontrak, 2, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between bg-white p-3 rounded-lg border border-gray-200">
                        <span class="text-sm font-bold text-gray-500">Status Dokumen</span>
                        <span class="px-3 py-1 rounded-full text-xs font-bold text-white
                                    {{ $rekap->status === 'Final' ? 'bg-blue-600' : 'bg-gray-400' }}">
                            {{ $rekap->status }}
                        </span>
                    </div>
                </div>

                {{-- KOLOM 2: BIAYA DB (Read Only) --}}
                <div class="space-y-4 border-b lg:border-b-0 lg:border-r border-gray-300 pb-4 lg:pb-0 lg:pr-6">
                    <h3 class="text-md font-bold text-gray-600 border-b border-gray-300 pb-2 mb-3">
                        Rincian Biaya Tetap
                    </h3>

                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex justify-between border-b border-gray-200 pb-2">
                            <span>BPJPH</span>
                            <span class="font-semibold">Rp
                                {{ number_format($rekap->potongan_bpjph ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-200 pb-2">
                            <span>LPH</span>
                            <span class="font-semibold">Rp
                                {{ number_format($rekap->biaya_admin_lph ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-200 pb-2">
                            <span>UIN</span>
                            <span class="font-semibold">Rp
                                {{ number_format($rekap->potongan_uin ?? 0, 0, ',', '.') }}</span>
                        </div>

                        {{-- UNIT COST TAHAP 2 (Teks Biasa) --}}
                        <div class="flex justify-between border-b border-gray-200 pb-2">
                            <span>Unit Cost Auditor</span>
                            <span class="font-bold text-gray-800">{{ number_format($unit_cost_persen, 0) }}%</span>
                        </div>

                        <div class="pt-3 border-t border-gray-300 space-y-3">
                            <div class="border-b border-gray-200 pb-3">
                                <label class="block text-sm font-medium text-gray-600 mb-1">Wilayah Audit</label>
                                <select name="wilayah" required
                                    class="block w-full px-3 py-2 border rounded-md shadow-sm border-gray-300 bg-[#F8F8F8] text-gray-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">-- Pilih Wilayah --</option>
                                    <option value="dalam_kota" @selected($rekap->wilayah === 'dalam_kota')>Dalam Kota
                                    </option>
                                    <option value="luar_kota" @selected($rekap->wilayah === 'luar_kota')>Luar Kota
                                    </option>
                                </select>
                            </div>

                            <div class="pt-2">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="font-bold text-gray-700">UHPD Auditor</span>
                                    <span id="uhpd_text" class="font-bold text-indigo-600">
                                        Rp {{ number_format($rekap->details->first()?->tarif_uhpd ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>
                                <input type="hidden" name="tarif_uhpd" id="uhpd_input"
                                    value="{{ $rekap->details->first()?->tarif_uhpd ?? 0 }}">
                            </div>

                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="font-bold text-gray-700">Transport</span>
                                    <span id="transport_text" class="font-bold text-indigo-600">
                                        Rp
                                        {{ number_format($rekap->details->first()?->biaya_transport ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>
                                <input type="hidden" name="biaya_transport" id="transport_input"
                                    value="{{ $rekap->details->first()?->biaya_transport ?? 0 }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KOLOM 3: INPUT OPSIONAL --}}
                <div class="space-y-4">
                    <h3 class="text-md font-bold text-gray-600 border-b border-gray-300 pb-2 mb-3">
                        Biaya Tambahan
                    </h3>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Unit Cost (Rp)</label>
                        <input type="number" name="unit_cost_nominal"
                            class="block w-full px-3 py-2 border rounded-md shadow-sm border-gray-300 bg-[#F8F8F8] text-gray-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            value="{{ $rekap->unit_cost_auditor ?? 0 }}" placeholder="Nominal Kesepakatan">
                    </div>

                    <div class="bg-white p-3 rounded-lg border border-gray-200">
                        <div class="flex items-center justify-between mb-2">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="hotel_check"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    @if($rekap->details->first()?->biaya_hotel > 0) checked @endif>
                                <span class="ml-2 text-sm font-bold text-gray-700">Biaya Hotel</span>
                            </label>
                        </div>
                        <input type="number" name="biaya_hotel" id="hotel_input"
                            @if(!($rekap->details->first()?->biaya_hotel > 0)) disabled @endif
                            class="block w-full px-3 py-2 border rounded-md shadow-sm border-gray-300 bg-[#F8F8F8] text-gray-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm disabled:bg-gray-100 disabled:text-gray-400"
                            value="{{ $rekap->details->first()?->biaya_hotel ?? 0 }}">
                    </div>

                    <div class="bg-white p-3 rounded-lg border border-gray-200">
                        <div class="flex items-center justify-between mb-2">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="pesawat_check"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    @if($rekap->details->first()?->biaya_pesawat > 0) checked @endif>
                                <span class="ml-2 text-sm font-bold text-gray-700">Tiket Pesawat</span>
                            </label>
                        </div>
                        <input type="number" name="biaya_pesawat" id="pesawat_input"
                            @if(!($rekap->details->first()?->biaya_pesawat > 0)) disabled @endif
                            class="block w-full px-3 py-2 border rounded-md shadow-sm border-gray-300 bg-[#F8F8F8] text-gray-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm disabled:bg-gray-100 disabled:text-gray-400"
                            value="{{ $rekap->details->first()?->biaya_pesawat ?? 0 }}">
                    </div>

                    <div class="pt-3 border-t border-gray-300 space-y-3">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase">Total Biaya
                                Operasional</label>
                            <input type="text" readonly id="total_ops_display"
                                class="block w-full mt-1 bg-gray-200 border-none rounded text-sm font-bold text-gray-700 cursor-default"
                                value="Rp {{ number_format($rekap->total_biaya_ops, 2, ',', '.') }}">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase">Sisa Margin</label>
                            <input type="text" readonly id="sisa_margin_display"
                                class="block w-full mt-1 bg-gray-200 border-none rounded text-sm font-bold text-indigo-600 cursor-default"
                                value="Rp {{ number_format($rekap->sisa_margin, 2, ',', '.') }}">
                        </div>
                    </div>

                </div>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="flex items-center justify-end space-x-3 mt-8 pt-4 border-t border-gray-300">
                {{-- Tombol Batal --}}
                <a href="{{ route('rekapitulasi.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:outline-none transition ease-in-out duration-150">
                    {{ __('Batal') }}
                </a>

                @if($rekap->status === 'Draft')
                    <button type="submit" name="submit_action" value="draft"
                        class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none transition ease-in-out duration-150">
                        {{ __('Update Draft') }}
                    </button>

                    <button type="submit" name="submit_action" value="final"
                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none transition ease-in-out duration-150">
                        {{ __('Simpan Final') }}
                    </button>
                @else
                    <button type="button" disabled
                        class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest cursor-not-allowed">
                        {{ __('Sudah Final (Terkunci)') }}
                    </button>
                @endif
            </div>

        </form>
    </div>

    {{-- SCRIPT CALCULATOR (Sesuai logika database) --}}
    <script>
        // Ambil data dari server
        const totalKontrak = {{ $rekap->total_kontrak }};
        const bpjph = {{ $rekap->potongan_bpjph }};
        const uin = {{ $rekap->potongan_uin }};
        const lph = {{ $rekap->biaya_admin_lph }};
        const jumlahAuditor = {{ $rekap->details->count() }};
        const totalMandays = {{ $rekap->pelakuUsaha->mandays ?? 1 }};
        const unitCostPersen = {{ $unit_cost_persen }};
        const pajakPersen = {{ $pajak_persen }};

        // Input elements
        const hotelInput = document.getElementById('hotel_input');
        const pesawatInput = document.getElementById('pesawat_input');
        const unitCostInput = document.querySelector('input[name="unit_cost_nominal"]');
        const uhpdInput = document.getElementById('uhpd_input');
        const transportInput = document.getElementById('transport_input');

        // Display elements
        const totalOpsDisplay = document.getElementById('total_ops_display');
        const sisaMarginDisplay = document.getElementById('sisa_margin_display');

        function formatCurrency(value) {
            return 'Rp ' + parseFloat(value).toLocaleString('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
        }

        function calculateTotals() {
            // Baca nilai dari form
            const tariffUhpd = parseFloat(uhpdInput?.value || 0);
            const transport = parseFloat(transportInput?.value || 0);
            const hotel = hotelInput.disabled ? 0 : parseFloat(hotelInput.value || 0);
            const pesawat = pesawatInput.disabled ? 0 : parseFloat(pesawatInput.value || 0);
            const unitCost = parseFloat(unitCostInput?.value || 0);

            // Step 1: Total Kontrak - Potongan Tetap (BPJPH, LPH, UIN)
            const setelahPotonganTetap = totalKontrak - (bpjph + uin + lph);

            // Step 2: Hitung Total Operasional sesuai LOGIKA BARU
            // ATURAN BARU:
            // - UHPD: Total UHPD (tarif × total mandays) dibagi rata ke semua auditor
            // - Transport: Setiap auditor dapat 1x transport
            // - Pesawat: Setiap auditor dapat 1x pesawat
            // - Hotel: 1 nilai hotel untuk SEMUA auditor (bukan per auditor)
            
            const totalUhpdKeseluruhan = tariffUhpd * totalMandays;
            const uhpdPerAuditor = totalUhpdKeseluruhan / jumlahAuditor;
            
            // Total Operasional = (UHPD dibagi rata × jumlah auditor) + (Transport × jumlah) + (Pesawat × jumlah) + Hotel (1x untuk semua)
            const totalOps = (uhpdPerAuditor * jumlahAuditor) + 
                           (transport * jumlahAuditor) + 
                           (pesawat * jumlahAuditor) + 
                           hotel; // Hotel hanya 1 nilai untuk semua auditor

            const setelahAkomodasi = setelahPotonganTetap - totalOps;

            // Step 3: Kurangi Unit Cost
            const totalUnitCost = unitCost;
            const setelahUnitCost = setelahAkomodasi - totalUnitCost;

            // Update display
            totalOpsDisplay.value = formatCurrency(totalOps);
            sisaMarginDisplay.value = formatCurrency(setelahUnitCost);
        }

        // Event listeners
        if (hotelInput) {
            hotelInput.addEventListener('change', calculateTotals);
            hotelInput.addEventListener('input', calculateTotals);
        }

        if (pesawatInput) {
            pesawatInput.addEventListener('change', calculateTotals);
            pesawatInput.addEventListener('input', calculateTotals);
        }

        if (unitCostInput) {
            unitCostInput.addEventListener('change', calculateTotals);
            unitCostInput.addEventListener('input', calculateTotals);
        }

        const hotelCheck = document.getElementById('hotel_check');
        if (hotelCheck) {
            hotelCheck.addEventListener('change', (e) => {
                hotelInput.disabled = !e.target.checked;
                if (!e.target.checked) hotelInput.value = '';
                calculateTotals();
            });
        }

        const pesawatCheck = document.getElementById('pesawat_check');
        if (pesawatCheck) {
            pesawatCheck.addEventListener('change', (e) => {
                pesawatInput.disabled = !e.target.checked;
                if (!e.target.checked) pesawatInput.value = '';
                calculateTotals();
            });
        }

        // Initial calculate on page load
        window.addEventListener('load', calculateTotals);
    </script>
</x-app-layout>