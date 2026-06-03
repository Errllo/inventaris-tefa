<?php

use App\Http\Controllers\authcontroller;
use App\Http\Controllers\barangcontroller;
use App\Http\Controllers\peminjamcontroller; // <-- Pastikan ini dipanggil di atas
use App\Http\Controllers\peminjamancontroller;
use Illuminate\Support\Facades\Route;

// --- RUTE LOGIN BIASA ---
Route::get('/', [authcontroller::class, 'showLogin'])->name('login');
Route::post('/login', [authcontroller::class, 'login'])->name('login.proses');


// --- Halaman yang HANYA bisa dibuka kalau SUDAH login ---
Route::middleware('auth')->group(function () {
    Route::post('/logout', [authcontroller::class, 'logout'])->name('logout');

    // Tiga serangkai Resource Controller kamu:
    Route::resource('barang', barangcontroller::class);
    Route::resource('peminjam', peminjamcontroller::class); // <-- Daftarkan ini sebagai resource
    Route::resource('peminjaman', peminjamancontroller::class);
});
