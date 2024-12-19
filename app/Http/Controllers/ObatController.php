<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObatStoreRequest;
use App\Http\Requests\ObatUpdateRequest;
use App\Models\Obat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ObatController extends Controller
{
    public function index(Request $request): View
    {
        $obats = Obat::orderByDesc('id')->get();

        return view('dashboard.obat.index', compact('obats'));
    }

    public function store(ObatStoreRequest $request): RedirectResponse
    {
        $obat = Obat::create($request->validated());

        return redirect()->route('obat.index');
    }

    public function update(ObatUpdateRequest $request, Obat $obat): RedirectResponse
    {
        $obat->save();

        return redirect()->route('obat.index');
    }

    public function destroy(Request $request, Obat $obat): RedirectResponse
    {
        $obat = Obat::find($id);

        $obat->delete();

        return redirect()->route('dashboard.obat');
    }
}