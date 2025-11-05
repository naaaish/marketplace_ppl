<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman formulir login.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Memproses percobaan login.
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba login
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Jika berhasil
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        // 3. Jika gagal
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}