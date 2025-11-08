<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pengaturan Biaya Audit per Wilayah') }}
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

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="overflow-x-auto border rounded-lg dark:border-gray-700">
                        {{-- Tambahkan ID pada tabel untuk event delegation --}}
                        <table id="wilayah-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr class="divide-x dark:divide-gray-600">
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Provinsi</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">UHPD (Dalam Kota)</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">UHPD (Luar Kota)</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Transport (Dalam Kota)</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Transport (Luar Kota)</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Hotel (Luar Kota)</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tiket Pesawat</th>
                                    <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                
                                @foreach ($wilayahs as $wilayah)
                                    <tr class="divide-x dark:divide-gray-700">
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white">{{ $wilayah->nama_provinsi }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">Rp {{ number_format($wilayah->uhpd_dalam_kota, 0, ',', '.') }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">Rp {{ number_format($wilayah->uhpd_luar_kota, 0, ',', '.') }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">Rp {{ number_format($wilayah->transport_dalam_kota, 0, ',', '.') }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">Rp {{ number_format($wilayah->transport_luar_kota, 0, ',', '.') }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">Rp {{ number_format($wilayah->hotel_luar_kota, 0, ',', '.') }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">Rp {{ number_format($wilayah->tiket_pesawat_luar_kota, 0, ',', '.') }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            {{-- Tambahkan class 'edit-btn' dan 'data-url' --}}
                                            <a href="{{ route('pengaturan-biaya-audit.edit', $wilayah->id) }}" class="edit-btn text-indigo-600 dark:text-indigo-400 hover:text-indigo-900" data-url="{{ route('pengaturan-biaya-audit.edit', $wilayah->id) }}">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>

                    <p class="text-gray-600 dark:text-gray-400 mt-4 text-sm">
                        Halaman ini menampilkan daftar biaya audit (batas tertinggi) per provinsi sesuai regulasi (Kepkaban 22/2024 & SBM). Klik "Edit" untuk mengubah nilai.
                    </p>
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

    {{-- Script untuk Modal (Event Delegation) --}}
    <script>
        const modal = document.getElementById('password-confirm-modal');
        const modalContent = document.getElementById('modal-content');
        const adminPasswordInput = document.getElementById('admin_password');
        const cancelBtn = document.getElementById('cancel-confirm-btn');
        const submitBtn = document.getElementById('submit-confirm-btn');
        const modalError = document.getElementById('modal-error');
        const table = document.getElementById('wilayah-table'); // ID Tabel

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

        // === Event Delegation untuk semua tombol Edit ===
        table.addEventListener('click', (e) => {
            // Cek apakah yang diklik adalah tombol/link dengan class 'edit-btn'
            if (e.target.classList.contains('edit-btn')) {
                e.preventDefault(); // Mencegah link berpindah halaman
                const url = e.target.dataset.url || e.target.href; // Ambil URL dari data-url atau href
                showModal(url);
            }
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