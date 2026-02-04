<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Data Pelaku Usaha') }}
        </h2>
    </x-slot>
            
    {{-- Pesan Sukses --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- ACTION BAR: Search (Kanan) --}}
    <div class="mb-4 flex justify-end">
        <form action="{{ route('pelaku-usaha.index') }}" method="GET" class="relative">
            <div class="flex items-center">
                <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari STTD atau Nama Usaha..." 
                        class="w-72 rounded-l-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3">
                <button type="submit" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-r-md text-sm transition border border-gray-700">
                    Cari
                </button>
            </div>
        </form>
    </div>

    {{-- Container Tabel --}}
    <div class="bg-white dark:bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-200 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 font-bold text-gray-800">No. STTD</th>
                        <th class="px-6 py-4 font-bold text-gray-800">Nama Usaha</th>
                        <th class="px-6 py-4 font-bold text-gray-800">Daerah</th>
                        <th class="px-6 py-4 font-bold text-gray-800">Skala Usaha</th>
                        <th class="px-6 py-4 font-bold text-gray-800 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($pelaku_usahas as $pu)
                    <tr class="bg-white hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-medium">
                            {{ $pu->no_sttd }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900">
                            {{ $pu->nama_usaha }}
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $pu->city?->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $badgeClass = match($pu->skala_usaha) {
                                    'Mikro'     => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                    'Kecil'     => 'bg-green-100 text-green-800 border border-green-200',
                                    'Menengah'  => 'bg-blue-100 text-blue-800 border border-blue-200',
                                    'Besar'     => 'bg-purple-100 text-purple-800 border border-purple-200',
                                    default     => 'bg-gray-100 text-gray-800 border border-gray-200',
                                };
                            @endphp
                            <span class="px-3 py-1 text-xs font-semibold leading-tight rounded-full {{ $badgeClass }}">
                                {{ $pu->skala_usaha }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('pelaku-usaha.show', $pu->id) }}" 
                                class="inline-block text-blue-700 hover:text-blue-900 font-medium text-xs border border-blue-400 hover:bg-blue-50 px-3 py-1 rounded transition">
                                View
                            </a>
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

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $pelaku_usahas->links() }}
    </div>
</x-app-layout>