    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl dark:text-gray-700 leading-tight">
                {{ __('Kelola User') }}
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
                        
                        <!-- Tombol Tambah User -->
                        <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-[#36454F]/90 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-[#36454F] focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mb-4">
                            Tambah User Baru
                        </a>

                        <!-- Tabel Data User -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 shadow-md sm:rounded-lg overflow-hidden">

                                <thead class="bg-[#36454F]/90">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xm font-medium text-white tracking-wider">Nama</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xm font-medium text-white tracking-wider">Username</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xm font-medium text-white tracking-wider">Level</th>
                                        <th scope="col" class="relative px-6 py-3 text-center text-xm font-medium text-white tracking-wider">
                                            Action
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white dark:bg-white">
                                    
                                    @forelse ($users as $user)
                                    <tr class="odd:bg-[#D9D9D9]/50 even:bg-[#D9D9D9]">

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-500 dark:text-gray-700">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-700">{{ $user->username }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-700">{{ ucfirst($user->level) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <a href="{{ route('users.show', $user->id) }}" class="text-gray-600 dark:text-gray-500 hover:text-gray-900 dark:hover:text-gray-700 px-4 py-1 border border-gray-700 rounded-md">View</a>
                                        </td>
                                    
                                    </tr>
                                    
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 dark:text-gray-400">
                                            Tidak ada data user.
                                        </td>
                                    </tr>
                                    @endforelse
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    
