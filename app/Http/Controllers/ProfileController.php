<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman edit profil.
     */
    public function edit(Request $request)
    {
        // Anda perlu membuat view ini
        return view('profile.edit', [
            'user' => $request->user()
        ]);
    }

    /**
     * Meng-update profil pengguna.
     */
    public function update(Request $request)
    {
        // Validasi sederhana (hanya nama)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $request->user()->update([
            'name' => $request->name,
        ]);

        return back()->with('status', 'Profile updated!');
    }

    /**
     * Menghapus akun pengguna.
     */
    public function destroy(Request $request)
    {
        // Anda bisa tambahkan logika hapus akun di sini
        // ...

        return redirect('/');
    }
}