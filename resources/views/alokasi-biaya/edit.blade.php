<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Pengaturan Alokasi Biaya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Notifikasi Sukses -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div>
                <div class="text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('alokasi-biaya.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Bagian Pajak --}}
                        <div class="mb-6 p-4 border rounded-lg dark:border-gray-300 bg-[#E8E8E8]">
                            <h3 class="text-lg font-medium text-gray-500 dark:text-gray-700 mb-2">Pajak</h3>
                            <div>
                                <label for="pajak" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Pajak (%)</label>
                                <input type="number" name="pajak" id="pajak" value="{{ old('pajak', $konfigurasi->pajak) }}" class="mt-1 block w-full md:w-1/3 px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                <x-input-error :messages="$errors->get('pajak')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Bagian Fee UIN --}}
                        <div class="mb-6 p-4 border rounded-lg dark:border-gray-300 bg-[#E8E8E8]">
                            <h3 class="text-lg font-medium text-gray-500 dark:text-gray-700 mb-4">Fee UIN (Rp)</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="fee_uin_mikro" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Mikro & Kecil</label>
                                    <input type="number" name="fee_uin_mikro" id="fee_uin_mikro" value="{{ old('fee_uin_mikro', $konfigurasi->fee_uin_mikro) }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                    <x-input-error :messages="$errors->get('fee_uin_mikro')" class="mt-2" />
                                </div>
                                <div>
                                    <label for="fee_uin_menengah" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Menengah</label>
                                    <input type="number" name="fee_uin_menengah" id="fee_uin_menengah" value="{{ old('fee_uin_menengah', $konfigurasi->fee_uin_menengah) }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                    <x-input-error :messages="$errors->get('fee_uin_menengah')" class="mt-2" />
                                </div>
                                <div>
                                    <label for="fee_uin_besar" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Besar</label>
                                    <input type="number" name="fee_uin_besar" id="fee_uin_besar" value="{{ old('fee_uin_besar', $konfigurasi->fee_uin_besar) }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                    <x-input-error :messages="$errors->get('fee_uin_besar')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- Bagian Fee LPH --}}
                        <div class="mb-6 p-4 border rounded-lg dark:border-gray-300 bg-[#E8E8E8]">
                            <h3 class="text-lg font-medium text-gray-500 dark:text-gray-700 mb-4">Fee LPH (Rp)</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="fee_lph_mikro" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Mikro & Kecil</label>
                                    <input type="number" name="fee_lph_mikro" id="fee_lph_mikro" value="{{ old('fee_lph_mikro', $konfigurasi->fee_lph_mikro) }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                    <x-input-error :messages="$errors->get('fee_lph_mikro')" class="mt-2" />
                                </div>
                                <div>
                                    <label for="fee_lph_menengah" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Menengah</label>
                                    <input type="number" name="fee_lph_menengah" id="fee_lph_menengah" value="{{ old('fee_lph_menengah', $konfigurasi->fee_lph_menengah) }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                    <x-input-error :messages="$errors->get('fee_lph_menengah')" class="mt-2" />
                                </div>
                                <div>
                                    <label for="fee_lph_besar" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Besar</label>
                                    <input type="number" name="fee_lph_besar" id="fee_lph_besar" value="{{ old('fee_lph_besar', $konfigurasi->fee_lph_besar) }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                    <x-input-error :messages="$errors->get('fee_lph_besar')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- Bagian Unit Cost Audit --}}
                        <div class="mb-6 p-4 border rounded-lg dark:border-gray-300 bg-[#E8E8E8]">
                            <h3 class="text-lg font-medium text-gray-500 dark:text-gray-700 mb-4">Unit Cost Audit (%)</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="unit_cost_audit_mikro" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Mikro & Kecil</label>
                                    <input type="number" name="unit_cost_audit_mikro" id="unit_cost_audit_mikro" value="{{ old('unit_cost_audit_mikro', $konfigurasi->unit_cost_audit_mikro) }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                    <x-input-error :messages="$errors->get('unit_cost_audit_mikro')" class="mt-2" />
                                </div>
                                <div>
                                    <label for="unit_cost_audit_menengah" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Menengah</label>
                                    <input type="number" name="unit_cost_audit_menengah" id="unit_cost_audit_menengah" value="{{ old('unit_cost_audit_menengah', $konfigurasi->unit_cost_audit_menengah) }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                    <x-input-error :messages="$errors->get('unit_cost_audit_menengah')" class="mt-2" />
                                </div>
                                <div>
                                    <label for="unit_cost_audit_besar" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Besar</label>
                                    <input type="number" name="unit_cost_audit_besar" id="unit_cost_audit_besar" value="{{ old('unit_cost_audit_besar', $konfigurasi->unit_cost_audit_besar) }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                    <x-input-error :messages="$errors->get('unit_cost_audit_besar')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="flex items-center justify-end mt-6">
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