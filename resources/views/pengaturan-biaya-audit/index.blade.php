<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{-- Judul halaman --}}
            {{ __('Pengaturan Biaya Audit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">

            {{-- Pesan Sukses --}}
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

                    
                    {{-- Tabel Data --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 shadow-md sm:rounded-lg overflow-hidden border-collapse">
                            <thead class="bg-[#36454F]/90">
                                <tr class="">
                                    <th scope="col"
                                        class="px-4 py-3 text-center text-xm font-medium text-white tracking-wider align-middle border border-[#D9D9D9]/50"
                                        rowspan="2">
                                        Provinsi
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3 text-center text-xm font-medium text-white tracking-wider border border-[#D9D9D9]/50"
                                        colspan="2">
                                        UHPD
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3 text-center text-xm font-medium text-white tracking-wider border border-[#D9D9D9]/50"
                                        colspan="2">
                                        Transport
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3 text-center text-xm font-medium text-white tracking-wider align-middle border border-[#D9D9D9]/50"
                                        rowspan="2">
                                        Hotel
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3 text-center text-xm font-medium text-white tracking-wider align-middle border border-[#D9D9D9]/50"
                                        rowspan="2">
                                        Tiket Pesawat
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3 text-center text-xm font-medium text-white tracking-wider align-middle border border-[#D9D9D9]/50"
                                        rowspan="2">
                                        Action
                                    </th>
                                </tr>

                                {{-- Baris Header Kedua (Sub-kolom) --}}
                                <tr class="">

                                    {{-- Sub-kolom UHPD --}}
                                    <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-white tracking-wider border border-[#D9D9D9]/50">
                                        Dalam Kota
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-white tracking-wider border border-[#D9D9D9]/50">
                                        Luar Kota
                                    </th>

                                    {{-- Sub-kolom Transport --}}
                                    <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-white tracking-wider border border-[#D9D9D9]/50">
                                        Dalam Kota
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-white tracking-wider border border-[#D9D9D9]/50">
                                        Luar Kota
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-white">
                                
                                {{-- PERBAIKAN: Mengganti $wilayahs as $wilayah menjadi $provinces as $province --}}
                                @foreach ($provinces as $province)
                                    <tr class="odd:bg-[#D9D9D9]/50 even:bg-[#D9D9D9]">
                                        
                                        {{-- Kolom 1: Provinsi --}}
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-500 dark:text-gray-700">
                                            {{-- PERBAIKAN: Mengganti $wilayah->nama_provinsi menjadi $province->name --}}
                                            {{ str($province->name)
                                                            ->title()
                                                            ->replace(['Dki', 'D.i.'], ['DKI', 'D.I.']) }}
                                        </td>
                                        
                                        {{-- Kolom 2: UHPD (Dalam Kota) --}}
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-700">
                                            Rp {{ number_format($province->uhpd_dalam_kota, 0, ',', '.') }}
                                        </td>
                                        
                                        {{-- Kolom 3: UHPD (Luar Kota) --}}
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-700">
                                            Rp {{ number_format($province->uhpd_luar_kota, 0, ',', '.') }}
                                        </td>
                                        
                                        {{-- Kolom 4: Transport (Dalam Kota) --}}
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-700">
                                            Rp {{ number_format($province->transport_dalam_kota, 0, ',', '.') }}
                                        </td>
                                        
                                        {{-- Kolom 5: Transport (Luar Kota) --}}
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-700">
                                            Rp {{ number_format($province->transport_luar_kota, 0, ',', '.') }}
                                        </td>
                                        
                                        {{-- Kolom 6: Hotel (Luar Kota) --}}
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-700">
                                            Rp {{ number_format($province->hotel_luar_kota, 0, ',', '.') }}
                                        </td>
                                        
                                        {{-- Kolom 7: Tiket Pesawat --}}
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-700">
                                            Rp {{ number_format($province->tiket_pesawat_luar_kota, 0, ',', '.') }}
                                        </td>
                                        
                                        <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <a href="{{ route('pengaturan-biaya-audit.edit', $province->id) }}" class="text-gray-600 dark:text-gray-500 hover:text-gray-900 dark:hover:text-gray-700 px-4 py-1 border border-gray-700 rounded-md">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>

                    {{-- Teks deskripsi DIPINDAHKAN ke bawah tabel --}}
                    <p class="text-gray-600 dark:text-gray-700 mt-4 text-sm">
                        *Daftar biaya audit (batas tertinggi) per provinsi sesuai regulasi (Kepkaban 22/2024 & SBM).
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal konfirmasi password (sama seperti pada alokasi biaya show/edit) --}}
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

    {{-- Script untuk Modal Konfirmasi (bekerja dengan banyak tombol Edit) --}}
    <script>
        (function () {
            const modal = document.getElementById('password-confirm-modal');
            const modalContent = document.getElementById('modal-content');
            const adminPasswordInput = document.getElementById('admin_password');
            const cancelBtn = document.getElementById('cancel-confirm-btn');
            const submitBtn = document.getElementById('submit-confirm-btn');
            const modalError = document.getElementById('modal-error');
            const editBtns = document.querySelectorAll('.edit-btn');

            let actionUrl = ''; // URL tujuan edit yang akan di-redirect setelah verifikasi

            function showModal(url = '') {
                actionUrl = url;
                adminPasswordInput.value = '';
                modalError.textContent = '';
                modalError.classList.add('hidden');
                modal.classList.remove('hidden');
                modal.offsetHeight; // force reflow
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

            adminPasswordInput.addEventListener('keyup', function (event) {
                if (event.key === 'Enter' || event.keyCode === 13) {
                    event.preventDefault();
                    submitBtn.click();
                }
            });

            editBtns.forEach(btn => {
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    showModal(btn.dataset.url);
                });
            });

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
                        if (actionUrl) {
                            window.location.href = actionUrl;
                        }
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
        })();
    </script>
</x-app-layout>