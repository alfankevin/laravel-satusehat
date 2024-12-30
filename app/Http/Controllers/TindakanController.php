<?php

namespace App\Http\Controllers;

use App\Exports\TindakanExport;
use App\Models\Tindakan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TindakanImport;

class TindakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tindakans = Tindakan::all();
        return view('dashboard.master-data.tindakan.index', compact('tindakans'));
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

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048', // Validasi file
        ]);

        // Proses import menggunakan class Import
        Excel::import(new TindakanImport, $request->file('file'));

        return redirect()->route('tindakan.index')->with('success', 'Data berhasil diimport.');
    }

    public function export()
    {
        session()->flash('success', 'Data berhasil diekspor.');
        return Excel::download(new TindakanExport, 'data_tindakan.xlsx');
    }
    
}
