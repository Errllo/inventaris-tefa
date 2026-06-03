<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authcontroller extends Controller
{
    // 1. Menampilkan halaman form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // 2. Memproses data login dari form
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('barang.index')->with('sukses', 'Selamat datang kembali!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ])->withInput();
    }

    // 3. Memproses logout / keluar aplikasi
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('sukses', 'Berhasil keluar aplikasi.');
    }
}
