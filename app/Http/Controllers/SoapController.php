<?php

namespace App\Http\Controllers;

use App\Models\Soap;
use App\Models\Pasien;
use App\Http\Requests\SoapStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SoapController extends Controller
{
    public function index(Request $request): View
    {
        $soaps = Soap::all();

        return view('dashboard.main-menu.soap.index', compact('soaps'));
    }

    public function create(Request $request): View
    {
        $soap = Soap::create($request->validated());

        return view('dashboard.main-menu.Soap.create', compact('nomorRm'));
    }

    public function store(SoapStoreRequest $request): RedirectResponse
    {
        $soap = Soap::create($request->validated());

        return redirect()->route('soap.index');
    }

    public function update(SoapUpdateRequest $request, Soap $soap): RedirectResponse
    {
        $soap->save();

        return redirect()->route('soap.index');
    }

    public function destroy(Request $request, Soap $soap): RedirectResponse
    {
        $soap->delete();

        return redirect()->route('soap.index');
    }
}
