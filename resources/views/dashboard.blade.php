<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- BULAN SELECTOR --}}
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <form method="GET" action="{{ route('dashboard') }}" class="flex items-center gap-4 flex-wrap align-left">
                    {{-- Filter Label --}}
                    <label class="text-base font-semibold text-gray-700 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6 2a1 1 0 011 1v1h6V3a1 1 0 112 0v1h1a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2h1V3a1 1 0 011-1zm10 7H4v7a1 1 0 001 1h10a1 1 0 001-1V9zM5 7h10V6H5v1z"/>
                        </svg>
                        Filter Periode:
                    </label>

                    {{-- Month Dropdown --}}
                    <select name="month" id="month" class="px-4 py-1.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-medium text-sm text-gray-700 text-left w-32">
                        @php
                            $months = [
                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                            ];
                        @endphp
                        @foreach($months as $m => $name)
                            <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>

                    {{-- Year Dropdown --}}
                    <select name="year" id="year" class="px-4 py-1.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-medium text-sm text-gray-700 text-left w-20">
                        @for($y = now()->year - 2; $y <= now()->year + 2; $y++)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>

                    {{-- Submit Button --}}
                    <button type="submit" class="px-4 py-1.5 bg-indigo-600 text-white font-semibold text-sm rounded-md hover:bg-indigo-700 transition">
                        Tampilkan
                    </button>

                    {{-- Data Badge --}}
                    <div class="ml-auto">
                        <span class="px-3 py-1 bg-indigo-100 text-indigo-700 font-semibold rounded-full text-xs whitespace-nowrap border border-indigo-300">
                            @php
                                $monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            @endphp
                            Data: {{ $monthNames[$month - 1] }} {{ $year }}
                        </span>
                    </div>
                </form>
            </div>
            
            {{-- ADMIN DASHBOARD --}}
            @if($isAdmin)
                {{-- SECTION 1: TOTAL KONTRAK, REKAP FINAL, REKAP DRAFT --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    {{-- Total Kontrak --}}
                    <div class="md:col-span-2 bg-white rounded-lg shadow p-6 border-t-4 border-indigo-500">
                        <h3 class="text-lg font-bold text-gray-700 mb-4">Total Kontrak</h3>
                        <p class="text-4xl font-bold text-indigo-600">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500 mt-2">
                            @php
                                $monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            @endphp
                            Bulan {{ $monthNames[$month - 1] }}
                        </p>
                    </div>

                    {{-- Rekapitulasi Final --}}
                    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-blue-500">
                        <h3 class="text-lg font-bold text-gray-700 mb-4">Rekapitulasi Final</h3>
                        <p class="text-4xl font-bold text-blue-600">{{ $rekapFinalThisMonth->count() }}</p>
                        <p class="text-sm text-gray-500 mt-2">Sudah diselesaikan</p>
                    </div>

                    {{-- Rekapitulasi Belum Disentuh --}}
                    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-yellow-500">
                        <h3 class="text-lg font-bold text-gray-700 mb-4">Tugas Rekapitulasi</h3>
                        <p class="text-4xl font-bold text-yellow-600">{{ count($rekapDraftThisMonth) + $rekapNotTouchedThisMonth }}</p>
                        <p class="text-sm text-gray-500 mt-2">Belum diselesaikan</p>
                    </div>
                </div>
            @else
                {{-- USER DASHBOARD: Rekapitulasi Final dan Tugas Rekapitulasi --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                    {{-- Rekapitulasi Final --}}
                    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-blue-500">
                        <h3 class="text-lg font-bold text-gray-700 mb-4">Rekapitulasi Final</h3>
                        <p class="text-4xl font-bold text-blue-600">{{ $rekapFinalThisMonth->count() }}</p>
                        <p class="text-sm text-gray-500 mt-2">Sudah diselesaikan</p>
                    </div>

                    {{-- Rekapitulasi Draft --}}
                    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-orange-500">
                        <h3 class="text-lg font-bold text-gray-700 mb-4">Rekapitulasi Draft</h3>
                        <p class="text-4xl font-bold text-orange-600">{{ $rekapDraftThisMonth->count() }}</p>
                        <p class="text-sm text-gray-500 mt-2">Sedang dikerjakan</p>
                    </div>

                    {{-- Tugas Rekapitulasi Belum Disentuh --}}
                    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-red-500">
                        <h3 class="text-lg font-bold text-gray-700 mb-4">Tugas Rekapitulasi</h3>
                        <p class="text-4xl font-bold text-red-600">{{ $rekapNotTouchedThisMonth }}</p>
                        <p class="text-sm text-gray-500 mt-2">Belum dikerjakan</p>
                    </div>
                </div>
            @endif
            
            @if($isAdmin)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    {{-- Total BPJPH --}}
                    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-rose-500">
                        <h3 class="text-lg font-bold text-gray-700 mb-4">BPJPH</h3>
                        <p class="text-2xl font-bold text-rose-600">Rp {{ number_format($totalBpjph, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500 mt-2">Potongan BPJPH</p>
                    </div>

                    {{-- Total LPH --}}
                    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-rose-500">
                        <h3 class="text-lg font-bold text-gray-700 mb-4">LPH</h3>
                        <p class="text-2xl font-bold text-rose-600">Rp {{ number_format($totalLph, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500 mt-2">Biaya Admin LPH</p>
                    </div>

                    {{-- Total UIN --}}
                    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-rose-500">
                        <h3 class="text-lg font-bold text-gray-700 mb-4">UIN</h3>
                        <p class="text-2xl font-bold text-rose-600">Rp {{ number_format($totalUin, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500 mt-2">Potongan UIN</p>
                    </div>

                    {{-- Biaya Operasional --}}
                    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-rose-500">
                        <h3 class="text-lg font-bold text-gray-700 mb-4">Biaya Operasional</h3>
                        <p class="text-2xl font-bold text-rose-600">Rp {{ number_format($totalOps, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500 mt-2">Total UHPD, Transport, Hotel, Pesawat</p>
                    </div>
                </div>

                {{-- CHART KEUANGAN 12 BULAN --}}
                <div class="mt-6 mb-12 bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-700 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                        </svg>
                        Total Kontrak 12 Bulan Terakhir
                    </h3>
                    
                    <div class="mt-6">
                        <div class="flex items-end justify-between h-48 gap-1">
                            @php
                                $maxKeuangan = !empty($keuangan12Months) ? max($keuangan12Months) : 1;
                                $maxKeuangan = max($maxKeuangan, 1);
                            @endphp
                            @if(!empty($keuangan12Months))
                                @forelse($keuangan12Months as $monthLabel => $total)
                                    @php
                                        $heightPercent = $total > 0 ? ($total / $maxKeuangan * 100) : 5;
                                        $heightPx = ($heightPercent / 100) * 192; // 192px adalah h-48
                                    @endphp
                                    <div class="flex flex-col items-center flex-1 justify-end h-full">
                                        <div class="w-full bg-gradient-to-t from-indigo-400 to-indigo-600 rounded-t transition-all" 
                                             style="height: {{ $heightPx }}px; min-height: 5px;"
                                             title="Rp {{ number_format($total, 0) }}">
                                        </div>
                                        <p class="text-xs text-gray-600 mt-2">{{ $monthLabel }}</p>
                                    </div>
                                @empty
                                    <p class="text-gray-500 text-center py-8">Belum ada data keuangan</p>
                                @endforelse
                            @else
                                <p class="text-gray-500 text-center py-8 w-full">Belum ada data keuangan</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                {{-- Card Pelaku Usaha Bulan Ini --}}
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-700 mb-4 flex items-center">
                        Total Pelaku Usaha
                    </h3>
                    <div class="text-center py-6">
                        <p class="text-5xl font-bold text-green-600 mb-2">{{ $pelakuUsahaThisMonth }}</p>
                        <p class="text-gray-500">Pelaku Usaha Terdaftar</p>
                    </div>

                    {{-- Breakdown by Skala --}}
                    @if($pelakuUsahaBySkala->isNotEmpty())
                        <div class="mt-6 space-y-3">
                            <p class="text-sm font-semibold text-gray-600 uppercase">Berdasarkan Skala Usaha</p>
                            @foreach($pelakuUsahaBySkala as $item)
                                @php
                                    $colorClass = match(strtolower($item->skala_usaha)) {
                                        'micro' => 'bg-yellow-500',
                                        'kecil' => 'bg-green-600',
                                        'menengah' => 'bg-blue-600',
                                        'besar' => 'bg-purple-600',
                                        default => 'bg-gray-600'
                                    };
                                    $bgClass = match(strtolower($item->skala_usaha)) {
                                        'micro' => 'bg-yellow-100',
                                        'kecil' => 'bg-green-100',
                                        'menengah' => 'bg-blue-100',
                                        'besar' => 'bg-purple-100',
                                        default => 'bg-gray-100'
                                    };
                                @endphp
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-700">{{ ucfirst($item->skala_usaha) }}</span>
                                    <div class="flex items-center gap-2">
                                        <div class="w-24 {{ $bgClass }} rounded-full h-2">
                                            <div class="{{ $colorClass }} h-2 rounded-full" style="width: {{ ($item->total / $pelakuUsahaThisMonth * 100) ?? 0 }}%"></div>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-800 w-8">{{ $item->total }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Chart 12 Bulan Terakhir --}}
                <div class="md:col-span-2 bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-700 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                        </svg>
                        Total Pelaku Usaha  12 Bulan Terakhir
                    </h3>
                    <div class="mt-6">
                        <div class="flex items-end justify-between h-40 gap-1">
                            @php
                                $maxValue = !empty($pelakuUsaha12Months) ? max($pelakuUsaha12Months) : 1;
                                $maxValue = max($maxValue, 1); // Pastikan minimal 1 untuk scaling
                            @endphp
                            @forelse($pelakuUsaha12Months as $monthLabel => $count)
                                @php
                                    $heightPercent = $count > 0 ? ($count / $maxValue * 100) : 5;
                                    $heightPx = ($heightPercent / 100) * 160; // 160px adalah h-40
                                @endphp
                                <div class="flex flex-col items-center flex-1 justify-end h-full">
                                    <div class="w-full bg-gradient-to-t from-green-400 to-green-500 rounded-t transition-all" 
                                         style="height: {{ $heightPx }}px; min-height: 5px;"
                                         title="{{ $count }} Pelaku Usaha">
                                    </div>
                                    <p class="text-xs text-gray-600 mt-2">{{ $monthLabel }}</p>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-8">Belum ada data pelaku usaha</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</x-app-layout>
