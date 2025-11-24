<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. Tampilkan Halaman Login
    public function showLogin() {
        // Pastikan file view ini ada di resources/views/auth/login.blade.php
        return view('auth.login'); 
    }

    // 2. Proses Login
    public function login(Request $request) {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email', 
            'password' => 'required'
        ]);
        
        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // 3. Proses Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // 4. Form Aktivasi (Password Baru)
    public function showActivationForm($token) {
        $user = User::where('activation_token', $token)->firstOrFail();
        return view('auth.activate', compact('token', 'user'));
    }

    // 5. Proses Simpan Password Baru
    public function activate(Request $request) {
        $request->validate([
            'password' => 'required|min:6', // Minimal 6 karakter
            'token' => 'required'
        ]);
        
        $user = User::where('activation_token', $request->token)->first();
        
        if (!$user) {
            return redirect('/login')->with('error', 'Token tidak valid.');
        }

        // Update password & hapus token
        $user->update([
            'password' => Hash::make($request->password),
            'activation_token' => null,
            'email_verified_at' => now() // Tandai email sudah diverifikasi
        ]);

        return redirect('/login')->with('success', 'Password berhasil dibuat. Silakan Login.');
    }
}