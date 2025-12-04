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
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            /** @var \App\Models\User $user */
            $user = Auth::user();

            // A. Admin
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // B. Seller
            if ($user->role === 'seller') {
                $status = $user->seller?->status;

                if ($status === 'pending') {
                    Auth::logout();
                    return back()->withErrors(['email' => 'Akun sedang diverifikasi Admin.']);
                }

                if ($status === 'rejected') {
                    Auth::logout();
                    return back()->withErrors(['email' => 'Maaf, pendaftaran toko Anda ditolak.']);
                }
            }

            // C. Buyer / Active Seller
            return redirect()->intended('/dashboard');
        }

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

    // 4. Halaman Aktivasi 
    public function showActivationForm($token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            // Jika token tidak ditemukan (sudah dipakai / salah)
            return redirect()->route('login')->with('error', 'Link aktivasi tidak valid atau sudah kadaluarsa.');
        }

        return view('auth.activate-account', compact('token', 'user'));
    }

    // 5. Proses Simpan Password Baru
    public function activate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('activation_token', $request->token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Token tidak valid.');
        }

        // Update User
        $user->update([
            'password' => Hash::make($request->password),
            'activation_token' => null, // Token hangus
            'email_verified_at' => now(),
        ]);

        if ($user->seller) {
            $user->seller->update(['status' => 'active']);
        }

        return redirect()->route('login')->with('success', 'Password berhasil dibuat! Silakan login.');
    }
}