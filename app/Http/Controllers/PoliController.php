<?php

namespace App\Http\Controllers;

use App\Http\Requests\PoliStoreRequest;
use App\Http\Requests\PoliUpdateRequest;
use App\Models\Poli;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PoliController extends Controller
{
    public function index(Request $request): View
    {
        $polis = Poli::all();
        // dd($polis);
        return view('dashboard.master-data.poli.index', compact('polis'));
    }

    public function store(PoliStoreRequest $request): RedirectResponse
    {
        $poli = Poli::create($request->validated());
        // dd($poli);
        return redirect()->route('poli.index')->with('success', 'Data berhasil disimpan!');
    }

    public function update(PoliUpdateRequest $request, $id): RedirectResponse
    {
        $poli = Poli::findOrFail($id); 

        $poli->update($request->only(['kodePoli', 'namaPoli']));

        return redirect()->route('poli.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy(Request $request, Poli $poli): RedirectResponse
    {
        $poli->delete();

        return redirect()->route('poli.index')->with('success', 'Data berhasil dihapus!');
    }
}
