<?php

namespace App\Http\Controllers;

use App\Models\KategoriPemeriksaan;
use Illuminate\Http\Request;

class LaboratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laborats = KategoriPemeriksaan::all();
        return view('dashboard.master-data.laborat.index', compact('laborats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pemeriksaan' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'nilai_normal' => 'required|string|max:255',
            'biaya' => 'required|numeric|min:0',
        ]);

        KategoriPemeriksaan::create($validated);
        return redirect()->route('laborat.index')->with('success', 'Pemeriksaan berhasil ditambahkan');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriPemeriksaan $laborat)
    {
        $validated = $request->validate([
            'pemeriksaan' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
            'nilai_normal' => 'required|string|max:255',
            'biaya' => 'required|numeric|min:0',
        ]);

        $laborat->update($validated);
        return redirect()->route('laborat.index')->with('success', 'Pemeriksaan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriPemeriksaan $laborat)
    {
        $laborat->delete();
        return redirect()->route('laborat.index')->with('success', 'Pemeriksaan berhasil dihapus');
    }
}
