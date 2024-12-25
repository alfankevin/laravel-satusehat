<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObatStoreRequest;
use App\Http\Requests\ObatUpdateRequest;
use App\Models\Obat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ObatController extends Controller
{
    public function index(Request $request): View
    {
        $obats = Obat::orderByDesc('id')->get();

        return view('dashboard.master-data.obat.index', compact('obats'));
    }

    public function store(ObatStoreRequest $request): RedirectResponse
    {
        $obat = Obat::create($request->validated());

        return redirect()->route('obat.index');
    }

    public function update(ObatUpdateRequest $request, Obat $obat): RedirectResponse
    {
        $obat = Obat::where('id', $obat->id)->update($request->validated());

        return redirect()->route('obat.index');
    }

    public function storeOrUpdate(Request $request): RedirectResponse
    {
        $data = $request->all();

        if ($request->id) {
            // Update existing data
            $obat = Obat::findOrFail($request->id);
            $obat->update($data);
        } else {
            // Create new data
            Obat::create($data);
        }

        return redirect()->route('obat.index')->with('success', 'Data berhasil disimpan!');
    }

    public function destroy(Obat $obat): RedirectResponse
    {
        $obat->delete();

        return redirect()->route('obat.index');
    }
}
