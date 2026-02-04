<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Rekapitulasi Biaya Audit') }}
        </h2>
    </x-slot>

    <div class="p-6 border rounded-lg dark:border-gray-300 bg-[#E8E8E8] shadow-lg">

        <form method="POST" action="{{ route('rekapitulasi.store') }}">
            @csrf

            <input type="hidden" name="pelaku_usaha_id" value="{{ $pelakuUsaha->id }}">
            <input type="hidden" name="total_kontrak" value="{{ $pelakuUsaha->nilai_kontrak }}">

            {{-- LOGIC WARNA BADGE SKALA USAHA --}}
            @php
                $badgeClass = match ($pelakuUsaha->skala_usaha) {
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
                            <p class="text-sm font-semibold text-gray-700">{{ $pelakuUsaha->nama_usaha }}</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase">No. STTD</label>
                            <p class="text-sm font-semibold text-gray-700">{{ $pelakuUsaha->no_sttd }}</p>
                        </div>

                        {{-- SKALA USAHA (Badge Style) --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Skala Usaha</label>
                            <span class="inline-block px-3 py-1 text-xs font-bold rounded-full {{ $badgeClass }}">
                                {{ ucfirst($pelakuUsaha->skala_usaha) }}
                            </span>
                        </div>

                        {{-- LOKASI (Terpisah) --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase">Lokasi</label>
                            <p class="text-sm text-gray-600">
                                {{ $pelakuUsaha->city->name ?? '-' }}, {{ $pelakuUsaha->city->province->name ?? '-' }}
                            </p>
                        </div>

                        <div class="pt-2 border-t border-gray-200 mt-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase">Total Biaya</label>
                            <p class="text-lg font-bold text-indigo-600">
                                Rp {{ number_format($pelakuUsaha->biaya, 2, ',', '.') }}
                            </p>
                        </div>
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
                            <span class="font-semibold">Rp {{ number_format($tarif_bpjph ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-200 pb-2">
                            <span>LPH</span>
                            <span class="font-semibold">Rp {{ number_format($tarif_lph ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-200 pb-2">
                            <span>UIN</span>
                            <span class="font-semibold">Rp {{ number_format($tarif_uin ?? 0, 0, ',', '.') }}</span>
                        </div>

                        {{-- UNIT COST AUDITOR (Teks Biasa) --}}
                        <div class="flex justify-between border-b border-gray-200 pb-2">
                            <span>Unit Cost Auditor</span>
                            <span class="font-bold text-gray-800">{{ number_format($unit_cost, 0) }}%</span>
                        </div>

                        <div class="pt-3 border-t border-gray-300 space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Wilayah Audit</label>
                                <select name="wilayah" required
                                    class="block w-full px-3 py-2 border rounded-md shadow-sm border-gray-300 bg-[#F8F8F8] text-gray-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">-- Pilih Wilayah --</option>
                                    <option value="dalam_kota">Dalam Kota</option>
                                    <option value="luar_kota">Luar Kota</option>
                                </select>
                            </div>

                            <div class="pt-2">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="font-bold text-gray-700">UHPD Auditor</span>
                                    <span id="uhpd_text" class="font-bold text-indigo-600">
                                        Rp {{ number_format($province->uhpd_dalam_kota ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>
                                <input type="hidden" name="tarif_uhpd" id="uhpd_input"
                                    value="{{ $province->uhpd_dalam_kota ?? 0 }}">
                            </div>

                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="font-bold text-gray-700">Transport</span>
                                    <span id="transport_text" class="font-bold text-indigo-600">
                                        Rp {{ number_format($province->transport_dalam_kota ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>
                                <input type="hidden" name="biaya_transport" id="transport_input"
                                    value="{{ $province->transport_dalam_kota ?? 0 }}">
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
                            class="block w-full px-3 py-2 border rounded-md shadow-sm border-gray-300 bg-[#F8F8F8] text-gray-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="bg-white p-3 rounded-lg border border-gray-200">
                        <div class="flex items-center justify-between mb-2">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="hotel_check"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm font-bold text-gray-700">Biaya Hotel</span>
                            </label>
                            <span class="text-xs text-gray-400">Max:
                                {{ number_format($province->hotel_luar_kota ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <input type="number" name="biaya_hotel" id="hotel_input"
                            max="{{ $province->hotel_luar_kota ?? 0 }}" disabled
                            class="block w-full px-3 py-2 border rounded-md shadow-sm border-gray-300 bg-[#F8F8F8] text-gray-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm disabled:bg-gray-100 disabled:text-gray-400"
                            placeholder="0">
                    </div>

                    <div class="bg-white p-3 rounded-lg border border-gray-200">
                        <div class="flex items-center justify-between mb-2">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="pesawat_check"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm font-bold text-gray-700">Tiket Pesawat</span>
                            </label>
                            <span class="text-xs text-gray-400">Max:
                                {{ number_format($province->tiket_pesawat_luar_kota ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <input type="number" name="biaya_pesawat" id="pesawat_input"
                            max="{{ $province->tiket_pesawat_luar_kota ?? 0 }}" disabled
                            class="block w-full px-3 py-2 border rounded-md shadow-sm border-gray-300 bg-[#F8F8F8] text-gray-700 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm disabled:bg-gray-100 disabled:text-gray-400"
                            placeholder="0">
                    </div>
                </div>

            </div>

            {{-- TOMBOL AKSI --}}
            <div class="flex items-center justify-end space-x-3 mt-8 pt-4 border-t border-gray-300">
                {{-- Tombol Batal --}}
                <a href="{{ route('rekapitulasi.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition ease-in-out duration-150">
                    {{ __('Batal') }}
                </a>

                <button type="submit" name="submit_action" value="draft"
                    class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition ease-in-out duration-150">
                    {{ __('Simpan Draft') }}
                </button>

                <button type="submit" name="submit_action" value="final"
                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:bg-green-700 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                    {{ __('Simpan Final') }}
                </button>
            </div>

        </form>
    </div>

    <script>
        const wilayahSelect = document.querySelector('select[name="wilayah"]');
        const uhpdText = document.getElementById('uhpd_text');
        const transportText = document.getElementById('transport_text');
        const uhpdInput = document.getElementById('uhpd_input');
        const transportInput = document.getElementById('transport_input');
        const hotelInput = document.getElementById('hotel_input');
        const pesawatInput = document.getElementById('pesawat_input');

        const biaya = {
            dalam: {
                uhpd: {{ $province->uhpd_dalam_kota ?? 0 }},
                transport: {{ $province->transport_dalam_kota ?? 0 }},
            },
            luar: {
                uhpd: {{ $province->uhpd_luar_kota ?? 0 }},
                transport: {{ $province->transport_luar_kota ?? 0 }},
                hotel: {{ $province->hotel_luar_kota ?? 0 }},
                pesawat: {{ $province->tiket_pesawat_luar_kota ?? 0 }},
            }
        };

        wilayahSelect.addEventListener('change', function () {
            const tipe = this.value === 'luar_kota' ? 'luar' : 'dalam';

            uhpdText.innerText = 'Rp ' + biaya[tipe].uhpd.toLocaleString('id-ID');
            transportText.innerText = 'Rp ' + biaya[tipe].transport.toLocaleString('id-ID');

            uhpdInput.value = biaya[tipe].uhpd;
            transportInput.value = biaya[tipe].transport;

            if (tipe === 'luar') {
                hotelInput.max = biaya.luar.hotel;
                pesawatInput.max = biaya.luar.pesawat;

                hotelInput.disabled = !document.getElementById('hotel_check').checked;
                pesawatInput.disabled = !document.getElementById('pesawat_check').checked;
            } else {
                hotelInput.value = '';
                pesawatInput.value = '';
                hotelInput.disabled = true;
                pesawatInput.disabled = true;
                document.getElementById('hotel_check').checked = false;
                document.getElementById('pesawat_check').checked = false;
            }
        });

        document.getElementById('hotel_check').onchange = e => {
            if (wilayahSelect.value === 'luar_kota') {
                hotelInput.disabled = !e.target.checked;
            } else {
                e.target.checked = false;
                alert('Biaya hotel hanya tersedia untuk Audit Luar Kota');
            }
        };

        document.getElementById('pesawat_check').onchange = e => {
            if (wilayahSelect.value === 'luar_kota') {
                pesawatInput.disabled = !e.target.checked;
            } else {
                e.target.checked = false;
                alert('Biaya pesawat hanya tersedia untuk Audit Luar Kota');
            }
        };
    </script>
</x-app-layout>