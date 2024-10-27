<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasienStoreRequest;
use App\Http\Requests\PasienUpdateRequest;
use App\Models\Pasien;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PasienController extends Controller
{
    public function index(Request $request): View
    {
        $pasiens = Pasien::all();

        return view('pasien.index', compact('pasiens'));
    }

    public function store(PasienStoreRequest $request): RedirectResponse
    {
        $pasien = Pasien::create($request->validated());

        return redirect()->route('pasien.index');
    }

    public function update(PasienUpdateRequest $request, Pasien $pasien): RedirectResponse
    {
        $pasien->save();

        return redirect()->route('pasien.index');
    }

    public function destroy(Request $request, Pasien $pasien): RedirectResponse
    {
        $pasien->delete();

        return redirect()->route('pasien.index');
    }
}
