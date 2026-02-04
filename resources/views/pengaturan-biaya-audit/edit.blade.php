<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Edit Standar Biaya Wilayah') }}
        </h2>
    </x-slot>
            
    <div class="p-6 border rounded-lg dark:border-gray-300 bg-gray-50 shadow-lg">

        <form action="{{ route('pengaturan-biaya-audit.update', $province->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6 border-b border-gray-300 pb-2">
                <h3 class="text-lg font-bold text-gray-700">
                    Provinsi: <span class="text-indigo-600">{{ str($province->name)->title() }}</span>
                </h3>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="space-y-4 border-b lg:border-b-0 lg:border-r border-gray-300 pb-4 lg:pb-0 lg:pr-6">
                    <h3 class="text-md font-bold text-gray-600 border-b border-gray-300 pb-2 mb-3">
                        UHPD
                    </h3>
                    <div>
                        <label for="uhpd_dalam_kota" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Dalam Kota</label>
                        <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm">Rp</span>
                            <input type="number" name="uhpd_dalam_kota" id="uhpd_dalam_kota"
                                value="{{ old('uhpd_dalam_kota', $province->uhpd_dalam_kota) }}"
                                class="block w-full pl-8 px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-700 focus:ring-gray-400"
                                required>
                        </div>
                        <x-input-error :messages="$errors->get('uhpd_dalam_kota')" class="mt-1" />
                    </div>
                    <div>
                        <label for="uhpd_luar_kota" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Luar Kota</label>
                        <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm">Rp</span>
                            <input type="number" name="uhpd_luar_kota" id="uhpd_luar_kota"
                                value="{{ old('uhpd_luar_kota', $province->uhpd_luar_kota) }}"
                                class="block w-full pl-8 px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-700 focus:ring-gray-400"
                                required>
                        </div>
                        <x-input-error :messages="$errors->get('uhpd_luar_kota')" class="mt-1" />
                    </div>
                </div>

                <div class="space-y-4 border-b lg:border-b-0 lg:border-r border-gray-300 pb-4 lg:pb-0 lg:pr-6">
                    <h3 class="text-md font-bold text-gray-600 border-b border-gray-300 pb-2 mb-3">
                        Transport
                    </h3>
                    <div>
                        <label for="transport_dalam_kota" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Dalam Kota</label>
                        <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm">Rp</span>
                            <input type="number" name="transport_dalam_kota" id="transport_dalam_kota"
                                value="{{ old('transport_dalam_kota', $province->transport_dalam_kota) }}"
                                class="block w-full pl-8 px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-700 focus:ring-gray-400"
                                required>
                        </div>
                        <x-input-error :messages="$errors->get('transport_dalam_kota')" class="mt-1" />
                    </div>
                    <div>
                        <label for="transport_luar_kota" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Luar Kota</label>
                        <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm">Rp</span>
                            <input type="number" name="transport_luar_kota" id="transport_luar_kota"
                                value="{{ old('transport_luar_kota', $province->transport_luar_kota) }}"
                                class="block w-full pl-8 px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-700 focus:ring-gray-400"
                                required>
                        </div>
                        <x-input-error :messages="$errors->get('transport_luar_kota')" class="mt-1" />
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-md font-bold text-gray-600 border-b border-gray-300 pb-2 mb-3">
                        Akomodasi
                    </h3>
                    <div>
                        <label for="tiket_pesawat_luar_kota" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Tiket Pesawat (Luar Kota)</label>
                        <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm">Rp</span>
                            <input type="number" name="tiket_pesawat_luar_kota" id="tiket_pesawat_luar_kota"
                                value="{{ old('tiket_pesawat_luar_kota', $province->tiket_pesawat_luar_kota) }}"
                                class="block w-full pl-8 px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-700 focus:ring-gray-400"
                                required>
                        </div>
                        <x-input-error :messages="$errors->get('tiket_pesawat_luar_kota')" class="mt-1" />
                    </div>
                    <div>
                        <label for="hotel_luar_kota" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Hotel (Luar Kota)</label>
                        <div class="relative mt-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm">Rp</span>
                            <input type="number" name="hotel_luar_kota" id="hotel_luar_kota"
                                value="{{ old('hotel_luar_kota', $province->hotel_luar_kota) }}"
                                class="block w-full pl-8 px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-700 focus:ring-gray-400"
                                required>
                        </div>
                        <x-input-error :messages="$errors->get('hotel_luar_kota')" class="mt-1" />
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-2 mt-8 pt-4 border-t border-gray-300">
                <a href="{{ route('pengaturan-biaya-audit.index') }}" 
                    class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:outline-none transition ease-in-out duration-150">
                    {{ __('Batal') }}
                </a>

                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:bg-green-700 active:bg-green-700 focus:outline-none transition ease-in-out duration-150">
                    {{ __('Simpan') }}
                </button>
            </div>

        </form>
    </div>
</x-app-layout>