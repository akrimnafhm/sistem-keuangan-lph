<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Data Auditor') }}
        </h2>
    </x-slot>
 
    {{-- Pesan Sukses --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- ACTION BAR: Tombol Tambah (Kiri) & Search (Kanan) --}}
    <div class="mb-4 flex flex-col sm:flex-row justify-between items-center gap-4">
        
        {{-- 1. Tombol Tambah (Kiri) --}}
        <a href="{{ route('auditors.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-sm text-sm transition">
            + Tambah Auditor
        </a>

        {{-- 2. Form Search (Kanan) --}}
        <form action="{{ route('auditors.index') }}" method="GET" class="relative">
            <div class="flex items-center">
                <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari nama atau email..." 
                        class="w-64 rounded-l-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3">
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
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Kontak</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($auditors as $auditor)
                    <tr class="bg-white hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $auditor->nama }}
                            <div class="text-xs text-gray-500 mt-1">{{ $auditor->email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            {{ $auditor->nomor_aktif }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-semibold leading-tight rounded-full {{ $auditor->status === 'Aktif' ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }}">
                                {{ $auditor->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center space-x-3">
                                <a href="{{ route('auditors.edit', $auditor->id) }}" 
                                    class="inline-block text-blue-700 hover:text-blue-900 font-medium text-xs border border-blue-400 hover:bg-blue-50 px-3 py-1 rounded transition">
                                    Edit
                                </a>
                                
                                <form action="{{ route('auditors.destroy', $auditor->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus auditor ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="inline-block text-red-700 hover:text-red-900 font-medium text-xs border border-red-400 hover:bg-red-50 px-3 py-1 rounded transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500 italic">
                            Data tidak ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- PAGINATION (Bawah Kanan) --}}
    <div class="mt-4 flex justify-end">
        {{ $auditors->links() }}
    </div>
</x-app-layout>