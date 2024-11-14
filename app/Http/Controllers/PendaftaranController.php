<?php

namespace App\Http\Controllers;

use App\Http\Requests\PendaftaranStoreRequest;
use App\Http\Requests\PendaftaranUpdateRequest;
use App\Models\Poli;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Practitioner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PendaftaranController extends Controller
{
    public function index(Request $request): View
    {
        $pendaftarans = Pendaftaran::with('pasien', 'poli', 'practitioner')->orderBy('tglDaftar')->get();

        return view('dashboard.main-menu.pendaftaran.index', compact('pendaftarans'));
    }

    public function create(Request $request): View
    {
        $polis = Poli::orderBy('namaPoli')->get();
        $pasiens = Pasien::orderBy('nama')->get();
        $practitioners = Practitioner::orderBy('namaPractitioner')->get();

        return view('dashboard.main-menu.pendaftaran.create', compact('polis', 'pasiens', 'practitioners'));
    }

    public function store(PendaftaranStoreRequest $request): RedirectResponse
    {
        $pendaftaran = Pendaftaran::create($request->validated());

        return redirect()->route('pendaftaran.index');
    }

    public function update(PendaftaranUpdateRequest $request, Pendaftaran $pendaftaran): RedirectResponse
    {
        $pendaftaran->save();

        return redirect()->route('pendaftaran.index');
    }

    public function destroy(Request $request, Pendaftaran $pendaftaran): RedirectResponse
    {
        $pendaftaran->delete();

        return redirect()->route('pendaftaran.index');
    }
}
