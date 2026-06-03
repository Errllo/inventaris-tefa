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

        // 2. Potong stok jika statusnya 'dipinjam' ATAU 'terlambat' (karena barang sama-sama keluar dari lab)
        if ($request->status_peminjaman == 'dipinjam' || $request->status_peminjaman == 'terlambat') {
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
            'tanggal_kembali' => 'nullable|date',
            'jumlah_pinjam' => 'required|numeric|min:1',
            'status_peminjaman' => 'required'
        ]);

        $peminjaman = peminjaman::findOrFail($id);
        $statusLama = $peminjaman->status_peminjaman;

        // KONDISI A: Dari belum kembali (dipinjam/terlambat) menjadi dikembalikan
        // Stok di lab bertambah kembali karena barang dipulangkan siswa
        if (($statusLama == 'dipinjam' || $statusLama == 'terlambat') && $request->status_peminjaman == 'dikembalikan') {
            barang::where('id', $request->barang_id)->increment('stok', $peminjaman->jumlah_pinjam);
        }
        // KONDISI B: Dari sudah kembali diubah menjadi belum kembali (dipinjam/terlambat)
        // Stok di lab harus dikurangi lagi karena barang dibawa keluar lagi oleh siswa
        elseif ($statusLama == 'dikembalikan' && ($request->status_peminjaman == 'dipinjam' || $request->status_peminjaman == 'terlambat')) {
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

        // Jika riwayat yang dihapus statusnya masih 'dipinjam' atau 'terlambat',
        // pulihkan jumlah stok barang tersebut ke database lab
        if ($peminjaman->status_peminjaman == 'dipinjam' || $peminjaman->status_peminjaman == 'terlambat') {
            barang::where('id', $peminjaman->barang_id)->increment('stok', $peminjaman->jumlah_pinjam);
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('sukses', 'Peminjaman dihapus.');
    }
}
