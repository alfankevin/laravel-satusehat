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
        $pasiens = Pasien::with('kelurahan.kecamatan')->orderByDesc('id')->get();

        return view('dashboard.main-menu.pasien.index', compact('pasiens'));
    }


    public function create(Request $request): View
    {
        $kelurahans = Kelurahan::with('kecamatan')->get();
        // $kelurahans = Kelurahan::orderBy('KELURAHAN')->get();
        $latestPasien = Pasien::orderBy('nomorRm', 'desc')->first();
        $nomorRm = $latestPasien->nomorRm + 1;


        return view('dashboard.main-menu.pasien.create', compact('nomorRm', 'kelurahans'));
    }

    public function store(PasienStoreRequest $request): RedirectResponse
    {
        $pasien = Pasien::create($request->validated());

        // Simpan data pasien ke session
        session()->flash('newPasien', [
            'id' => $pasien->id,
            'nama' => $pasien->nama,
            'nomorRm' => $pasien->nomorRm,
        ]);

        return redirect()->route('kunjungan.index')
            ->with('success', 'Pasien berhasil ditambahkan, silakan tambah kunjungan.');
    }



    public function update(PasienUpdateRequest $request, Pasien $pasien): RedirectResponse
    {
        $pasien->save();

        return redirect()->route('pasien.index');
    }

    public function destroy(Request $request, Pasien $pasien): RedirectResponse
    {
        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Delete Pasien Successfully!');
    }
}
