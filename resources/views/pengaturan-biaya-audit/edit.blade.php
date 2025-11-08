<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Edit Biaya Audit Provinsi ') }} <span class="text-gray-800 dark:text-gray-700">{{ $wilayah->nama_provinsi }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('pengaturan-biaya-audit.update', $wilayah->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Biaya Dalam Kota (Rp)</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label for="transport_dalam_kota" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Transportasi</label>
                                <input type="number" name="transport_dalam_kota" id="transport_dalam_kota" value="{{ old('transport_dalam_kota', $wilayah->transport_dalam_kota) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                <x-input-error :messages="$errors->get('transport_dalam_kota')" class="mt-2" />
                            </div>
                            <div>
                                <label for="uhpd_dalam_kota" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Uang Harian (UHPD)</label>
                                <input type="number" name="uhpd_dalam_kota" id="uhpd_dalam_kota" value="{{ old('uhpd_dalam_kota', $wilayah->uhpd_dalam_kota) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                <x-input-error :messages="$errors->get('uhpd_dalam_kota')" class="mt-2" />
                            </div>
                        </div>

                        <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Biaya Luar Kota (Rp)</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="hotel_luar_kota" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Akomodasi / Hotel</label>
                                <input type="number" name="hotel_luar_kota" id="hotel_luar_kota" value="{{ old('hotel_luar_kota', $wilayah->hotel_luar_kota) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                <x-input-error :messages="$errors->get('hotel_luar_kota')" class="mt-2" />
                            </div>
                            <div>
                                <label for="transport_luar_kota" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Transportasi</label>
                                <input type="number" name="transport_luar_kota" id="transport_luar_kota" value="{{ old('transport_luar_kota', $wilayah->transport_luar_kota) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                <x-input-error :messages="$errors->get('transport_luar_kota')" class="mt-2" />
                            </div>
                            <div>
                                <label for="tiket_pesawat_luar_kota" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tiket Pesawat (PP)</label>
                                <input type="number" name="tiket_pesawat_luar_kota" id="tiket_pesawat_luar_kota" value="{{ old('tiket_pesawat_luar_kota', $wilayah->tiket_pesawat_luar_kota) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                <x-input-error :messages="$errors->get('tiket_pesawat_luar_kota')" class="mt-2" />
                            </div>
                             <div>
                                <label for="uhpd_luar_kota" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Uang Harian (UHPD)</label>
                                <input type="number" name="uhpd_luar_kota" id="uhpd_luar_kota" value="{{ old('uhpd_luar_kota', $wilayah->uhpd_luar_kota) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                <x-input-error :messages="$errors->get('uhpd_luar_kota')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="flex items-center justify-end mt-6 border-t dark:border-gray-700 pt-6">
                            <a href="{{ route('pengaturan-biaya-audit.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline mr-4">
                                Batal
                            </a>
                            <x-primary-button>
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>