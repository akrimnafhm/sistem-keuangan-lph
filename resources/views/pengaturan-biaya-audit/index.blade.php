<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Standar Biaya Wilayah') }}
        </h2>
    </x-slot>
            
    {{-- Pesan Sukses --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- ACTION BAR: Search (Kanan) --}}
    <div class="mb-4 flex justify-end">
        <form action="{{ route('pengaturan-biaya-audit.index') }}" method="GET" class="relative">
            <div class="flex items-center">
                <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari provinsi..." 
                        class="w-64 rounded-l-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-2 px-3">
                <button type="submit" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-r-md text-sm transition border border-gray-700">
                    Cari
                </button>
            </div>
        </form>
    </div>

    {{-- Container Tabel --}}
    <div class="bg-white dark:bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-200 border-b border-gray-200">
                    {{-- Header Utama --}}
                    <tr>
                        <th rowspan="2" class="px-4 py-3 text-center border-r border-gray-200 align-middle font-bold text-gray-800">Provinsi</th>
                        <th colspan="2" class="px-4 py-2 text-center border-b border-r border-gray-200 font-bold text-gray-800">UHPD</th>
                        <th colspan="2" class="px-4 py-2 text-center border-b border-r border-gray-200 font-bold text-gray-800">Transport</th>
                        <th rowspan="2" class="px-4 py-3 text-center border-r border-gray-200 align-middle font-bold text-gray-800">Hotel (Luar)</th>
                        <th rowspan="2" class="px-4 py-3 text-center border-r border-gray-200 align-middle font-bold text-gray-800">Pesawat</th>
                        <th rowspan="2" class="px-4 py-3 text-center align-middle font-bold text-gray-800">Action</th>
                    </tr>
                    {{-- Sub Header --}}
                    <tr>
                        <th class="px-2 py-2 text-center text-[10px] border-r border-gray-200 text-gray-600">Dalam Kota</th>
                        <th class="px-2 py-2 text-center text-[10px] border-r border-gray-200 text-gray-600">Luar Kota</th>
                        <th class="px-2 py-2 text-center text-[10px] border-r border-gray-200 text-gray-600">Dalam Kota</th>
                        <th class="px-2 py-2 text-center text-[10px] border-r border-gray-200 text-gray-600">Luar Kota</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($provinces as $province)
                    <tr class="bg-white hover:bg-gray-50 transition">
                        <td class="px-4 py-3 font-medium text-gray-900 border-r border-gray-100">
                            {{ str($province->name)->title()->replace(['Dki', 'D.i.'], ['DKI', 'D.I.']) }}
                        </td>
                        <td class="px-2 py-3 text-right border-r border-gray-100 whitespace-nowrap">
                            {{ number_format($province->uhpd_dalam_kota, 0, ',', '.') }}
                        </td>
                        <td class="px-2 py-3 text-right border-r border-gray-100 whitespace-nowrap">
                            {{ number_format($province->uhpd_luar_kota, 0, ',', '.') }}
                        </td>
                        <td class="px-2 py-3 text-right border-r border-gray-100 whitespace-nowrap">
                            {{ number_format($province->transport_dalam_kota, 0, ',', '.') }}
                        </td>
                        <td class="px-2 py-3 text-right border-r border-gray-100 whitespace-nowrap">
                            {{ number_format($province->transport_luar_kota, 0, ',', '.') }}
                        </td>
                        <td class="px-2 py-3 text-right border-r border-gray-100 whitespace-nowrap">
                            {{ number_format($province->hotel_luar_kota, 0, ',', '.') }}
                        </td>
                        <td class="px-2 py-3 text-right border-r border-gray-100 whitespace-nowrap">
                            {{ number_format($province->tiket_pesawat_luar_kota, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button type="button" 
                                    data-url="{{ route('pengaturan-biaya-audit.edit', $province->id) }}" 
                                    class="edit-btn inline-block text-blue-700 hover:text-blue-900 font-medium text-xs border border-blue-400 hover:bg-blue-50 px-3 py-1 rounded transition">
                                Edit
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center text-gray-500 italic">Data provinsi tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $provinces->links() }}
    </div>

    {{-- MODAL VERIFIKASI (Sama seperti sebelumnya) --}}
    <div id="password-confirm-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 hidden transition-opacity duration-300 ease-out" style="opacity: 0;">
        <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md transform transition-all duration-300 ease-out scale-95 opacity-0" id="modal-content">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Konfirmasi Password Admin</h3>
            <p class="text-sm text-gray-600 mb-4">Untuk melanjutkan, silakan masukkan password Anda.</p>
            <div class="mb-4">
                <label for="admin_password" class="block text-sm font-medium text-gray-700 sr-only">Password</label>
                <input type="password" id="admin_password" placeholder="Password Admin" 
                       class="mt-1 block w-full border-gray-300 bg-white text-gray-900 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <p id="modal-error" class="text-red-500 text-xs mt-1 hidden"></p> 
            </div>
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" id="cancel-confirm-btn" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Batal</button>
                <button type="button" id="submit-confirm-btn" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Konfirmasi</button>
            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('password-confirm-modal');
            const modalContent = document.getElementById('modal-content');
            const adminPasswordInput = document.getElementById('admin_password');
            const cancelBtn = document.getElementById('cancel-confirm-btn');
            const submitBtn = document.getElementById('submit-confirm-btn');
            const modalError = document.getElementById('modal-error');
            const editBtns = document.querySelectorAll('.edit-btn'); 

            let actionUrl = ''; 

            function showModal(url) {
                actionUrl = url;
                adminPasswordInput.value = ''; 
                modalError.textContent = ''; 
                modalError.classList.add('hidden'); 
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.style.opacity = '1';
                    modalContent.style.opacity = '1';
                    modalContent.style.transform = 'scale(1)';
                }, 10);
                adminPasswordInput.focus(); 
            }

            function hideModal() {
                modal.style.opacity = '0';
                modalContent.style.opacity = '0';
                modalContent.style.transform = 'scale(0.95)';
                setTimeout(() => { 
                     modal.classList.add('hidden');
                     actionUrl = '';
                }, 300); 
            }

            cancelBtn.addEventListener('click', hideModal);

            editBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    showModal(this.dataset.url);
                });
            });

            adminPasswordInput.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') submitBtn.click();
            });

            submitBtn.addEventListener('click', async () => {
                const password = adminPasswordInput.value;
                if (!password) {
                    modalError.textContent = 'Password wajib diisi.';
                    modalError.classList.remove('hidden');
                    return;
                }

                modalError.classList.add('hidden'); 
                submitBtn.disabled = true; 
                submitBtn.textContent = 'Verifikasi...';

                try {
                    const response = await fetch('{{ route("password.verify") }}', { 
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                        },
                        body: JSON.stringify({ password: password })
                    });

                    const result = await response.json();

                    if (result.verified) {
                        hideModal(); 
                        window.location.href = actionUrl; 
                    } else {
                        modalError.textContent = 'Password salah.';
                        modalError.classList.remove('hidden');
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Konfirmasi';
                    }
                } catch (error) {
                    console.error(error);
                    modalError.textContent = 'Terjadi kesalahan.';
                    modalError.classList.remove('hidden');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Konfirmasi';
                }
            });
        });
    </script>
</x-app-layout>