<div class="fixed left-0 top-0 h-full w-72 shrink-0 bg-white text-gray-600 z-50 flex flex-col shadow-xl border-r border-gray-200">
    
    {{-- LOGO AREA --}}
    <div class="p-6 flex items-center justify-center">
        <a href="{{ route('dashboard') }}" class="transition-transform hover:scale-105 duration-300">
            <img src="{{ asset('img/lph-logo.png') }}" alt="Logo LPH" class="h-24 w-auto drop-shadow-sm">
        </a>
    </div>

    <div class="flex flex-col flex-1 overflow-y-auto px-4 py-6 scrollbar-thin scrollbar-thumb-gray-300">
        
        {{-- TOMBOL UTAMA (CTA) - Warna Biru --}}
        <div class="pb-6">
            <a href="{{ route('pelaku-usaha.create') }}" class="group w-full bg-blue-600 hover:bg-blue-500 text-white font-semibold text-sm py-3 px-4 rounded-md flex items-center justify-center space-x-2 transition-all duration-200 shadow-md hover:shadow-lg">
                <span class="tracking-wide">Tambah Pelaku Usaha</span>
                <svg class="w-4 h-4 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </a>
        </div>

        {{-- NAVIGATION - Space Y ditingkatkan jadi 2 --}}
        <nav class="flex-1 space-y-2">
            
            {{-- DASHBOARD --}}
            <a href="{{ route('dashboard') }}" 
               class="flex items-center space-x-3 py-3 px-4 rounded-lg text-sm transition-all duration-200 group border-l-4 
               {{ request()->routeIs('dashboard') 
                  ? 'bg-[#E8E8E8] text-gray-900 border-indigo-500 font-bold' 
                  : 'border-transparent hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="truncate">Dashboard</span>
            </a>

            {{-- DATA PU --}}
            <a href="{{ route('pelaku-usaha.index') }}" 
               class="flex items-center space-x-3 py-3 px-4 rounded-lg text-sm transition-all duration-200 group border-l-4 
               {{ request()->routeIs('pelaku-usaha.index') || request()->routeIs('pelaku-usaha.show') || request()->routeIs('pelaku-usaha.edit') 
                  ? 'bg-[#E8E8E8] text-gray-900 border-indigo-500 font-bold' 
                  : 'border-transparent hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('pelaku-usaha.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <span class="truncate">Data PU</span>
            </a>

            {{-- REKAPITULASI --}}
            <a href="{{ route('rekapitulasi.index') }}" 
               class="flex items-center space-x-3 py-3 px-4 rounded-lg text-sm transition-all duration-200 group border-l-4 
               {{ request()->routeIs('rekapitulasi.index') || request()->routeIs('rekapitulasi.show') || request()->routeIs('rekapitulasi.create') || request()->routeIs('rekapitulasi.edit') 
                  ? 'bg-[#E8E8E8] text-gray-900 border-indigo-500 font-bold' 
                  : 'border-transparent hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('rekapitulasi.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
                <span class="truncate">Rekapitulasi Biaya</span>
            </a>

            @can('admin')

            {{-- PARAMETER KEUANGAN --}}
            <div x-data="{ open: {{ request()->routeIs('alokasi-biaya.*') || request()->routeIs('pengaturan-biaya-audit.*') ? 'true' : 'false' }} }" class="space-y-1">
                
                <button @click="open = !open" 
                    class="w-full flex items-center justify-between py-3 px-4 rounded-lg text-sm transition-all duration-200 group border-l-4 
                    {{ request()->routeIs('alokasi-biaya.*') || request()->routeIs('pengaturan-biaya-audit.*') 
                       ? 'bg-[#E8E8E8] text-gray-900 border-indigo-500 font-bold' 
                       : 'border-transparent hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 {{ request()->routeIs('alokasi-biaya.*') || request()->routeIs('pengaturan-biaya-audit.*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="truncate">Parameter Keuangan</span>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                {{-- Submenu dengan spacing --}}
                <div x-show="open" x-transition class="space-y-1 pl-4 pt-1">
                    <a href="{{ route('alokasi-biaya.show') }}" 
                       class="block py-2.5 px-4 rounded-md text-xs transition-colors border-l-2
                       {{ request()->routeIs('alokasi-biaya.*') 
                          ? 'border-indigo-500 text-indigo-700 bg-indigo-50 font-semibold' 
                          : 'border-transparent text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">
                        Aturan Fee & Pajak
                    </a>
                    <a href="{{ route('pengaturan-biaya-audit.index') }}" 
                       class="block py-2.5 px-4 rounded-md text-xs transition-colors border-l-2
                       {{ request()->routeIs('pengaturan-biaya-audit.*') 
                          ? 'border-indigo-500 text-indigo-700 bg-indigo-50 font-semibold' 
                          : 'border-transparent text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">
                        Standar Biaya Wilayah
                    </a>
                </div>
            </div>

            {{-- DATA MASTER --}}
            <div x-data="{ open: {{ request()->routeIs('users.*') || request()->is('auditors*') ? 'true' : 'false' }} }" class="space-y-1">
                
                <button @click="open = !open" 
                    class="w-full flex items-center justify-between py-3 px-4 rounded-lg text-sm transition-all duration-200 group border-l-4 
                    {{ request()->routeIs('users.*') || request()->is('auditors*') 
                       ? 'bg-[#E8E8E8] text-gray-900 border-indigo-500 font-bold' 
                       : 'border-transparent hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 {{ request()->routeIs('users.*') || request()->is('auditors*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                        </svg>
                        <span class="truncate">Data Master</span>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div x-show="open" x-transition class="space-y-1 pl-4 pt-1">
                    <a href="{{ route('auditors.index') }}" 
                       class="block py-2.5 px-4 rounded-md text-xs transition-colors border-l-2
                       {{ request()->is('auditors*') 
                          ? 'border-indigo-500 text-indigo-700 bg-indigo-50 font-semibold' 
                          : 'border-transparent text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">
                        Data Auditor
                    </a>
                    <a href="{{ route('users.index') }}" 
                       class="block py-2.5 px-4 rounded-md text-xs transition-colors border-l-2
                       {{ request()->routeIs('users.*') 
                          ? 'border-indigo-500 text-indigo-700 bg-indigo-50 font-semibold' 
                          : 'border-transparent text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">
                        Data User
                    </a>
                </div>
            </div>

            @endcan
        </nav>

        {{-- LOGOUT AREA --}}
        <div class="pt-6 mt-auto border-t border-gray-200">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center space-x-2 py-3 px-4 rounded-md bg-red-600 text-white hover:bg-red-500 transition-all duration-200 shadow-sm hover:shadow-md group">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="font-bold text-sm tracking-wide">Logout</span>
                </button>
            </form>
        </div>
    </div>
</div>