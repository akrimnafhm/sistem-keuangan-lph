<x-guest-layout>
    <div class="flex flex-col lg:flex-row w-full max-w-6xl mx-auto bg-white shadow-2xl rounded-lg overflow-hidden">

        <div class="w-full lg:w-1/2 relative self-stretch hidden lg:block">
            <div class="h-full w-full bg-cover bg-center"
                 style="background-image: url('{{ asset('img/login-bg.jpg') }}');">
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col justify-center items-start py-12 px-8 md:px-16">
            <div class="w-full max-w-md mx-auto lg:mx-0">
                <div class="mb-8">
                    <a href="/">
                        <img src="{{ asset('img/lph-logo.png') }}" alt="Logo LPH" class="h-24 w-auto mb-4">
                    </a>
                    <h2 class="text-2xl md:text-3xl font-semibold text-gray-700">Sistem Keuangan LPH</h2>
                    <p class="text-base text-gray-500 mt-2">Silakan masuk ke akun Anda</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-5 relative">
                        <label for="username" class="sr-only">Username (NIP/NIM)</label>
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                           <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                        </div>
                        <x-text-input id="username" class="block w-full pl-11 pr-3 py-3 rounded-lg border-gray-400 bg-gray-100 text-gray-700 focus:border-gray-500 focus:ring-gray-500 text-lg"
                                      type="text" name="username" :value="old('username')" required autofocus
                                      placeholder="Username (NIP/NIM)" />
                        <x-input-error :messages="$errors->get('username')" class="mt-1 text-red-600" />
                    </div>

                    <div class="mb-5 relative">
                        <label for="password" class="sr-only">Password</label>
                         <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                             <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002 2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" /></svg>
                        </div>
                        <x-text-input id="password" class="block w-full pl-11 pr-3 py-3 rounded-lg border-gray-400 bg-gray-100 text-gray-700 focus:border-gray-500 focus:ring-gray-500 text-lg"
                                      type="password"
                                      name="password"
                                      required autocomplete="current-password"
                                      placeholder="Password"/>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600" />
                    </div>

                    <div class="block mb-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded bg-white border-gray-400 text-gray-600 shadow-sm focus:ring-gray-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                        </label>
                    </div>

                    <div class="mt-6">
                        <x-primary-button class="w-full justify-center py-3 focus:ring-[#5F5F5F] text-white text-base">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>

                <p class="mt-8 text-xs text-gray-500">
                    &copy; {{ date('Y') }} Lembaga Penjamin Halal
                </p>
            </div>
        </div>
        
    </div>
</x-guest-layout>