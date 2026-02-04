<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Rekapitulasi Biaya Audit') }}
        </h2>
    </x-slot>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Search Bar (Sama) --}}
    <div class="mb-4 flex justify-end">
        <form action="{{ route('rekapitulasi.index') }}" method="GET" class="relative">
            <div class="flex items-center">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari STTD atau Nama Usaha..."
                    class="w-72 rounded-l-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3">
                <button type="submit"
                    class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-r-md text-sm transition border border-gray-700">
                    Cari
                </button>
            </div>
        </form>
    </div>

    {{-- Tabel --}}
    <div class="bg-white dark:bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-200 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 font-bold text-gray-800">No. Rekap</th>
                        <th class="px-6 py-4 font-bold text-gray-800">No. STTD</th>
                        <th class="px-6 py-4 font-bold text-gray-800">Nama Usaha</th>
                        <th class="px-6 py-4 font-bold text-gray-800">Nilai Kontrak</th>
                        <th class="px-6 py-4 font-bold text-gray-800 text-center">Status Rekap</th>
                        <th class="px-6 py-4 font-bold text-gray-800 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($pelaku_usahas as $pu)
                        <tr class="bg-white hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $pu->rekapitulasi?->no_rekap ?? '-' }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $pu->no_sttd }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ $pu->nama_usaha }}
                                <div class="text-xs text-gray-500 font-normal mt-1">{{ $pu->city?->name }}</div>
                            </td>
                            <td class="px-6 py-4 font-medium text-indigo-700">
                                Rp {{ number_format($pu->biaya, 0, ',', '.') }}
                            </td>

                            {{-- STATUS REKAPITULASI --}}
                            <td class="px-6 py-4 text-center">
                                @if($pu->rekapitulasi)
                                    @if($pu->rekapitulasi->status == 'Final')
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded-full border border-green-200">
                                            Final
                                        </span>
                                    @else
                                        <span
                                            class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2 py-1 rounded-full border border-yellow-200">
                                            Draft
                                        </span>
                                    @endif
                                @else
                                    <span
                                        class="bg-gray-100 text-gray-500 text-xs font-bold px-2 py-1 rounded-full border border-gray-200">
                                        Belum Ada
                                    </span>
                                @endif
                            </td>

                            {{-- TOMBOL AKSI --}}
                            <td class="px-6 py-4 text-center">
                                @if($pu->rekapitulasi)
                                    @if($pu->rekapitulasi->status == 'Final')
                                        {{-- Jika Final, tombol Lihat Laporan menuju halaman show --}}
                                        <a href="{{ route('rekapitulasi.show', $pu->rekapitulasi->id) }}"
                                            class="inline-block text-green-700 hover:text-green-900 font-medium text-xs border border-green-400 hover:bg-green-50 px-3 py-1 rounded transition">
                                            Lihat Laporan
                                        </a>
                                    @else
                                        {{-- Jika Draft, tombol Lanjut Draft ke edit --}}
                                        <a href="{{ route('rekapitulasi.edit', $pu->rekapitulasi->id) }}"
                                            class="inline-block text-yellow-700 hover:text-yellow-900 font-medium text-xs border border-yellow-400 hover:bg-yellow-50 px-3 py-1 rounded transition">
                                            Lanjut Draft
                                        </a>
                                    @endif
                                @else
                                    {{-- Jika belum ada, tombolnya BUAT --}}
                                    <a href="{{ route('rekapitulasi.create', ['pelaku_usaha_id' => $pu->id]) }}"
                                        class="inline-block text-blue-700 hover:text-blue-900 font-medium text-xs border border-blue-400 hover:bg-blue-50 px-3 py-1 rounded transition">
                                        Hitung Biaya
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">
                                Tidak ada data pelaku usaha.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $pelaku_usahas->links() }}
    </div>
</x-app-layout>