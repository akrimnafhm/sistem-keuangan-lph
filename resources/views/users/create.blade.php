<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Tambah User Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 border rounded-lg dark:border-gray-300 bg-gray-50 shadow-lg">
                <div class="text-gray-900 dark:text-gray-100">

                    {{-- FORM CREATE USER --}}
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="username" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Username (NIP/NIM)</label>
                            <input type="text" name="username" id="username" value="{{ old('username') }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400"
                                required autofocus>
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Nama</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400"
                                required>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="level" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Level</label>
                            <select name="level" id="level"
                                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400"
                                required>
                                <option value="user" @selected(old('level') == 'user')>User</option>
                                <option value="admin" @selected(old('level') == 'admin')>Admin</option>
                            </select>
                            <x-input-error :messages="$errors->get('level')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Password</label>
                            <input type="password" name="password" id="password"
                                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400"
                                required>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400"
                                required>
                        </div>

                        <div class="flex items-center justify-end space-x-2 mt-4 pt-4">
                            <a href="{{ route('users.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition ease-in-out duration-150">
                                {{ __('Batal') }}
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:bg-green-700 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Simpan') }}
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>