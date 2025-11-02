<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Menampilkan halaman daftar semua user.
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->oldest()->get();
        return view('users.index', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat user baru.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Menyimpan user baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'level' => ['required', 'string', Rule::in(['admin', 'user'])],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()], // Gunakan rules default
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'level' => $request->level,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')
                         ->with('success', 'User baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail spesifik dari satu User.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Menampilkan form untuk mengedit data user.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Memperbarui data user (nama & level saja) di database.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Username tidak bisa diedit, tidak perlu divalidasi
            'level' => ['required', 'string', Rule::in(['admin', 'user'])],
        ]);

        // Update hanya nama dan level
        $user->name = $request->name;
        $user->level = $request->level;
        $user->save();

        return redirect()->route('users.index')
                         ->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Mereset password user dan mengembalikan password baru.
     */
    public function resetPassword(User $user)
    {
        // Generate password acak 8 karakter (huruf & angka)
        $newPassword = Str::random(8);

        // Update password user di database dengan hash dari password baru
        $user->password = Hash::make($newPassword);
        $user->save();

        // Kembalikan password baru (plaintext) dalam response JSON
        return response()->json(['new_password' => $newPassword]);
    }


    /**
     * Menghapus user dari database.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                             ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }
        $user->delete();
        return redirect()->route('users.index')
                         ->with('success', 'User berhasil dihapus.');
    }
}