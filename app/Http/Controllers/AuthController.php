<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // 1. Tampilkan Halaman Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // 2. Proses Login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // --- FIX ERROR MERAH DI USER ---
            // Kita kasih tahu VS Code kalau $user ini adalah model App\Models\User
            /** @var \App\Models\User $user */
            $user = Auth::user();

            // A. Jika Login sebagai ADMIN
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // B. Jika Login sebagai SELLER (PENJUAL)
            if ($user->role === 'seller') {
                // Cek status di tabel sellers
                // Gunakan tanda tanya (?) biar gak error kalau data seller hilang
                $status = $user->seller?->status;

                if ($status === 'pending') {
                    Auth::logout();
                    return back()->withErrors(['email' => 'Akun Anda sedang diverifikasi Admin. Silakan tunggu email konfirmasi.']);
                }

                if ($status === 'rejected') {
                    Auth::logout();
                    return back()->withErrors(['email' => 'Maaf, pendaftaran toko Anda ditolak.']);
                }
            }

            // C. Jika Buyer atau Seller Aktif -> Masuk Dashboard Utama
            return redirect()->intended('/dashboard');
        }

        // Jika Email/Password Salah
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // 3. Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // 4. Halaman Aktivasi (Set Password) dari Link Email
    public function showActivationForm($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();
        return view('auth.activate-account', compact('token', 'user'));
    }

    // 5. Proses Simpan Password Baru
    public function activate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8|confirmed', // Pastikan di view ada name="password_confirmation"
        ]);

        $user = User::where('activation_token', $request->token)->firstOrFail();

        // Update User
        $user->update([
            'password' => Hash::make($request->password),
            'activation_token' => null, // Token hangus setelah dipakai
            'email_verified_at' => now(),
        ]);

        // Pastikan status seller jadi active (double check)
        if ($user->seller) {
            $user->seller->update(['status' => 'active']);
        }

        // Langsung login otomatis
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Akun berhasil diaktifkan!');
    }
}