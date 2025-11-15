<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Edit Data Pelaku Usaha') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 border rounded-lg dark:border-gray-300 bg-[#E8E8E8]">
                <div class="text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('pelaku-usaha.update', $pelakuUsaha->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="no_sttd" class="block text-sm font-medium text-gray-500 dark:text-gray-700">No. STTD</label>
                            <input type="text" name="no_sttd" id="no_sttd" value="{{ $pelakuUsaha->no_sttd }}" 
                                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-400 bg-[#E8E8E8] text-gray-500 dark:text-gray-700 cursor-not-allowed" 
                                readonly>
                        </div>
                        <div class="mb-4">
                            <label for="nama_usaha" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Nama Usaha</label>
                            <input type="text" name="nama_usaha" id="nama_usaha" value="{{ $pelakuUsaha->nama_usaha }}" 
                                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-400 bg-[#E8E8E8] text-gray-500 dark:text-gray-700 cursor-not-allowed" 
                                readonly>
                        </div>

                        <div class="mb-4">
                            <label for="alamat_lengkap" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" id="alamat_lengkap" rows="3" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required>{{ old('alamat_lengkap', $pelakuUsaha->alamat_lengkap) }}</textarea>
                            <x-input-error :messages="$errors->get('alamat_lengkap')" class="mt-2" />
                        </div>
                        
                        <div class="mb-4">
                            <label for="province_id" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Provinsi</label>
                            <select name="province_id" id="province-dropdown" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required>
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach($provinces as $id => $name)
                                    <option value="{{ $id }}" @selected(old('province_id', $pelakuUsaha->city->province_id) == $id)>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="city_id" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Kota / Kabupaten</label>
                            <select name="city_id" id="city-dropdown" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required>
                                <option value="">-- Pilih Kota / Kabupaten --</option>
                                @foreach($cities as $id => $name)
                                    <option value="{{ $id }}" @selected(old('city_id', $pelakuUsaha->city_id) == $id)>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('city_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="skala_usaha" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Skala Usaha</label>
                            <select name="skala_usaha" id="skala_usaha" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required>
                                @foreach($skalaUsahaOptions as $option)
                                    <option value="{{ $option }}" @selected(old('skala_usaha', $pelakuUsaha->skala_usaha) == $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="jenis_produk" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Jenis Produk</label>
                            <select name="jenis_produk" id="jenis_produk" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required>
                                @foreach($jenisProdukOptions as $option)
                                    <option value="{{ $option }}" @selected(old('jenis_produk', $pelakuUsaha->jenis_produk) == $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="jumlah_produk" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Jumlah Produk</label>
                            <input type="number" name="jumlah_produk" id="jumlah_produk" value="{{ old('jumlah_produk', $pelakuUsaha->jumlah_produk) }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required>
                        </div>
                        <div class="mb-4">
                            <label for="biaya" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Biaya</label>
                            <input type="number" name="biaya" id="biaya" step="0.01" value="{{ old('biaya', $pelakuUsaha->biaya) }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required>
                        </div>
                        <div class="mb-4">
                            <label for="jumlah_audit" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Jumlah Audit</label>
                            <input type="number" name="jumlah_audit" id="jumlah_audit" value="{{ old('jumlah_audit', $pelakuUsaha->jumlah_audit) }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            const provinceDropdown = document.getElementById('province-dropdown');
            const cityDropdown = document.getElementById('city-dropdown');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Simpan nilai 'old' (jika ada dari error validasi)
            const oldCityId = '{{ old('city_id') }}';

            provinceDropdown.addEventListener('change', async function () {
                const provinceId = this.value; 
                
                cityDropdown.innerHTML = '<option value="">-- Loading... --</option>';
                cityDropdown.disabled = true;

                if (provinceId) {
                    try {
                        const response = await fetch(`{{ route('get.cities') }}?province_id=${provinceId}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': csrfToken 
                            }
                        });
                        
                        if (!response.ok) {
                             throw new Error('Network response was not ok');
                        }

                        const cities = await response.json();

                        cityDropdown.innerHTML = '<option value="">-- Pilih Kota / Kabupaten --</option>';
                        
                        cities.forEach(function (city) {
                            const option = document.createElement('option');
                            option.value = city.code;
                            option.textContent = city.name;
                            
                            // Cek apakah city.id ini adalah yang dipilih sebelumnya (saat validasi gagal)
                            if (oldCityId == city.code) {
                                option.selected = true;
                            }
                            
                            cityDropdown.appendChild(option);
                        });

                        cityDropdown.disabled = false;

                    } catch (error) {
                        console.error('Error fetching cities:', error);
                        cityDropdown.innerHTML = '<option value="">-- Gagal memuat data --</option>';
                    }
                } else {
                    cityDropdown.innerHTML = '<option value="">-- Pilih Provinsi Terlebih Dahulu --</option>';
                    cityDropdown.disabled = true;
                }
            });
            
            // Jika ada error validasi dan province_id lama ada, picu 'change'
            // agar dropdown kota terisi kembali.
            if(provinceDropdown.value) {
                provinceDropdown.dispatchEvent(new Event('change'));
            }
        });
    </script>
</x-app-layout>