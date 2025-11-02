<x-guest-layout>
    {{-- Container utama dua kolom dengan jarak space-x-6 --}}
    <div class="flex flex-col lg:flex-row w-full max-w-6xl mx-auto lg:space-x-6 items-stretch min-h-screen lg:min-h-[600px]">

        {{-- Kolom Kiri: Gambar Trapesium --}}
        <div class="w-full lg:w-[50%] relative self-stretch">
            {{-- Mobile: Gambar persegi panjang --}}
            <div class="lg:hidden h-48 w-full bg-cover bg-center rounded-lg"
                 style="background-image: url('https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fG9mZmljZXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=800&q=80');">
            </div>
            
            {{-- Desktop: Gambar segiempat dengan sudut bulat --}}
            <div class="hidden lg:block absolute inset-0 p-0.5 pr-2">
                <div class="h-full w-full bg-cover bg-center rounded-lg"
                     style="background-image: url('https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fG9mZmljZXxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=800&q=80');">
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Form Login --}}
        <div class="w-full lg:w-[50%] flex flex-col justify-center items-start py-1 lg:py-2">
            <div class="w-full px-1 lg:px-2 pl-2">
                <div class="max-w-sm mx-auto lg:mx-0">
                <div class="mb-8">
                    {{-- Logo LPH Anda --}}
                    <a href="/">
                        <img src="https://placehold.co/80x80/777777/FFFFFF?text=LPH" alt="Logo LPH" class="h-16 w-auto mb-4" onerror="this.src='https://placehold.co/80x80/CCCCCC/FFFFFF?text=Logo'; this.onerror=null;">
                    </a>
                    <h2 class="text-2xl md:text-3xl font-semibold text-gray-700">Sistem Keuangan LPH</h2>
                    <p class="text-base text-gray-500 mt-2">Silakan masuk ke akun Anda</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Username -->
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

                    <!-- Password -->
                    <div class="mb-5 relative">
                        <label for="password" class="sr-only">Password</label>
                         <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                             <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" /></svg>
                        </div>
                        <x-text-input id="password" class="block w-full pl-11 pr-3 py-3 rounded-lg border-gray-400 bg-gray-100 text-gray-700 focus:border-gray-500 focus:ring-gray-500 text-lg"
                                      type="password"
                                      name="password"
                                      required autocomplete="current-password"
                                      placeholder="Password"/>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mb-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded bg-white border-gray-400 text-gray-600 shadow-sm focus:ring-gray-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                        </label>
                    </div>

                    <div class="mt-6">
                        <x-primary-button class="w-full justify-center py-3 bg-gray-700 hover:bg-gray-600 focus:ring-gray-500 text-white text-base">
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
    </div>
</x-guest-layout>