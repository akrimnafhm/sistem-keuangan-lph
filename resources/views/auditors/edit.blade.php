<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Edit Auditor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 border rounded-lg dark:border-gray-300 bg-gray-50 shadow-lg">
                <form action="{{ route('auditors.update', $auditor->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $auditor->nama) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $auditor->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nomor HP/WA</label>
                        <input type="text" name="nomor_aktif" value="{{ old('nomor_aktif', $auditor->nomor_aktif) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400">
                            <option value="Aktif" @selected($auditor->status == 'Aktif')>Aktif</option>
                            <option value="Nonaktif" @selected($auditor->status == 'Nonaktif')>Nonaktif</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end space-x-2 mt-4 pt-4">
                        <a href="{{ route('auditors.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition ease-in-out duration-150">
                            {{ __('Batal') }}
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:bg-green-700 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Simpan') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>