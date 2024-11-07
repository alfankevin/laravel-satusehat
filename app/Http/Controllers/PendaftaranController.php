<?php

namespace App\Http\Controllers;

use App\Http\Requests\PendaftaranStoreRequest;
use App\Http\Requests\PendaftaranUpdateRequest;
use App\Models\Pendaftaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PendaftaranController extends Controller
{
    public function index(Request $request): View
    {
        $pendaftarans = Pendaftaran::all();

        return view('pendaftaran.index', compact('pendaftarans'));
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
