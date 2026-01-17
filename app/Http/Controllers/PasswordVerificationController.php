<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordVerificationController extends Controller
{
    /**
     * Verifikasi password admin saat ini via AJAX.
     */
    public function verify(Request $request)
    {
        // Validasi input password dari modal
        $request->validate(['password' => 'required|string']);

        // Dapatkan user admin yang sedang login
        $user = Auth::user();

        // Cek apakah password yang dimasukkan cocok dengan hash di database
        if (Hash::check($request->password, $user->password)) {
            // Password cocok: tandai waktu konfirmasi pada session agar middleware 'password.confirm' menerima
            $request->session()->put('auth.password_confirmed_at', time());

            // Kirim response JSON sukses
            return response()->json(['verified' => true]);
        }

        // Password salah, kirim response JSON gagal
        return response()->json(['verified' => false]);
    }
}
