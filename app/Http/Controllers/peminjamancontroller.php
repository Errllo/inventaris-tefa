<?php

namespace App\Http\Controllers;

use App\Models\peminjam;
use App\Models\barang;
use App\Models\peminjaman;
use Illuminate\Http\Request;

class peminjamancontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = peminjaman::with(['barang', 'peminjam'])->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $peminjam = peminjam::all();
        $barang = barang::all();
        return view('peminjaman.create', compact('peminjam', 'barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'peminjam_id' => 'required',
            'barang_id' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'jumlah_pinjam' => 'required|numeric|min:1',
            'status_peminjaman' => 'required'
        ]);

        // 1. Simpan transaksi riwayat peminjaman terlebih dahulu
        peminjaman::create($request->all());

        // 2. Potong stok menggunakan Model 'barang' jika statusnya dipinjam
        if ($request->status_peminjaman == 'dipinjam') {
            barang::where('id', $request->barang_id)->decrement('stok', $request->jumlah_pinjam);
        }

        return redirect()->route('peminjaman.index')->with('sukses', 'Peminjaman berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Kosong
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $peminjaman = peminjaman::findOrFail($id);
        $peminjam = peminjam::all();
        $barang = barang::all();
        return view('peminjaman.edit', compact('peminjaman', 'peminjam', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'peminjam_id' => 'required',
            'barang_id' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'jumlah_pinjam' => 'required|numeric|min:1',
            'status_peminjaman' => 'required'
        ]);

        $peminjaman = peminjaman::findOrFail($id);
        $statusLama = $peminjaman->status_peminjaman;

        if ($statusLama == 'dipinjam' && $request->status_peminjaman == 'dikembalikan') {
            barang::where('id', $request->barang_id)->increment('stok', $peminjaman->jumlah_pinjam);
        }
        elseif ($statusLama == 'dikembalikan' && $request->status_peminjaman == 'dipinjam') {
            barang::where('id', $request->barang_id)->decrement('stok', $request->jumlah_pinjam);
        }

        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index')->with('sukses', 'Status diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peminjaman = peminjaman::findOrFail($id);

        if ($peminjaman->status_peminjaman == 'dipinjam') {
            barang::where('id', $peminjaman->barang_id)->increment('stok', $peminjaman->jumlah_pinjam);
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('sukses', 'Peminjaman dihapus.');
    }
}
