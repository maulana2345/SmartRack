<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('register', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user',
            'nama_pengguna' => 'required|string|max:255|unique:user',
            'password' => 'required|min:6|confirmed',
        ]);

        // Simpan user
        User::create([
            // 'name' => $validated['name'],
            'email' => $validated['email'],
            'nama_pengguna' => $validated['nama_pengguna'],
            'password' => Hash::make($validated['password']),
            'role' => 'user', // default
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
