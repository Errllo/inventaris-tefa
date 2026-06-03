<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;

class barangcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = barang::all();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori_barang' => 'required',
            'stok' => 'required|integer',
        ]);

        barang::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $barang = barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori_barang' => 'required',
            'stok' => 'required|integer',
        ]);

        $barang = barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang dihapus.');
    }
}
