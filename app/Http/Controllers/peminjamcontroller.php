<?php

namespace App\Http\Controllers;

use App\Models\peminjam;
use Illuminate\Http\Request;

class peminjamcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjam = peminjam::all();
        return view('peminjam.index', compact('peminjam'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
