<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data Pelaku Usaha') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('pelaku-usaha.update', $pelakuUsaha->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- No. STTD (Read-only) -->
                        <div class="mb-4">
                            <label for="no_sttd" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No. STTD</label>
                            <input type="text" name="no_sttd" id="no_sttd" value="{{ $pelakuUsaha->no_sttd }}" 
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-400 rounded-md shadow-sm cursor-not-allowed" 
                                   readonly>
                            <x-input-error :messages="$errors->get('no_sttd')" class="mt-2" />
                        </div>

                        <!-- Nama Usaha (Read-only) -->
                        <div class="mb-4">
                            <label for="nama_usaha" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Usaha</label>
                            <input type="text" name="nama_usaha" id="nama_usaha" value="{{ $pelakuUsaha->nama_usaha }}" 
                                   class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-400 rounded-md shadow-sm cursor-not-allowed" 
                                   readonly>
                            <x-input-error :messages="$errors->get('nama_usaha')" class="mt-2" />
                        </div>
                        
                        <!-- Alamat Lengkap -->
                        <div class="mb-4">
                            <label for="alamat_lengkap" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat Lengkap</label>
                            <textarea name="alamat_lengkap" id="alamat_lengkap" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>{{ old('alamat_lengkap', $pelakuUsaha->alamat_lengkap) }}</textarea>
                            <x-input-error :messages="$errors->get('alamat_lengkap')" class="mt-2" />
                        </div>

                        <!-- Daerah (Wilayah) -->
                        <div class="mb-4">
                            <label for="wilayah_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Daerah (Provinsi)</label>
                            <select name="wilayah_id" id="wilayah_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                @foreach($wilayahs as $wilayah)
                                    <option value="{{ $wilayah->id }}" @selected(old('wilayah_id', $pelakuUsaha->wilayah_id) == $wilayah->id)>
                                        {{ $wilayah->nama_provinsi }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('wilayah_id')" class="mt-2" />
                        </div>

                        <!-- Skala Usaha -->
                        <div class="mb-4">
                            <label for="skala_usaha" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Skala Usaha</label>
                            <select name="skala_usaha" id="skala_usaha" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                @foreach($skalaUsahaOptions as $option)
                                    <option value="{{ $option }}" @selected(old('skala_usaha', $pelakuUsaha->skala_usaha) == $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('skala_usaha')" class="mt-2" />
                        </div>
                        
                        <!-- Jenis Produk -->
                        <div class="mb-4">
                            <label for="jenis_produk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Produk</label>
                            <select name="jenis_produk" id="jenis_produk" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                @foreach($jenisProdukOptions as $option)
                                    <option value="{{ $option }}" @selected(old('jenis_produk', $pelakuUsaha->jenis_produk) == $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('jenis_produk')" class="mt-2" />
                        </div>

                        <!-- Jumlah Produk -->
                        <div class="mb-4">
                            <label for="jumlah_produk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Produk</label>
                            <input type="number" name="jumlah_produk" id="jumlah_produk" value="{{ old('jumlah_produk', $pelakuUsaha->jumlah_produk) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                            <x-input-error :messages="$errors->get('jumlah_produk')" class="mt-2" />
                        </div>

                        <!-- Biaya -->
                        <div class="mb-4">
                            <label for="biaya" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Biaya</label>
                            <input type="number" name="biaya" id="biaya" step="0.01" value="{{ old('biaya', $pelakuUsaha->biaya) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                            <x-input-error :messages="$errors->get('biaya')" class="mt-2" />
                        </div>

                        <!-- Jumlah Audit -->
                        <div class="mb-4">
                            <label for="jumlah_audit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Audit</label>
                            <input type="number" name="jumlah_audit" id="jumlah_audit" value="{{ old('jumlah_audit', $pelakuUsaha->jumlah_audit) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                            <x-input-error :messages="$errors->get('jumlah_audit')" class="mt-2" />
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

