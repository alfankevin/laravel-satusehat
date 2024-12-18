<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data diagnosa
        $diagnosas = Diagnosa::all();
        return view('dashboard.diagnosa.index', compact('diagnosas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form create diagnosa
        return view('diagnosa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'kode' => 'required|string|max:255',
            'diagnosa' => 'required|string|max:255',
        ]);

        // Menyimpan data diagnosa baru
        Diagnosa::create($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('diagnosa.index')->with('success', 'Diagnosa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Diagnosa $diagnosa)
    {
        // Menampilkan detail diagnosa
        return view('diagnosa.show', compact('diagnosa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diagnosa $diagnosa)
    {
        // Menampilkan form edit diagnosa
        return view('diagnosa.edit', compact('diagnosa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diagnosa $diagnosa)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'kode' => 'required|string|max:255',
            'diagnosa' => 'required|string|max:255',
        ]);

        // Mengupdate data diagnosa
        $diagnosa->update($validatedData);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('diagnosa.index')->with('success', 'Diagnosa berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diagnosa $diagnosa)
    {
        // Menghapus diagnosa
        $diagnosa->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('diagnosa.index')->with('success', 'Diagnosa berhasil dihapus.');
    }
}
