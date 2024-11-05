<?php

namespace App\Http\Controllers;

use App\Http\Requests\PendaftaranStoreRequest;
use App\Http\Requests\PendaftaranUpdateRequest;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PendaftaranController extends Controller
{
    public function index(Request $request): View
    {
        $pendaftarans = Pendaftaran::with('pasien')->orderBy('tglDaftar')->get();

        return view('dashboard.main-menu.pendaftaran.index', compact('pendaftarans'));
    }

    public function create(Request $request): View
    {
        $pasiens = Pasien::orderBy('nama')->get();

        return view('dashboard.main-menu.pendaftaran.create', compact('pasiens'));
    }

    public function store(PendaftaranStoreRequest $request): RedirectResponse
    {
        $pendaftaran = Pendaftaran::create($request->validated());

        return redirect()->route('kunjungan.index');
    }

    public function update(PendaftaranUpdateRequest $request, Pendaftaran $pendaftaran): RedirectResponse
    {
        $pendaftaran->save();

        return redirect()->route('kunjungan.index');
    }

    public function destroy(Request $request, Pendaftaran $pendaftaran): RedirectResponse
    {
        $pendaftaran->delete();

        return redirect()->route('kunjungan.index');
    }
}
