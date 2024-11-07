<?php

namespace App\Http\Controllers;

use App\Http\Requests\PemeriksaanStoreRequest;
use App\Http\Requests\PemeriksaanUpdateRequest;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PemeriksaanController extends Controller
{
    public function index(Request $request): View
    {
        $pendaftarans = Pendaftaran::with('pasien')->orderBy('tglDaftar')->get();

        return view('dashboard.main-menu.antrian.index', compact('pendaftarans'));
    }

    public function create(Request $request, $id): View
    {
        $pemeriksaan = Pendaftaran::with('pasien', 'poli')->where('id', $id)->first();

        return view('dashboard.main-menu.antrian.pemeriksaan', compact('pemeriksaan'));
    }

    public function store(PemeriksaanStoreRequest $request): RedirectResponse
    {
        $pendaftaran = Pendaftaran::where('id', $request->input('id'))->update($request->validated());

        return redirect()->route('antrian.index');
    }

    public function update(PendaftaranUpdateRequest $request, Pendaftaran $pendaftaran): RedirectResponse
    {
        $pendaftaran->save();

        return redirect()->route('antrian.index');
    }

    public function destroy(Request $request, Pendaftaran $pendaftaran): RedirectResponse
    {
        $pendaftaran->delete();

        return redirect()->route('antrian.index');
    }
}
