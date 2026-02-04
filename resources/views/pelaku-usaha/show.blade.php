<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
                {{ __('Detail Pelaku Usaha') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8"> {{-- Padding atas-bawah dikurangi agar compact --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- KOLOM KIRI (UTAMA): Info Usaha & Detail Produk --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- Card 1: Identitas Usaha --}}
                    <div class="bg-white shadow-sm rounded-lg p-6 border-l-4 border-indigo-500">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-900 mb-4">Identitas Usaha</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-semibold">No. STTD</p>
                                <p class="text-base font-medium text-gray-900 dark:text-gray-900 mt-1">{{ $pelakuUsaha->no_sttd }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-semibold">Nama Usaha</p>
                                <p class="text-base font-medium text-gray-900 dark:text-gray-900 mt-1">{{ $pelakuUsaha->nama_usaha }}</p>
                            </div>
                            <div class="sm:col-span-2">
                                <p class="text-xs text-gray-500 uppercase font-semibold">Alamat Lengkap</p>
                                <p class="text-sm text-gray-700 dark:text-gray-900 mt-1 leading-relaxed">{{ $pelakuUsaha->alamat_lengkap }}</p>
                            </div>
                            <div class="sm:col-span-2">
                                <p class="text-xs text-gray-500 uppercase font-semibold">Lokasi</p>
                                <p class="text-sm text-gray-700 dark:text-gray-900 mt-1">
                                    {{ $pelakuUsaha->city->name ?? '-' }}, {{ $pelakuUsaha->city->province->name ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Card 2: Produk & Keuangan --}}
                    <div class="bg-white shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-900 mb-4">Detail Produk & Biaya</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="col-span-2 md:col-span-4">
                                <p class="text-xs text-gray-500 uppercase font-semibold">Jenis Produk</p>
                                <p class="text-sm text-gray-700 dark:text-gray-900 mt-1">{{ $pelakuUsaha->jenis_produk }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-semibold">Skala Usaha</p>
                                <span class="inline-flex mt-1 px-2 py-1 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                    {{ $pelakuUsaha->skala_usaha }}
                                </span>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-semibold">Jml. Produk</p>
                                <p class="text-base font-bold text-gray-800 dark:text-gray-900 mt-1">{{ $pelakuUsaha->jumlah_produk }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-xs text-gray-500 uppercase font-semibold">Biaya</p>
                                <p class="text-lg font-bold text-indigo-600 mt-1">Rp {{ number_format($pelakuUsaha->biaya, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- KOLOM KANAN (SIDEBAR): Audit Info & Tim --}}
                <div class="space-y-6">
                    
                    {{-- Card 3: Informasi Audit --}}
                    <div class="bg-white shadow-sm rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-900 mb-4">Parameter Audit</h3>
                        <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-100">
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-semibold">Jumlah Auditor</p>
                                <p class="text-2xl font-bold text-gray-800 dark:text-gray-900">{{ $pelakuUsaha->jumlah_audit }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500 uppercase font-semibold">Mandays</p>
                                <p class="text-2xl font-bold text-gray-800 dark:text-gray-900">{{ $pelakuUsaha->mandays }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Card 4: Tim Auditor --}}
                    <div class="bg-white shadow-sm rounded-lg p-6 h-auto">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-900 mb-3">Tim Auditor</h3>
                        
                        @if($pelakuUsaha->auditors->count() > 0)
                            <div class="space-y-3">
                                @foreach($pelakuUsaha->auditors as $auditor)
                                    <div class="flex items-center space-x-3 p-2 rounded-lg bg-gray-50 dark:bg-gray-100">
                                        <div class="flex-shrink-0">
                                            <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs">
                                                {{ substr($auditor->nama, 0, 2) }}
                                            </div>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-900 truncate">
                                                {{ $auditor->nama }}
                                            </p>
                                            <p class="text-xs text-gray-500 truncate">
                                                {{ $auditor->nomor_aktif }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                <p class="text-sm text-gray-500">Belum ada auditor.</p>
                            </div>
                        @endif
                    </div>
                    <div class="flex space-x-2 justify-end">
                        <a href="{{ route('pelaku-usaha.edit', $pelakuUsaha->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none transition">
                            Edit
                        </a>
                        <form action="{{ route('pelaku-usaha.destroy', $pelakuUsaha->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none transition">
                                Hapus
                            </button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>