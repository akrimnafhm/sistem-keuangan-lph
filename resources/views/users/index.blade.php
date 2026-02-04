<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Kelola User') }}
        </h2>
    </x-slot>
            
    {{-- Pesan Sukses --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- TOMBOL TAMBAH (Tanpa Search Bar) --}}
    <div class="mb-4">
        <a href="{{ route('users.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-sm text-sm transition">
            + Tambah User
        </a>
    </div>

    {{-- Container Tabel --}}
    <div class="bg-white dark:bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-200 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Username</th>
                        <th class="px-6 py-4">Level</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($users as $user)
                    <tr class="bg-white hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $user->name }}
                            <div class="text-xs text-gray-500 mt-1">{{ $user->email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->username }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-semibold leading-tight rounded-full {{ $user->level === 'admin' ? 'text-purple-700 bg-purple-100' : 'text-blue-700 bg-blue-100' }}">
                                {{ ucfirst($user->level) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center space-x-3">
                                <a href="{{ route('users.edit', $user->id) }}" 
                                    class="inline-block text-blue-700 hover:text-blue-900 font-medium text-xs border border-blue-400 hover:bg-blue-50 px-3 py-1 rounded transition">
                                    Edit
                                </a>
                                
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?');" class="inline">
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
                            Data user tidak ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>