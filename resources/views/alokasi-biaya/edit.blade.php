<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Edit Aturan Fee & Pajak') }}
        </h2>
    </x-slot>

    {{-- Pesan Sukses (Jika ada redirect back) --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Pesan Error Validasi --}}
    @if($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            <strong class="font-bold">Terjadi kesalahan!</strong>
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Container Form (Tanpa padding berlebih di luar tabel) --}}
    <div class="bg-white dark:bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
        <form action="{{ route('alokasi-biaya.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-200 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 font-bold text-gray-800">Komponen</th>
                            <th class="px-6 py-4 font-bold text-gray-800 text-center">Mikro</th>
                            <th class="px-6 py-4 font-bold text-gray-800 text-center">Kecil</th>
                            <th class="px-6 py-4 font-bold text-gray-800 text-center">Menengah</th>
                            <th class="px-6 py-4 font-bold text-gray-800 text-center">Besar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($biaya as $item)
                            <tr class="bg-white hover:bg-gray-50 transition">
                                {{-- Nama Komponen (Read Only) --}}
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $item->komponen }}
                                    @if(in_array($item->komponen, ['Unit Cost', 'Pajak']))
                                        <span class="text-xs font-normal text-blue-600 ml-1">(%)</span>
                                    @else
                                        <span class="text-xs font-normal text-green-600 ml-1">(Rp)</span>
                                    @endif

                                    {{-- Hidden ID untuk update --}}
                                    <input type="hidden" name="biaya[{{ $item->id }}][id]" value="{{ $item->id }}">
                                </td>

                                {{-- Input Mikro --}}
                                <td class="px-4 py-3">
                                    <input type="number" step="0.01" name="biaya[{{ $item->id }}][mikro]"
                                        value="{{ old("biaya.{$item->id}.mikro", $item->mikro) }}"
                                        class="w-full text-sm text-right border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50">
                                </td>

                                {{-- Input Kecil --}}
                                <td class="px-4 py-3">
                                    <input type="number" step="0.01" name="biaya[{{ $item->id }}][kecil]"
                                        value="{{ old("biaya.{$item->id}.kecil", $item->kecil) }}"
                                        class="w-full text-sm text-right border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50">
                                </td>

                                {{-- Input Menengah --}}
                                <td class="px-4 py-3">
                                    <input type="number" step="0.01" name="biaya[{{ $item->id }}][menengah]"
                                        value="{{ old("biaya.{$item->id}.menengah", $item->menengah) }}"
                                        class="w-full text-sm text-right border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50">
                                </td>

                                {{-- Input Besar --}}
                                <td class="px-4 py-3">
                                    <input type="number" step="0.01" name="biaya[{{ $item->id }}][besar]"
                                        value="{{ old("biaya.{$item->id}.besar", $item->besar) }}"
                                        class="w-full text-sm text-right border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex items-center justify-end px-6 py-4 bg-gray-50 border-t border-gray-200 gap-3">
                <a href="{{ route('alokasi-biaya.show') }}" 
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
</x-app-layout>