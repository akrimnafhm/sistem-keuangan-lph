<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Kelola Profile') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Profile Information Card --}}
            <div class="bg-white shadow-lg rounded-xl border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="bg-white border-b border-gray-200 px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <h3 class="text-lg font-bold text-gray-800">Informasi Profile</h3>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            {{-- Update Password Card --}}
            <div class="bg-white shadow-lg rounded-xl border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="bg-white border-b border-gray-200 px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <h3 class="text-lg font-bold text-gray-800">Ubah Password</h3>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            {{-- Delete Account Card --}}
            <div class="bg-white shadow-lg rounded-xl border border-gray-200 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="bg-white border-b border-gray-200 px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <h3 class="text-lg font-bold text-gray-800">Zona Berbahaya</h3>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
