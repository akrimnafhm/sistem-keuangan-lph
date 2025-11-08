<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Notifikasi untuk menampilkan password baru --}}
            @if(session('new_password_info'))
                <div class="mb-4 bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Password Reset!</strong>
                    <span class="block sm:inline">Password untuk user <span class="font-semibold">{{ session('new_password_info')['username'] }}</span> telah direset menjadi: <strong class="text-lg">{{ session('new_password_info')['password'] }}</strong></span>
                     <p class="text-xs mt-1">Harap catat password ini dan berikan kepada user.</p>
                </div>
            @endif
             @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif


            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900 dark:text-gray-100 relative"> 
                    
                    <div class="space-y-6">
                        {{-- Nama --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Nama</label>
                            <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $user->name }}</p>
                        </div>

                        {{-- Username --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Username (NIP/NIM)</label>
                            <p class="mt-1 text-lg text-gray-700 dark:text-gray-300">{{ $user->username }}</p>
                        </div>

                        {{-- Level --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Level</label>
                            <p class="mt-1 text-base text-gray-700 dark:text-gray-300">{{ ucfirst($user->level) }}</p>
                        </div>

                        {{-- Password (Tombol Reset) --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Password</label>
                            <div class="flex items-center mt-1">
                                <p id="password-display" class="text-base text-gray-700 dark:text-gray-300 mr-2 tracking-widest">********</p> 
                                <button type="button" id="reset-password-btn" title="Reset Password User (Membutuhkan Validasi)" class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-700 dark:hover:text-yellow-300">
                                    {{-- Ikon Kunci/Refresh --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Aksi di Bawah --}}
                    <div class="mt-8 border-t dark:border-gray-700 pt-6 flex items-center justify-start space-x-4">
                        <button type="button" id="edit-user-btn" data-url="{{ route('users.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Edit
                        </button>

                        <form id="delete-user-form" action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            @if(auth()->user()->id !== $user->id)
                                <button type="button" id="delete-user-btn" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    Hapus
                                </button>
                            @endif
                        </form>
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
        </div>
    </div>

    {{-- Script untuk Modal --}}
    <script>
        // ... (Semua variabel const di atasnya) ...
        const modal = document.getElementById('password-confirm-modal');
        const modalContent = document.getElementById('modal-content');
        const adminPasswordInput = document.getElementById('admin_password');
        const cancelBtn = document.getElementById('cancel-confirm-btn');
        const submitBtn = document.getElementById('submit-confirm-btn');
        const modalError = document.getElementById('modal-error');
        
        const editBtn = document.getElementById('edit-user-btn');
        const deleteBtn = document.getElementById('delete-user-btn'); 
        const resetPasswordBtn = document.getElementById('reset-password-btn'); 
        const deleteForm = document.getElementById('delete-user-form');
        
        let currentAction = null; 
        let actionUrl = '';     

        function showModal(action, url = '') {
            currentAction = action;
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
                 currentAction = null;
                 actionUrl = '';
            }, 300); 
        }

        cancelBtn.addEventListener('click', hideModal);

        // ==========================================================
        // === TAMBAHAN KODE UNTUK MEMBACA TOMBOL ENTER ADA DI SINI ===
        // ==========================================================
        adminPasswordInput.addEventListener('keyup', function(event) {
            // Cek jika tombol yang ditekan adalah 'Enter' (keyCode 13)
            if (event.key === 'Enter' || event.keyCode === 13) {
                event.preventDefault(); // Mencegah aksi default (seperti submit form jika ada)
                submitBtn.click(); // Memicu klik pada tombol "Konfirmasi"
            }
        });
        // ==========================================================


        if (editBtn) {
            editBtn.addEventListener('click', (e) => { 
                e.preventDefault(); 
                showModal('edit', editBtn.dataset.url);
            });
        }
        if (deleteBtn) {
             deleteBtn.addEventListener('click', (e) => { 
                e.preventDefault(); 
                showModal('delete'); 
             });
        }
        if (resetPasswordBtn) { 
            resetPasswordBtn.addEventListener('click', () => {
                showModal('reset_password'); 
            });
        }

        submitBtn.addEventListener('click', async () => {
            // ... (Fungsi 'submitBtn.addEventListener' tetap sama persis seperti sebelumnya) ...
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
                    if (currentAction === 'edit') {
                        window.location.href = actionUrl; 
                    } else if (currentAction === 'delete') {
                        if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
                            deleteForm.submit(); 
                        }
                    } else if (currentAction === 'reset_password') { 
                        resetUserPassword(); 
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

        async function resetUserPassword() {
            // ... (Fungsi 'resetUserPassword' tetap sama persis seperti sebelumnya) ...
            try {
                 const response = await fetch('{{ route("users.reset-password", $user->id) }}', { 
                    method: 'POST', 
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                    }
                });

                if (!response.ok) { 
                    throw new Error('Gagal mereset password.');
                }

                const result = await response.json();

                if (result.new_password) {
                    window.location.href = '{{ route("users.show", $user->id) }}' + '?new_password=' + result.new_password + '&username=' + '{{ $user->username }}'; // Reload halaman dengan parameter
                } else {
                     alert('Gagal mendapatkan password baru dari server.'); 
                }

            } catch (error) {
                 console.error('Error resetting password:', error); 
                 alert('Terjadi kesalahan saat mereset password.'); 
            }
        }

        // ... (Kode untuk menampilkan notifikasi password baru tetap sama) ...
        const urlParams = new URLSearchParams(window.location.search);
        const newPassword = urlParams.get('new_password');
        const usernameForPassword = urlParams.get('username');

        if (newPassword && usernameForPassword) {
            const notificationDiv = document.createElement('div');
            notificationDiv.className = 'mb-4 bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 rounded relative';
            notificationDiv.setAttribute('role', 'alert');
            
            const strongTag = document.createElement('strong');
            strongTag.className = 'font-bold';
            strongTag.textContent = 'Password Reset!';
            
            const spanTag = document.createElement('span');
            spanTag.className = 'block sm:inline';
            spanTag.innerHTML = ` Password untuk user <span class="font-semibold">${usernameForPassword}</span> telah direset menjadi: <strong class="text-lg">${newPassword}</strong>`;

            const pTag = document.createElement('p');
            pTag.className = 'text-xs mt-1';
            pTag.textContent = 'Harap catat password ini dan berikan kepada user.';

            notificationDiv.appendChild(strongTag);
            notificationDiv.appendChild(spanTag);
            notificationDiv.appendChild(pTag);

            const mainContentContainer = document.querySelector('.max-w-7xl.mx-auto'); 
            if (mainContentContainer) {
                 mainContentContainer.parentNode.insertBefore(notificationDiv, mainContentContainer);
            }

             window.history.replaceState({}, document.title, window.location.pathname);
        }
    </script>
</x-app-layout>