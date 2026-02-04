<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Aturan Fee & Pajak') }}
        </h2>
    </x-slot>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Container Tabel Utama (Tanpa padding berlebih) --}}
    <div class="bg-white dark:bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-200 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 font-bold text-gray-800">Komponen</th>
                        <th class="px-6 py-4 font-bold text-gray-800">Mikro</th>
                        <th class="px-6 py-4 font-bold text-gray-800">Kecil</th>
                        <th class="px-6 py-4 font-bold text-gray-800">Menengah</th>
                        <th class="px-6 py-4 font-bold text-gray-800">Besar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($biaya as $item)
                        <tr class="bg-white hover:bg-gray-50 transition">
                            {{-- Nama Komponen --}}
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $item->komponen }}
                                @if(in_array($item->komponen, ['Unit Cost', 'Pajak']))
                                    <span class="text-xs font-normal text-blue-600 ml-1">(%)</span>
                                @else
                                    <span class="text-xs font-normal text-green-600 ml-1">(Rp)</span>
                                @endif
                            </td>

                            {{-- Nilai Mikro --}}
                            <td class="px-6 py-4">
                                @if(in_array($item->komponen, ['Unit Cost', 'Pajak']))
                                    {{ number_format($item->mikro, 0) }}%
                                @else
                                    Rp {{ number_format($item->mikro, 0, ',', '.') }}
                                @endif
                            </td>

                            {{-- Nilai Kecil --}}
                            <td class="px-6 py-4">
                                @if(in_array($item->komponen, ['Unit Cost', 'Pajak']))
                                    {{ number_format($item->kecil, 0) }}%
                                @else
                                    Rp {{ number_format($item->kecil, 0, ',', '.') }}
                                @endif
                            </td>

                            {{-- Nilai Menengah --}}
                            <td class="px-6 py-4">
                                @if(in_array($item->komponen, ['Unit Cost', 'Pajak']))
                                    {{ number_format($item->menengah, 0) }}%
                                @else
                                    Rp {{ number_format($item->menengah, 0, ',', '.') }}
                                @endif
                            </td>

                            {{-- Nilai Besar --}}
                            <td class="px-6 py-4">
                                @if(in_array($item->komponen, ['Unit Cost', 'Pajak']))
                                    {{ number_format($item->besar, 0) }}%
                                @else
                                    Rp {{ number_format($item->besar, 0, ',', '.') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tombol Edit dengan Verifikasi (Di Kanan Bawah) --}}
    <div class="mt-4 flex justify-end">
        <button type="button" id="edit-btn" data-url="{{ route('alokasi-biaya.edit') }}"
            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
            Edit
        </button>
    </div>

    {{-- MODAL VERIFIKASI PASSWORD --}}
    <div id="password-confirm-modal"
        class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 hidden transition-opacity duration-300 ease-out"
        style="opacity: 0;">
        <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md transform transition-all duration-300 ease-out scale-95 opacity-0"
            id="modal-content">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Konfirmasi Password Admin
            </h3>
            <p class="text-sm text-gray-600 mb-4">Untuk melanjutkan, silakan masukkan password Anda.
            </p>

            <div class="mb-4">
                <label for="admin_password"
                    class="block text-sm font-medium text-gray-700 sr-only">Password</label>
                <input type="password" id="admin_password" placeholder="Password Admin"
                    class="mt-1 block w-full border-gray-300 bg-white text-gray-900 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <p id="modal-error" class="text-red-500 text-xs mt-1 hidden"></p>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" id="cancel-confirm-btn"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition">
                    Batal
                </button>
                <button type="button" id="submit-confirm-btn"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition shadow-sm">
                    Konfirmasi
                </button>
            </div>
        </div>
    </div>

    {{-- SCRIPT MODAL --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('password-confirm-modal');
            const modalContent = document.getElementById('modal-content');
            const adminPasswordInput = document.getElementById('admin_password');
            const cancelBtn = document.getElementById('cancel-confirm-btn');
            const submitBtn = document.getElementById('submit-confirm-btn');
            const modalError = document.getElementById('modal-error');
            const editBtn = document.getElementById('edit-btn');

            let actionUrl = '';

            function showModal(url = '') {
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

            // Listener tombol Edit
            if (editBtn) {
                editBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    showModal(editBtn.dataset.url);
                });
            }

            // Listener tombol Enter pada input password
            adminPasswordInput.addEventListener('keyup', function (event) {
                if (event.key === 'Enter' || event.keyCode === 13) {
                    event.preventDefault();
                    submitBtn.click();
                }
            });

            // Listener tombol Submit (Konfirmasi)
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
                        window.location.href = actionUrl;
                    } else {
                        modalError.textContent = 'Password yang Anda masukkan salah.';
                        modalError.classList.remove('hidden');
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Konfirmasi';
                    }

                } catch (error) {
                    console.error('Error verifying password:', error);
                    modalError.textContent = 'Terjadi kesalahan. Coba lagi.';
                    modalError.classList.remove('hidden');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Konfirmasi';
                }
            });
        });
    </script>
</x-app-layout>