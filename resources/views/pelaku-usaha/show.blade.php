<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Detail Pelaku Usaha') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="border rounded-lg dark:border-gray-300 bg-[#E8E8E8]">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Kolom Kiri --}}
                            <div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-600">No. STTD</label>
                                    <input readonly type="text" value="{{ $pelakuUsaha->no_sttd }}" class="mt-1 block w-full border border-gray-300 dark:border-gray-400 bg-[#E8E8E8] dark:bg-[#E8E8E8] text-gray-800 dark:text-gray-600 rounded-md shadow-sm px-3 py-2" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-600">Nama Usaha</label>
                                    <input readonly type="text" value="{{ $pelakuUsaha->nama_usaha }}" class="mt-1 block w-full border border-gray-300 dark:border-gray-400 bg-[#E8E8E8] dark:bg-[#E8E8E8] text-gray-800 dark:text-gray-600 rounded-md shadow-sm px-3 py-2" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-600">Alamat Lengkap</label>
                                    <textarea readonly rows="3" class="mt-1 block w-full border border-gray-300 dark:border-gray-400 bg-[#E8E8E8] dark:bg-[#E8E8E8] text-gray-800 dark:text-gray-600 rounded-md shadow-sm px-3 py-2">{{ $pelakuUsaha->alamat_lengkap }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-600">Daerah (Provinsi)</label>
                                    <input readonly type="text" value="{{ $pelakuUsaha->city->name . ', ' . $pelakuUsaha->city->province->name }}" class="mt-1 block w-full border border-gray-300 dark:border-gray-400 bg-[#E8E8E8] dark:bg-[#E8E8E8] text-gray-800 dark:text-gray-600 rounded-md shadow-sm px-3 py-2" />
                                </div>
                            </div>

                            {{-- Kolom Kanan --}}
                            <div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-600">Skala Usaha</label>
                                    <input readonly type="text" value="{{ $pelakuUsaha->skala_usaha }}" class="mt-1 block w-full border border-gray-300 dark:border-gray-400 bg-[#E8E8E8] dark:bg-[#E8E8E8] text-gray-800 dark:text-gray-600 rounded-md shadow-sm px-3 py-2" />
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-600">Jenis Produk</label>
                                    <textarea readonly rows="3" class="mt-1 block w-full border border-gray-300 dark:border-gray-400 bg-[#E8E8E8] dark:bg-[#E8E8E8] text-gray-800 dark:text-gray-600 rounded-md shadow-sm px-3 py-2">{{ $pelakuUsaha->jenis_produk }}</textarea>
                                </div>
                                <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-600">Biaya</label>
                                        <input readonly type="text" value="Rp {{ number_format($pelakuUsaha->biaya, 2, ',', '.') }}" class="mt-1 block w-full border border-gray-300 dark:border-gray-400 bg-[#E8E8E8] dark:bg-[#E8E8E8] text-gray-800 dark:text-gray-600 rounded-md shadow-sm px-3 py-2" />
                                </div>
                                <div class="mb-4 grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-600">Jumlah Produk</label>
                                        <input readonly type="text" value="{{ $pelakuUsaha->jumlah_produk }}" class="mt-1 block w-full border border-gray-300 dark:border-gray-400 bg-[#E8E8E8] dark:bg-[#E8E8E8] text-gray-800 dark:text-gray-600 rounded-md shadow-sm px-3 py-2" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-600">Jumlah Audit</label>
                                        <input readonly type="text" value="{{ $pelakuUsaha->jumlah_audit }}" class="mt-1 block w-full border border-gray-300 dark:border-gray-400 bg-[#E8E8E8] dark:bg-[#E8E8E8] text-gray-800 dark:text-gray-600 rounded-md shadow-sm px-3 py-2" />
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>

            {{-- Tombol aksi: ditempatkan di luar container rounded dan di sisi kanan --}}
            <div class="mt-4 flex justify-end space-x-3">
                <a href="{{ route('pelaku-usaha.edit', $pelakuUsaha->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                    Edit
                </a>

                <form action="{{ route('pelaku-usaha.destroy', $pelakuUsaha->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition">
                        Hapus
                    </button>
                </form>
            </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>