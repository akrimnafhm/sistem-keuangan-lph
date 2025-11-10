<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl dark:text-gray-700 leading-tight">
            {{ __('Data Pelaku Usaha') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 shadow-md sm:rounded-lg overflow-hidden">
                    
                    <thead class="bg-[#36454F]/90">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xm font-medium text-white uppercase tracking-wider">
                                No. STTD
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xm font-medium text-white uppercase tracking-wider">
                                Nama Usaha
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xm font-medium text-white uppercase tracking-wider">
                                Daerah
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xm font-medium text-white uppercase tracking-wider">
                                Skala Usaha
                            </th>
                            <th scope="col" class="relative px-6 py-3 text-center text-xm font-medium text-white uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    
                    <tbody class="bg-white dark:bg-white">
                        
                        @forelse ($pelaku_usahas as $pu)
                            <tr class="odd:bg-[#D9D9D9]/50 even:bg-[#D9D9D9]">
                                
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-700">{{ $pu->no_sttd }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-gray-700">{{ $pu->nama_usaha }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-700">{{ $pu->city?->name ?? 'N/A' }}, {{ $pu->city?->province?->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-700">{{ $pu->skala_usaha }}</td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="{{ route('pelaku-usaha.show', $pu->id) }}" class="text-gray-600 dark:text-gray-500 hover:text-gray-900 dark:hover:text-gray-700 px-4 py-1 border border-gray-700 rounded-md">
                                        View
                                    </a>
                                </td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 dark:text-gray-700">
                                    Tidak ada data pelaku usaha.
                                </td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</x-app-layout>