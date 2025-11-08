<div class="fixed left-0 top-0 h-full w-72 shrink-0 bg-[#D9D9D9] text-gray-900 z-50 flex flex-col">
    
    <div class="p-6">
        <a class="flex justify-center" href="{{ route('dashboard') }}">
            <img src="{{ asset('img/lph-logo.png') }}" alt="Logo LPH" class="h-24 w-auto">
        </a>
    </div>

    <div class="flex flex-col flex-1 overflow-y-auto">
        
        <div class="p-4">
            <a href="{{ route('pelaku-usaha.create') }}" class="w-full bg-[#516776] hover:bg-[#36454F] text-white font-medium py-3 px-4 rounded-lg flex items-center justify-center space-x-2 transition-colors">
                <span>Tambah Pelaku Usaha</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </a>
        </div>

        <nav class="flex-1 px-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 py-3 px-4 rounded-lg hover:bg-[#5F5F5F] hover:text-white transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#737373] text-white' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {{-- ... (ikon dashboard) ... --}}
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('pelaku-usaha.index') }}" class="flex items-center space-x-3 py-3 px-4 rounded-lg hover:bg-[#5F5F5F] hover:text-white transition-colors {{ request()->routeIs('pelaku-usaha.index') ? 'bg-[#737373] text-white' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {{-- ... (ikon data PU) ... --}}
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span>Data PU</span>
            </a>

            <a href="#" class="flex items-center space-x-3 py-3 px-4 rounded-lg hover:bg-[#5F5F5F] hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {{-- ... (ikon biaya audit) ... --}}
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                <span>Biaya Audit</span>
            </a>


            @can('admin')
            
            <a href="{{ route('alokasi-biaya.show') }}" class="flex items-center space-x-3 py-3 px-4 rounded-lg hover:bg-[#5F5F5F] hover:text-white transition-colors {{ request()->routeIs('alokasi-biaya.*') ? 'bg-[#737373] text-white' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Alokasi Biaya</span>
            </a>

            <a href="{{ route('pengaturan-biaya-audit.index') }}" class="flex items-center space-x-3 py-3 px-4 rounded-lg hover:bg-[#5F5F5F] hover:text-white transition-colors {{ request()->routeIs('pengaturan-biaya-audit.*') ? 'bg-[#737373] text-white' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>Pengaturan Biaya Audit</span>
            </a>

            <a href="{{ route('users.index') }}" class="flex items-center space-x-3 py-3 px-4 rounded-lg hover:bg-[#5F5F5F] hover:text-white transition-colors {{ request()->routeIs('users.*') ? 'bg-[#737373] text-white' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span>Kelola User</span>
            </a>
            @endcan
            </nav>

        <div class="p-4 border-t border-gray-400">
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