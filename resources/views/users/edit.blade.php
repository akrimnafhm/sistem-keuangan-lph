<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-700 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    {{-- NOTIFIKASI SUKSES / PASSWORD RESET --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    {{-- Notifikasi Khusus Password Baru (Hasil dari Script JS) --}}
    <div id="password-notification-area" class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4 hidden">
        {{-- Diisi oleh Javascript --}}
    </div>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 border rounded-lg dark:border-gray-300 bg-gray-50 shadow-lg">
                <div class="text-gray-900 dark:text-gray-100">

                    {{-- FORM EDIT DATA UTAMA --}}
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="username"
                                class="block text-sm font-medium text-gray-500 dark:text-gray-700">Username</label>
                            <input type="text" name="username" id="username" value="{{ $user->username }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm border-gray-300 bg-gray-200 text-gray-500 dark:text-gray-700 cursor-not-allowed"
                                readonly>
                        </div>

                        <div class="mb-4">
                            <label for="name"
                                class="block text-sm font-medium text-gray-500 dark:text-gray-700">Nama</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400"
                                required>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="level"
                                class="block text-sm font-medium text-gray-500 dark:text-gray-700">Level</label>
                            <select name="level" id="level"
                                class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm dark:border-gray-300 bg-white text-gray-500 dark:text-gray-700 focus:ring-gray-400"
                                required>
                                <option value="user" @selected(old('level', $user->level) == 'user')>User</option>
                                <option value="admin" @selected(old('level', $user->level) == 'admin')>Admin</option>
                            </select>
                            <x-input-error :messages="$errors->get('level')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-700">Password
                                User</label>

                            <div class="flex items-justify gap-3">
                                <input type="text" readonly value="********"
                                    class="flex-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-200 text-gray-500 cursor-not-allowed tracking-widest">

                                <button type="button" id="reset-password-btn"
                                    class="inline-flex items-center justify-center px-4 py-2 bg-yellow-400 text-yellow-900 rounded-md hover:bg-yellow-300 transition shadow-sm font-medium text-sm whitespace-nowrap flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                                    </svg>
                                    Reset Password
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 mt-2 italic">*Klik tombol kuning di atas jika user lupa password.
                            </p>
                        </div>

                        <div class="flex items-center justify-end space-x-2 mt-4 pt-4">
                            <a href="{{ route('users.index') }}"
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
            </div>
        </div>
    </div>

    {{-- MODAL KONFIRMASI (Hidden by default) --}}
    <div id="password-confirm-modal"
        class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 hidden transition-opacity duration-300 ease-out"
        style="opacity: 0;">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl w-full max-w-md transform transition-all duration-300 ease-out scale-95 opacity-0"
            id="modal-content">
            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100 mb-4">Konfirmasi Reset Password
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Anda akan mereset password untuk user
                <strong>{{ $user->username }}</strong>. Masukkan password Admin Anda untuk melanjutkan.
            </p>

            <div class="mb-4">
                <label for="admin_password"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 sr-only">Password</label>
                <input type="password" id="admin_password" placeholder="Password Admin Anda"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <p id="modal-error" class="text-red-500 text-xs mt-1 hidden"></p>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" id="cancel-confirm-btn"
                    class="px-4 py-2 bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-md hover:bg-gray-300 transition">
                    Batal
                </button>
                <button type="button" id="submit-confirm-btn"
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition shadow-sm">
                    Konfirmasi Reset
                </button>
            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('password-confirm-modal');
            const modalContent = document.getElementById('modal-content');
            const adminPasswordInput = document.getElementById('admin_password');
            const cancelBtn = document.getElementById('cancel-confirm-btn');
            const submitBtn = document.getElementById('submit-confirm-btn');
            const modalError = document.getElementById('modal-error');
            const resetPasswordBtn = document.getElementById('reset-password-btn');

            // --- Logic Notifikasi Password Baru ---
            const urlParams = new URLSearchParams(window.location.search);
            const newPassword = urlParams.get('new_password');

            if (newPassword) {
                const notifArea = document.getElementById('password-notification-area');
                notifArea.innerHTML = `
                    <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Password Reset Berhasil!</strong>
                        <span class="block sm:inline">Password baru: <strong class="text-lg bg-white px-2 rounded border border-yellow-300">${newPassword}</strong></span>
                        <p class="text-xs mt-1">Harap catat dan berikan kepada user segera.</p>
                    </div>
                `;
                notifArea.classList.remove('hidden');
                // Hapus query param agar bersih jika di-refresh
                window.history.replaceState({}, document.title, window.location.pathname);
            }

            // --- Modal Functions ---
            function showModal() {
                adminPasswordInput.value = '';
                modalError.classList.add('hidden');
                modal.classList.remove('hidden');
                // Animation triggers
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
                }, 300);
            }

            if (resetPasswordBtn) {
                resetPasswordBtn.addEventListener('click', showModal);
            }
            if (cancelBtn) {
                cancelBtn.addEventListener('click', hideModal);
            }

            // Enter key trigger
            adminPasswordInput.addEventListener('keyup', function (e) {
                if (e.key === 'Enter') submitBtn.click();
            });

            // --- Submit Verifikasi & Reset ---
            submitBtn.addEventListener('click', async () => {
                const password = adminPasswordInput.value;
                if (!password) {
                    modalError.textContent = 'Password admin wajib diisi.';
                    modalError.classList.remove('hidden');
                    return;
                }

                modalError.classList.add('hidden');
                submitBtn.disabled = true;
                submitBtn.textContent = 'Memproses...';

                try {
                    // 1. Verifikasi Password Admin
                    const verifyResponse = await fetch('{{ route("password.verify") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ password: password })
                    });
                    const verifyResult = await verifyResponse.json();

                    if (verifyResult.verified) {
                        // 2. Jika verified, lakukan Reset Password User
                        resetUserPassword();
                    } else {
                        modalError.textContent = 'Password Admin salah.';
                        modalError.classList.remove('hidden');
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Konfirmasi Reset';
                    }
                } catch (error) {
                    console.error(error);
                    modalError.textContent = 'Terjadi kesalahan sistem.';
                    modalError.classList.remove('hidden');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Konfirmasi Reset';
                }
            });

            async function resetUserPassword() {
                try {
                    const response = await fetch('{{ route("users.reset-password", $user->id) }}', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    if (!response.ok) throw new Error('Gagal reset.');
                    const result = await response.json();

                    if (result.new_password) {
                        // Reload halaman dengan parameter password baru untuk ditampilkan
                        window.location.href = '{{ route("users.edit", $user->id) }}' + '?new_password=' + result.new_password;
                    } else {
                        alert('Gagal menerima password baru.');
                    }
                } catch (error) {
                    console.error(error);
                    alert('Gagal melakukan reset password.');
                    hideModal();
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Konfirmasi Reset';
                }
            }
        });
    </script>
</x-app-layout>