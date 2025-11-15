<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Pengaturan Alokasi Biaya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
                    
                    {{-- Bagian Pajak --}}
                    <div class="mb-6 p-4 border rounded-lg dark:border-gray-300 bg-[#E8E8E8]">
                        <h3 class="text-lg font-medium text-gray-500 dark:text-gray-700 mb-2">Pajak</h3>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-700">Pajak (%)</label>
                            <p class="mt-1 block w-full md:w-1/3 px-3 py-2 border rounded-md shadow-sm bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                {{ number_format($konfigurasi->pajak, 0) }}%
                            </p>
                        </div>
                    </div>

                    {{-- Bagian Fee UIN (Read-only) --}}
                    <div class="mb-6 p-4 border rounded-lg dark:border-gray-300 bg-[#E8E8E8]">
                        <h3 class="text-lg font-medium text-gray-500 dark:text-gray-700 mb-4">Fee UIN (Rp)</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-700">Mikro & Kecil</label>
                                <p class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                    Rp {{ number_format($konfigurasi->fee_uin_mikro, 0, ',', '.') }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-700">Menengah</label>
                                <p class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                    Rp {{ number_format($konfigurasi->fee_uin_menengah, 0, ',', '.') }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-700">Besar</label>
                                <p class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                    Rp {{ number_format($konfigurasi->fee_uin_besar, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Fee LPH (Read-only) --}}
                    <div class="mb-6 p-4 border rounded-lg dark:border-gray-300 bg-[#E8E8E8]">
                        <h3 class="text-lg font-medium text-gray-500 dark:text-gray-700 mb-4">Fee LPH (Rp)</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                             <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-700">Mikro & Kecil</label>
                                <p class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                    Rp {{ number_format($konfigurasi->fee_lph_mikro, 0, ',', '.') }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-700">Menengah</label>
                                <p class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                    Rp {{ number_format($konfigurasi->fee_lph_menengah, 0, ',', '.') }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-700">Besar</label>
                                <p class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                    Rp {{ number_format($konfigurasi->fee_lph_besar, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Bagian Unit Cost Audit (Read-only) --}}
                    <div class="mb-6 p-4 border rounded-lg dark:border-gray-300 bg-[#E8E8E8]">
                        <h3 class="text-lg font-medium text-gray-500 dark:text-gray-700 mb-4">Unit Cost Audit (%)</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-700">Mikro & Kecil</label>
                                <p class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                    {{ number_format($konfigurasi->unit_cost_audit_mikro, 0) }}%
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-700">Menengah</label>
                                <p class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                    {{ number_format($konfigurasi->unit_cost_audit_menengah, 0) }}%
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-700">Besar</label>
                                <p class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm bg-[#F8F8F8] text-gray-500 dark:text-gray-700">
                                    {{ number_format($konfigurasi->unit_cost_audit_besar, 0) }}%
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-start mt-6">
                        <button type="button" id="edit-btn" data-url="{{ route('alokasi-biaya.edit') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Edit
                        </button>
                    </div>
                </div>
            </div>
            
            <div id="password-confirm-modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 hidden transition-opacity duration-300 ease-out" style="opacity: 0;">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl w-full max-w-md transform transition-all duration-300 ease-out scale-95 opacity-0" id="modal-content">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100 mb-4">Konfirmasi Password Admin</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Untuk melanjutkan, silakan masukkan password Anda.</p>
                    <div class="mb-4">
                        <label for="admin_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 sr-only">Password</label>
                        <input type="password" name="admin_password" id="admin_password" placeholder="Password Admin" 
                               class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <p id="modal-error" class="text-red-500 text-xs mt-1 hidden"></p> 
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" id="cancel-confirm-btn" class="px-4 py-2 bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-md hover:bg-gray-300 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Batal
                        </button>
                        <button type="button" id="submit-confirm-btn" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Konfirmasi
                        </button>
                    </div>
                </div>
            </div>
            </div>
    </div>

    {{-- Script untuk Modal (Versi Sederhana untuk Edit) --}}
    <script>
        const modal = document.getElementById('password-confirm-modal');
        const modalContent = document.getElementById('modal-content');
        const adminPasswordInput = document.getElementById('admin_password');
        const cancelBtn = document.getElementById('cancel-confirm-btn');
        const submitBtn = document.getElementById('submit-confirm-btn');
        const modalError = document.getElementById('modal-error');
        const editBtn = document.getElementById('edit-btn');

        let actionUrl = ''; // Hanya untuk menyimpan URL edit

        function showModal(url = '') {
            actionUrl = url;
            adminPasswordInput.value = ''; 
            modalError.textContent = ''; 
            modalError.classList.add('hidden'); 
            modal.classList.remove('hidden');
            modal.offsetHeight; 
            modal.style.opacity = '1';
            modalContent.style.opacity = '1';
            modalContent.style.transform = 'scale(1)';
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

        // Listener untuk tombol Enter di input password
        adminPasswordInput.addEventListener('keyup', function(event) {
            if (event.key === 'Enter' || event.keyCode === 13) {
                event.preventDefault(); 
                submitBtn.click(); 
            }
        });

        // Listener untuk tombol Edit
        editBtn.addEventListener('click', (e) => { 
            e.preventDefault(); 
            showModal(editBtn.dataset.url);
        });

        // Listener untuk tombol Konfirmasi di modal
        submitBtn.addEventListener('click', async () => {
            const password = adminPasswordInput.value;
            if (!password) {
                modalError.textContent = 'Password tidak boleh kosong.';
                modalError.classList.remove('hidden');
                return;
            }

            modalError.classList.add('hidden'); 
            submitBtn.disabled = true; 
            submitBtn.textContent = 'Memverifikasi...';

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
                    window.location.href = actionUrl; // <-- Langsung redirect ke halaman edit
                } else {
                    modalError.textContent = 'Password yang Anda masukkan salah.';
                    modalError.classList.remove('hidden');
                }

            } catch (error) {
                console.error('Error verifying password:', error); 
                modalError.textContent = 'Terjadi kesalahan. Coba lagi.';
                modalError.classList.remove('hidden');
            } finally {
                 submitBtn.disabled = false; 
                 submitBtn.textContent = 'Konfirmasi';
            }
        });
    </script>
</x-app-layout>