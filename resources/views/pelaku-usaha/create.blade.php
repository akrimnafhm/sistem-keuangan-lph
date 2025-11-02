<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Pelaku Usaha Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('pelaku-usaha.store') }}" method="POST">
                        @csrf

                        <!-- No. STTD -->
                        <div class="mb-4">
                            <label for="no_sttd" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No. STTD</label>
                            <input type="text" name="no_sttd" id="no_sttd" value="{{ old('no_sttd') }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required autofocus>
                            <x-input-error :messages="$errors->get('no_sttd')" class="mt-2" />
                        </div>

                        <!-- Nama Usaha -->
                        <div class="mb-4">
                            <label for="nama_usaha" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Usaha</label>
                            <input type="text" name="nama_usaha" id="nama_usaha" value="{{ old('nama_usaha') }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                            <x-input-error :messages="$errors->get('nama_usaha')" class="mt-2" />
                        </div>

                        <!-- Alamat Lengkap -->
                        <div class="mb-4">
                            <label for="alamat_lengkap" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" id="alamat_lengkap" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>{{ old('alamat_lengkap') }}</textarea>
                            <x-input-error :messages="$errors->get('alamat_lengkap')" class="mt-2" />
                        </div>
                        
                        <!-- Daerah (Wilayah) - Dropdown -->
                        <div class="mb-4">
                            <label for="wilayah_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Daerah (Provinsi)</label>
                            <select name="wilayah_id" id="wilayah_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach($wilayahs as $wilayah)
                                    <option value="{{ $wilayah->id }}" @selected(old('wilayah_id') == $wilayah->id)>
                                        {{ $wilayah->nama_provinsi }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('wilayah_id')" class="mt-2" />
                        </div>

                        <!-- Skala Usaha - Dropdown -->
                        <div class="mb-4">
                            <label for="skala_usaha" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Skala Usaha</label>
                            <select name="skala_usaha" id="skala_usaha" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Skala Usaha --</option>
                                @foreach($skalaUsahaOptions as $option)
                                    <option value="{{ $option }}" @selected(old('skala_usaha') == $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('skala_usaha')" class="mt-2" />
                        </div>

                        <!-- Jenis Produk - Dropdown -->
                        <div class="mb-4">
                            <label for="jenis_produk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Produk</label>
                            <select name="jenis_produk" id="jenis_produk" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Jenis Produk --</option>
                                @foreach($jenisProdukOptions as $option)
                                    <option value="{{ $option }}" @selected(old('jenis_produk') == $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('jenis_produk')" class="mt-2" />
                        </div>

                        <!-- Jumlah Produk -->
                        <div class="mb-4">
                            <label for="jumlah_produk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Produk</label>
                            <input type="number" name="jumlah_produk" id="jumlah_produk" value="{{ old('jumlah_produk') }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                            <x-input-error :messages="$errors->get('jumlah_produk')" class="mt-2" />
                        </div>

                        <!-- Biaya -->
                        <div class="mb-4">
                            <label for="biaya" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Biaya</label>
                            <input type="number" name="biaya" id="biaya" step="0.01" value="{{ old('biaya') }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                            <x-input-error :messages="$errors->get('biaya')" class="mt-2" />
                        </div>

                        <!-- Jumlah Audit -->
                        <div class="mb-4">
                            <label for="jumlah_audit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Audit</label>
                            <input type="number" name="jumlah_audit" id="jumlah_audit" value="{{ old('jumlah_audit') }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                            <x-input-error :messages="$errors->get('jumlah_audit')" class="mt-2" />
                        </div>

                        <!-- Tombol Simpan -->
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
</x-app-layout>
