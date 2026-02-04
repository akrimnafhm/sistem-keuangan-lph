<div class="fixed left-0 top-0 h-full w-72 shrink-0 bg-[#D9D9D9] text-gray-900 z-50 flex flex-col shadow-lg">
    
    <div class="p-6">
        <a class="flex justify-center" href="{{ route('dashboard') }}">
            <img src="{{ asset('img/lph-logo.png') }}" alt="Logo LPH" class="h-24 w-auto drop-shadow-md">
        </a>
    </div>

    <div class="flex flex-col flex-1 overflow-y-auto px-4">
        
        <div class="pb-4">
            <a href="{{ route('pelaku-usaha.create') }}" class="w-full bg-[#516776] hover:bg-[#36454F] text-white font-medium py-3 px-4 rounded-lg flex items-center justify-center space-x-2 transition-colors shadow-sm">
                <span>Tambah Pelaku Usaha</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </a>
        </div>

        <nav class="flex-1 space-y-2">
            
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 py-3 px-4 rounded-lg hover:bg-[#5F5F5F] hover:text-white transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#737373] text-white' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('pelaku-usaha.index') }}" class="flex items-center space-x-3 py-3 px-4 rounded-lg hover:bg-[#5F5F5F] hover:text-white transition-colors {{ request()->routeIs('pelaku-usaha.index') || request()->routeIs('pelaku-usaha.show') || request()->routeIs('pelaku-usaha.edit') ? 'bg-[#737373] text-white' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <span>Data PU</span>
            </a>

            {{-- Menggunakan route placeholder '#' dulu karena fiturnya belum dibuat --}}
            <a href="#" class="flex items-center space-x-3 py-3 px-4 rounded-lg hover:bg-[#5F5F5F] hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {{-- Ikon Kalkulator/Uang --}}
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
                <span>Rekapitulasi Biaya</span>
            </a>


            @can('admin')
            
            {{-- Warna & Ukuran disesuaikan dengan kode permintaanmu --}}
            <div x-data="{ open: {{ request()->routeIs('alokasi-biaya.*') || request()->routeIs('pengaturan-biaya-audit.*') ? 'true' : 'false' }} }" class="space-y-1">
                
                <button @click="open = !open" class="w-full flex items-center justify-between py-3 px-4 rounded-lg hover:bg-[#5F5F5F] hover:text-white transition-colors {{ request()->routeIs('alokasi-biaya.*') || request()->routeIs('pengaturan-biaya-audit.*') ? 'bg-[#737373] text-white' : '' }}">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Parameter Keuangan</span>
                    </div>
                    {{-- Icon Panah --}}
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                {{-- Sub Menu: Menggunakan warna dasar yang sama tapi sedikit indent --}}
                <div x-show="open" x-transition class="space-y-2 pl-4 pt-1">
                    <a href="{{ route('alokasi-biaya.show') }}" class="flex items-center space-x-3 py-2 px-4 rounded-lg text-sm hover:bg-[#5F5F5F] hover:text-white transition-colors {{ request()->routeIs('alokasi-biaya.*') ? 'font-bold text-[#36454F]' : '' }}">
                        <span>Aturan Fee & Pajak</span>
                    </a>
                    <a href="{{ route('pengaturan-biaya-audit.index') }}" class="flex items-center space-x-3 py-2 px-4 rounded-lg text-sm hover:bg-[#5F5F5F] hover:text-white transition-colors {{ request()->routeIs('pengaturan-biaya-audit.*') ? 'font-bold text-[#36454F]' : '' }}">
                        <span>Standar Biaya Wilayah</span>
                    </a>
                </div>
            </div>

            <div x-data="{ open: {{ request()->routeIs('users.*') || request()->is('auditors*') ? 'true' : 'false' }} }" class="space-y-1">
                
                <button @click="open = !open" class="w-full flex items-center justify-between py-3 px-4 rounded-lg hover:bg-[#5F5F5F] hover:text-white transition-colors {{ request()->routeIs('users.*') || request()->is('auditors*') ? 'bg-[#737373] text-white' : '' }}">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                        </svg>
                        <span>Data Master</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                {{-- Sub Menu --}}
                <div x-show="open" x-transition class="space-y-2 pl-4 pt-1">
                    {{-- Placeholder link untuk Auditor --}}
                    <a href="{{ route('auditors.index') }}" class="flex items-center space-x-3 py-2 px-4 rounded-lg text-sm hover:bg-[#5F5F5F] hover:text-white transition-colors {{ request()->is('auditors*') ? 'font-bold text-[#36454F]' : '' }}">
                        <span>Data Auditor</span>
                    </a>
                    <a href="{{ route('users.index') }}" class="flex items-center space-x-3 py-2 px-4 rounded-lg text-sm hover:bg-[#5F5F5F] hover:text-white transition-colors {{ request()->routeIs('users.*') ? 'font-bold text-[#36454F]' : '' }}">
                        <span>Data User</span>
                    </a>
                </div>
            </div>

            @endcan
        </nav>

        <div class="p-4 border-t border-gray-400 mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 py-3 px-4 rounded-lg hover:bg-[#5F5F5F] hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</div>