<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Edit Data Pelaku Usaha') }}
        </h2>
    </x-slot>

    <div class="p-6 border rounded-lg dark:border-gray-300 bg-gray-50 shadow-lg">
        
        <form action="{{ route('pelaku-usaha.update', $pelakuUsaha->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="space-y-4 border-b lg:border-b-0 lg:border-r border-gray-300 pb-4 lg:pb-0 lg:pr-6">
                    <h3 class="text-md font-bold text-gray-600 border-b border-gray-300 pb-2 mb-3">
                        Identitas & Lokasi
                    </h3>

                    <div class="bg-slate-50 dark:bg-gray-300 p-4 rounded-xl space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-500 uppercase">No. STTD</label>
                            <input type="text" name="no_sttd" value="{{ $pelakuUsaha->no_sttd }}" 
                                class="mt-1 block w-full bg-transparent border-none p-0 text-slate-700 dark:text-gray-700 font-bold focus:ring-0 text-sm cursor-default" readonly>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-500 uppercase">Nama Usaha</label>
                            <input type="text" name="nama_usaha" value="{{ $pelakuUsaha->nama_usaha }}" 
                                class="mt-1 block w-full bg-transparent border-none p-0 text-slate-700 dark:text-gray-700 font-bold focus:ring-0 text-sm cursor-default" readonly>
                        </div>
                    </div>

                    <div>
                        <label for="alamat_lengkap" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" id="alamat_lengkap" rows="2" 
                            class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400">{{ old('alamat_lengkap', $pelakuUsaha->alamat_lengkap) }}</textarea>
                        <x-input-error :messages="$errors->get('alamat_lengkap')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="province_id" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Provinsi</label>
                            <select name="province_id" id="province-dropdown" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400">
                                <option value="">-- Pilih --</option>
                                @foreach($provinces as $id => $name)
                                    <option value="{{ $id }}" @selected(old('province_id', $pelakuUsaha->city->province->id ?? '') == $id)>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="city_id" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Kota/Kab</label>
                            <select name="city_id" id="city-dropdown" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400">
                                <option value="">-- Pilih --</option>
                                @foreach($cities as $code => $name)
                                    <option value="{{ $code }}" @selected(old('city_id', $pelakuUsaha->city_id) == $code)>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="space-y-4 border-b lg:border-b-0 lg:border-r border-gray-300 pb-4 lg:pb-0 lg:pr-6">
                    <h3 class="text-md font-bold text-gray-600 border-b border-gray-300 pb-2 mb-3">
                        Detail Produk & Biaya
                    </h3>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="skala_usaha" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Skala</label>
                            <select name="skala_usaha" id="skala_usaha" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400">
                                @foreach($skalaUsahaOptions as $option)
                                    <option value="{{ $option }}" @selected(old('skala_usaha', $pelakuUsaha->skala_usaha) == $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="jenis_produk" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Jenis</label>
                            <select name="jenis_produk" id="jenis_produk" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400">
                                @foreach($jenisProdukOptions as $option)
                                    <option value="{{ $option }}" @selected(old('jenis_produk', $pelakuUsaha->jenis_produk) == $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="jumlah_produk" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Jumlah Produk</label>
                        <input type="number" name="jumlah_produk" id="jumlah_produk" value="{{ old('jumlah_produk', $pelakuUsaha->jumlah_produk) }}" 
                            class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400">
                    </div>

                    <div>
                        <label for="biaya" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Biaya (Rp)</label>
                        <input type="number" name="biaya" id="biaya" step="0.01" value="{{ old('biaya', $pelakuUsaha->biaya) }}" 
                            class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400">
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-md font-bold text-gray-600 border-b border-gray-300 pb-2 mb-3">
                        Pengaturan Audit
                    </h3>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="jumlah_audit_input" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Jml Auditor</label>
                            <input type="number" name="jumlah_audit" id="jumlah_audit_input" min="2" max="{{ $maxAuditors }}" 
                                value="{{ old('jumlah_audit', $pelakuUsaha->jumlah_audit) }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400">
                            <p class="text-[10px] text-gray-400 mt-1">Min: 2 | Maks: {{ $maxAuditors }}</p>
                        </div>
                        <div>
                            <label for="mandays" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Mandays</label>
                            <input type="number" name="mandays" id="mandays" value="{{ old('mandays', $pelakuUsaha->mandays) }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400">
                        </div>
                    </div>
                    
                    <div class="bg-gray-200 p-3 rounded-lg border border-gray-300">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Penugasan Auditor</label>
                        <div id="auditor_wrapper" class="space-y-2 max-h-[150px] overflow-y-auto pr-1">
                            {{-- JS akan mengisi ini --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-2 mt-8 pt-4 border-t border-gray-300">
                <a href="{{ route('pelaku-usaha.show', $pelakuUsaha->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition ease-in-out duration-150">
                    {{ __('Batal') }}
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:bg-green-700 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Simpan') }}
                </button>
            </div>
        </form>
    </div>

    {{-- Script Bagian Kota/Provinsi --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const provinceDropdown = document.getElementById('province-dropdown');
            const cityDropdown = document.getElementById('city-dropdown');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const oldCityId = '{{ old('city_id') }}';

            provinceDropdown.addEventListener('change', async function () {
                const provinceId = this.value;
                cityDropdown.innerHTML = '<option value="">Loading...</option>';
                cityDropdown.disabled = true;
                if (provinceId) {
                    try {
                        const response = await fetch(`{{ route('get.cities') }}?province_id=${provinceId}`, {
                            headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': csrfToken }
                        });
                        if (!response.ok) throw new Error('Network response was not ok');
                        const cities = await response.json();
                        cityDropdown.innerHTML = '<option value="">-- Pilih --</option>';
                        cities.forEach(function (city) {
                            const option = document.createElement('option');
                            option.value = city.code;
                            option.textContent = city.name;
                            if (oldCityId == city.code) option.selected = true;
                            cityDropdown.appendChild(option);
                        });
                        cityDropdown.disabled = false;
                    } catch (error) {
                        cityDropdown.innerHTML = '<option value="">Error</option>';
                    }
                } else {
                    cityDropdown.innerHTML = '<option value="">-- Pilih Prov --</option>';
                    cityDropdown.disabled = true;
                }
            });
            const hasOldInput = '{{ old('province_id') }}' !== '';
            if (hasOldInput && provinceDropdown.value) {
                provinceDropdown.dispatchEvent(new Event('change'));
            }
        });
    </script>

    {{-- Script Bagian Auditor Dinamis --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jumlahInput = document.getElementById('jumlah_audit_input');
            const wrapper = document.getElementById('auditor_wrapper');
            const auditors = @json($auditors);
            const selectedAuditors = @json($pelakuUsaha->auditors->pluck('id'));

            function generateDropdowns(count) {
                wrapper.innerHTML = '';
                if (count > {{ $maxAuditors }}) count = {{ $maxAuditors }};
                
                if(count == 0) {
                     wrapper.innerHTML = '<p class="text-xs text-gray-500 italic text-center py-2">Belum ada jumlah audit.</p>';
                     return;
                }

                for (let i = 0; i < count; i++) {
                    const div = document.createElement('div');
                    div.className = 'flex items-center space-x-2';
                    
                    const label = document.createElement('span');
                    label.className = 'text-xs font-medium text-gray-600 w-6';
                    label.innerText = `#${i + 1}`;

                    const select = document.createElement('select');
                    select.name = 'auditor_ids[]';
                    // Style disamakan dengan input lain: bg-[#F8F8F8]
                    select.className = 'block w-full py-1.5 px-3 border border-gray-300 rounded-md text-sm bg-white text-gray-600 focus:ring-gray-400';
                    select.required = true;
                    select.dataset.index = i; // Tambah index identifier

                    const defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.text = '- Pilih -';
                    select.appendChild(defaultOption);

                    for (const [id, name] of Object.entries(auditors)) {
                        const option = document.createElement('option');
                        option.value = id;
                        option.text = name;
                        if (selectedAuditors[i] && selectedAuditors[i] == id) {
                            option.selected = true;
                        }
                        select.appendChild(option);
                    }

                    // Event listener untuk perubahan pilihan auditor
                    select.addEventListener('change', updateAuditorOptions);

                    div.appendChild(label);
                    div.appendChild(select);
                    wrapper.appendChild(div);
                }

                // Update opsi setelah semua dropdown dibuat
                updateAuditorOptions();
            }

            // Fungsi untuk update dan filter opsi auditor berdasarkan pilihan yang sudah ada
            function updateAuditorOptions() {
                const allSelects = wrapper.querySelectorAll('select[name="auditor_ids[]"]');
                const selectedAuditors = new Set();

                // Kumpulkan semua auditor yang sudah dipilih
                allSelects.forEach(select => {
                    if (select.value) {
                        selectedAuditors.add(select.value);
                    }
                });

                // Update setiap dropdown
                allSelects.forEach((select, index) => {
                    const currentValue = select.value;
                    const options = select.querySelectorAll('option');

                    options.forEach(option => {
                        // Jangan disable opsi kosong
                        if (option.value === '') {
                            option.disabled = false;
                            return;
                        }

                        // Disable jika auditor sudah dipilih di dropdown lain
                        // Tapi jangan disable opsi yang sedang dipilih di dropdown ini
                        if (selectedAuditors.has(option.value) && option.value !== currentValue) {
                            option.disabled = true;
                            option.style.display = 'none';
                        } else {
                            option.disabled = false;
                            option.style.display = 'block';
                        }
                    });
                });
            }

            jumlahInput.addEventListener('input', function () {
                generateDropdowns(parseInt(this.value) || 0);
            });

            if (jumlahInput.value) {
                generateDropdowns(parseInt(jumlahInput.value));
            } else {
                generateDropdowns(0);
            }
        });
    </script>
</x-app-layout>