<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Detail Pelaku Usaha') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- Kita akan menggunakan form di sini agar tombol Hapus berfungsi --}}
                    <form action="{{ route('pelaku-usaha.destroy', $pelakuUsaha->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        {{-- Layout Grid untuk menampilkan data --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Kolom Kiri --}}
                            <div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">No. STTD</label>
                                    <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $pelakuUsaha->no_sttd }}</p>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Nama Usaha</label>
                                    <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $pelakuUsaha->nama_usaha }}</p>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Alamat Lengkap</label>
                                    <p class="mt-1 text-base text-gray-700 dark:text-gray-300">{{ $pelakuUsaha->alamat_lengkap }}</p>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Daerah (Provinsi)</label>
                                    <p class="mt-1 text-base text-gray-700 dark:text-gray-300">{{ $pelakuUsaha->city->name . ', ' . $pelakuUsaha->city->province->name}}</p>
                                </div>
                            </div>

                            {{-- Kolom Kanan --}}
                            <div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Skala Usaha</label>
                                    <p class="mt-1 text-base text-gray-700 dark:text-gray-300">{{ $pelakuUsaha->skala_usaha }}</p>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Jenis Produk</label>
                                    <p class="mt-1 text-base text-gray-700 dark:text-gray-300">{{ $pelakuUsaha->jenis_produk }}</p>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Jumlah Produk</label>
                                    <p class="mt-1 text-base text-gray-700 dark:text-gray-300">{{ $pelakuUsaha->jumlah_produk }}</p>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Biaya</label>
                                    <p class="mt-1 text-base text-gray-700 dark:text-gray-300">Rp {{ number_format($pelakuUsaha->biaya, 2, ',', '.') }}</p>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Jumlah Audit</label>
                                    <p class="mt-1 text-base text-gray-700 dark:text-gray-300">{{ $pelakuUsaha->jumlah_audit }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Aksi di Bawah --}}
                        <div class="mt-8 border-t dark:border-gray-700 pt-6 flex items-center justify-start space-x-4">
                            
                            {{-- Tombol Edit --}}
                            <a href="{{ route('pelaku-usaha.edit', $pelakuUsaha->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Edit
                            </a>

                            {{-- Tombol Hapus --}}
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                Hapus
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>