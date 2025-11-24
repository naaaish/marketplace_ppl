<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SellerRegistrationController extends Controller
{
    /**
     * Show a simple seller registration form.
     * (You can replace this view with a nicer one later.)
     */
    public function create()
    {
        return view('seller.register');
    }

    /**
     * Store seller (public flow) -- creates a User (password nullable)
     * and a Seller record with status 'pending'.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',

            'store_name' => 'required|string|max:255',
            'pic_name' => 'required|string|max:255',
            'pic_phone' => 'required|string',
            'pic_email' => 'required|email',
            'pic_address' => 'required|string',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'village' => 'nullable|string',
            'regency' => 'nullable|string',
            'province' => 'nullable|string',
            'pic_ktp_number' => 'nullable|string',
            'pic_photo' => 'nullable|image|max:2048',
            'pic_ktp_file' => 'nullable|image|max:2048',
        ]);

        // 1) Create the user with nullable password and role 'seller'
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => null,
            'role' => 'seller',
        ]);

        // 2) Store files if present
        $picPath = null;
        $ktpPath = null;
        if ($request->hasFile('pic_photo')) {
            $picPath = $request->file('pic_photo')->store('public/sellers/photos');
            $picPath = str_replace('public/', '', $picPath);
        }
        if ($request->hasFile('pic_ktp_file')) {
            $ktpPath = $request->file('pic_ktp_file')->store('public/sellers/ktp');
            $ktpPath = str_replace('public/', '', $ktpPath);
        }

        // 3) Create seller record
        $seller = Seller::create([
            'user_id' => $user->id,
            'store_name' => $data['store_name'],
            'store_description' => $request->input('store_description'),
            'pic_name' => $data['pic_name'],
            'pic_phone' => $data['pic_phone'],
            'pic_email' => $data['pic_email'],
            'pic_address' => $data['pic_address'],
            'rt' => $data['rt'] ?? null,
            'rw' => $data['rw'] ?? null,
            'village' => $data['village'] ?? null,
            'regency' => $data['regency'] ?? null,
            'province' => $data['province'] ?? null,
            'pic_ktp_number' => $data['pic_ktp_number'] ?? null,
            'pic_photo_path' => $picPath,
            'pic_ktp_file_path' => $ktpPath,
            'status' => 'pending',
        ]);

        // 4) Redirect to a 'thanks' page or to login with notice
        return redirect()->route('login')->with('status', 'Registrasi seller diterima. Menunggu verifikasi admin.');
    }
}
