<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasienStoreRequest;
use App\Http\Requests\PasienUpdateRequest;
use App\Models\Pasien;
use App\Models\Kelurahan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PasienController extends Controller
{
    public function index(Request $request): View
    {
        $pasiens = Pasien::with('kelurahan')->orderByDesc('id')->get();

        return view('dashboard.main-menu.pasien.index', compact('pasiens'));
    }

    public function create(Request $request): View
    {
        $latestPasien = Pasien::orderBy('nomorRm', 'desc')->first();
        $nomorRm = $latestPasien ? str_pad($latestPasien->nomorRm + 1, 7, '0', STR_PAD_LEFT) : '20240001';

        // $kelurahans = Kelurahan::orderBy('KELURAHAN')->get();

        return view('dashboard.main-menu.pasien.create', compact('nomorRm'));
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
