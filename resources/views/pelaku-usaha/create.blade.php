<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Tambah Pelaku Usaha Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 border rounded-lg dark:border-gray-300 bg-[#E8E8E8]">

                    
                    <form action="{{ route('pelaku-usaha.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="no_sttd" class="block text-sm font-medium text-gray-500 dark:text-gray-700">No. STTD</label>
                            <input type="text" name="no_sttd" id="no_sttd" value="{{ old('no_sttd') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required autofocus>
                            <x-input-error :messages="$errors->get('no_sttd')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="nama_usaha" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Nama Usaha</label>
                            <input type="text" name="nama_usaha" id="nama_usaha" value="{{ old('nama_usaha') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required>
                            <x-input-error :messages="$errors->get('nama_usaha')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="alamat_lengkap" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" id="alamat_lengkap" rows="3" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required>{{ old('alamat_lengkap') }}</textarea>
                            <x-input-error :messages="$errors->get('alamat_lengkap')" class="mt-2" />
                        </div>
                        
                        <div class="mb-4">
                            <label for="province_id" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Provinsi</label>
                            {{-- Dropdown ini akan dikirim dari Controller ('provinces') --}}
                            <select name="province_id" id="province-dropdown" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required>
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach($provinces as $id => $name)
                                    <option value="{{ $id }}" {{ old('province_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            {{-- Kita tidak mengirim city_id, tapi province_id. city_id dikirim oleh form --}}
                            <x-input-error :messages="$errors->get('province_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="city_id" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Kota / Kabupaten</label>
                            {{-- Dropdown ini akan diisi oleh JavaScript --}}
                            <select name="city_id" id="city-dropdown" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required disabled>
                                <option value="">-- Pilih Provinsi Terlebih Dahulu --</option>
                            </select>
                            <x-input-error :messages="$errors->get('city_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="skala_usaha" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Skala Usaha</label>
                            <select name="skala_usaha" id="skala_usaha" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required>
                                <option value="">-- Pilih Skala Usaha --</option>
                                @foreach($skalaUsahaOptions as $option)
                                    <option value="{{ $option }}" @selected(old('skala_usaha') == $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('skala_usaha')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="jenis_produk" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Jenis Produk</label>
                            <select name="jenis_produk" id="jenis_produk" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required>
                                <option value="">-- Pilih Jenis Produk --</option>
                                @foreach($jenisProdukOptions as $option)
                                    <option value="{{ $option }}" @selected(old('jenis_produk') == $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('jenis_produk')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="jumlah_produk" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Jumlah Produk</label>
                            <input type="number" name="jumlah_produk" id="jumlah_produk" value="{{ old('jumlah_produk') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required>
                            <x-input-error :messages="$errors->get('jumlah_produk')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="biaya" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Biaya</label>
                            <input type="number" name="biaya" id="biaya" step="0.01" value="{{ old('biaya') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required>
                            <x-input-error :messages="$errors->get('biaya')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="jumlah_audit" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Jumlah Audit</label>
                            <input type="number" name="jumlah_audit" id="jumlah_audit" value="{{ old('jumlah_audit') }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required>
                            <x-input-error :messages="$errors->get('jumlah_audit')" class="mt-2" />
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Saat dokumen siap
        document.addEventListener('DOMContentLoaded', function () {
            
            const provinceDropdown = document.getElementById('province-dropdown');
            const cityDropdown = document.getElementById('city-dropdown');
            const csrfToken = '{{ csrf_token() }}'; // Ambil CSRF token dari Blade
            const oldCityId = '{{ old('city_id') }}'; // Ambil ID kota lama jika ada error validasi

            provinceDropdown.addEventListener('change', async function () {
                const provinceId = this.value; // Ambil ID provinsi yang dipilih
                
                // Kosongkan dropdown kota dan nonaktifkan
                cityDropdown.innerHTML = '<option value="">-- Loading... --</option>';
                cityDropdown.disabled = true;

                if (provinceId) {
                    try {
                        // Panggil route 'get.cities' yang kita buat di routes/web.php
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

                        // Kosongkan lagi sebelum diisi
                        cityDropdown.innerHTML = '<option value="">-- Pilih Kota / Kabupaten --</option>';
                        
                        // Isi dropdown kota dengan data baru
                        cities.forEach(function (city) {
                            const option = document.createElement('option');
                            option.value = city.code;
                            option.textContent = city.name;
                            
                            // Jika ada error validasi, pilih kembali kota yang lama
                            if (oldCityId == city.code) {
                                option.selected = true;
                            }
                            
                            cityDropdown.appendChild(option);
                        });

                        // Aktifkan dropdown kota
                        cityDropdown.disabled = false;

                    } catch (error) {
                        console.error('Error fetching cities:', error);
                        cityDropdown.innerHTML = '<option value="">-- Gagal memuat data --</option>';
                    }
                } else {
                    // Jika tidak ada provinsi dipilih
                    cityDropdown.innerHTML = '<option value="">-- Pilih Provinsi Terlebih Dahulu --</option>';
                    cityDropdown.disabled = true;
                }
            });
            
            // Jika halaman ini dimuat ulang karena error validasi,
            // dan provinsi sudah terpilih, picu event 'change'
            // untuk mengisi ulang dropdown kota.
            if(provinceDropdown.value) {
                provinceDropdown.dispatchEvent(new Event('change'));
            }
        });
    </script>
</x-app-layout>