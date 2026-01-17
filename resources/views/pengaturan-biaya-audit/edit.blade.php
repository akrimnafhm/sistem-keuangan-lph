<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{-- Ganti $konfigurasiBiaya->nama_provinsi menjadi $province->name --}}
            Edit Biaya Audit Provinsi {{ str($province->name)->title() }}
        </h2>
    </x-slot>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- Ganti $konfigurasiBiaya->id menjadi $province->id --}}
                    <form action="{{ route('pengaturan-biaya-audit.update', $province->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h3 class="text-lg font-semibold mb-4">UHPD</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="uhpd_dalam_kota" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dalam Kota</label>
                                {{-- Ganti $konfigurasiBiaya menjadi $province --}}
                                <input type="number" name="uhpd_dalam_kota" id="uhpd_dalam_kota" value="{{ old('uhpd_dalam_kota', $province->uhpd_dalam_kota) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                <x-input-error :messages="$errors->get('uhpd_dalam_kota')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <label for="uhpd_luar_kota" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Luar Kota</label>
                                {{-- Ganti $konfigurasiBiaya menjadi $province --}}
                                <input type="number" name="uhpd_luar_kota" id="uhpd_luar_kota" value="{{ old('uhpd_luar_kota', $province->uhpd_luar_kota) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                <x-input-error :messages="$errors->get('uhpd_luar_kota')" class="mt-2" />
                            </div>
                        </div>

                        <h3 class="text-lg font-semibold mb-4">Transport</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="transport_dalam_kota" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dalam Kota</label>
                                {{-- Ganti $konfigurasiBiaya menjadi $province --}}
                                <input type="number" name="transport_dalam_kota" id="transport_dalam_kota" value="{{ old('transport_dalam_kota', $province->transport_dalam_kota) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                <x-input-error :messages="$errors->get('transport_dalam_kota')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <label for="transport_luar_kota" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Luar Kota</label>
                                {{-- Ganti $konfigurasiBiaya menjadi $province --}}
                                <input type="number" name="transport_luar_kota" id="transport_luar_kota" value="{{ old('transport_luar_kota', $province->transport_luar_kota) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                <x-input-error :messages="$errors->get('transport_luar_kota')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label for="tiket_pesawat_luar_kota" class="block text-lg font-semibold text-gray-700 dark:text-gray-300">Tiket Pesawat Luar Kota (Rp)</label>
                                {{-- Ganti $konfigurasiBiaya menjadi $province --}}
                                <input type="number" name="tiket_pesawat_luar_kota" id="tiket_pesawat_luar_kota" value="{{ old('tiket_pesawat_luar_kota', $province->tiket_pesawat_luar_kota) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                <x-input-error :messages="$errors->get('tiket_pesawat_luar_kota')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <label for="hotel_luar_kota" class="block text-lg font-semibold text-gray-700 dark:text-gray-300">Hotel</label>
                                {{-- Ganti $konfigurasiBiaya menjadi $province --}}
                                <input type="number" name="hotel_luar_kota" id="hotel_luar_kota" value="{{ old('hotel_luar_kota', $province->hotel_luar_kota) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                <x-input-error :messages="$errors->get('hotel_luar_kota')" class="mt-2" />
                            </div>
                        </div>                        
                    </form>
                </div>              
            </div>
            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('pengaturan-biaya-audit.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mr-4">
                    {{ __('Batal') }}
                </a>
                            
                <x-primary-button>
                    {{ __('Simpan Perubahan') }}
                    </x-primary-button>
            </div>
        </div>
    </div>
</x-app-layout>