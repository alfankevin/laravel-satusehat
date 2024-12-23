<?php

namespace App\Http\Controllers;

use App\Models\Tindakan;
use Illuminate\Http\Request;

class TindakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tindakans = Tindakan::all();
        return view('dashboard.tindakan.index', compact('tindakans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tindakan' => 'required|string|max:255',
            'biaya' => 'required|numeric|min:0',
        ]);

        Tindakan::create($validated);
        return redirect()->route('tindakan.index')->with('success', 'Tindakan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tindakan $tindakan)
    {
        return response()->json($tindakan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tindakan $tindakan)
    {
        $validated = $request->validate([
            'tindakan' => 'required|string|max:255',
            'biaya' => 'required|numeric|min:0',
        ]);

        $tindakan->update($validated);
        return redirect()->route('tindakan.index')->with('success', 'Tindakan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tindakan $tindakan)
    {
        $tindakan->delete();
        return redirect()->route('tindakan.index')->with('success', 'Tindakan berhasil dihapus');
    }
}