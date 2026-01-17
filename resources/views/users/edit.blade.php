<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

            <div class="p-6 border rounded-lg dark:border-gray-300 bg-[#E8E8E8]">
                <div class="text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Username (Read-only) -->
                         <div class="mb-4">
                            <label for="username" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Username</label>
                            <input type="text" name="username" id="username" value="{{ $user->username }}" 
                            class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-400 bg-[#E8E8E8] text-gray-500 dark:text-gray-700 cursor-not-allowed" 
                            readonly>
                        </div>

                        <!-- Nama -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Nama</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Level -->
                        <div class="mb-4">
                            <label for="level" class="block text-sm font-medium text-gray-500 dark:text-gray-700">Level</label>
                            <select name="level" id="level" class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-[#F8F8F8] text-gray-500 dark:text-gray-700" required>
                                <option value="user" @selected(old('level', $user->level) == 'user')>User</option>
                                <option value="admin" @selected(old('level', $user->level) == 'admin')>Admin</option>
                            </select>
                            <x-input-error :messages="$errors->get('level')" class="mt-2" />
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Update User') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
