<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Practitioner;
use Illuminate\Http\Request;
use App\Models\PractitionerGroup;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PractitionerStoreRequest;
use App\Http\Requests\PractitionerUpdateRequest;

class PractitionerController extends Controller
{
    public function index(Request $request): View
    {
        $practitioners = Practitioner::all();
        
        return view('dashboard.master-data.practitioner.index', compact('practitioners'));
    }

    public function store(PractitionerStoreRequest $request): RedirectResponse
    {
        $practitioner = Practitioner::create($request->validated());
        return redirect()->route('practitioner.index')->with('success', 'Data practitioner berhasil ditambahkan.');
    }

    public function update(PractitionerUpdateRequest $request, Practitioner $practitioner): RedirectResponse
    {
        // Menggunakan data yang divalidasi dari request untuk mengupdate objek practitioner
        $practitioner->update($request->validated());

        return redirect()->route('practitioner.index')->with('success', 'Data practitioner berhasil diperbarui.');
    }

    public function destroy(Request $request, Practitioner $practitioner): RedirectResponse
    {
        $practitioner->delete();

        return redirect()->route('practitioner.index')->with('success', 'Data practitioner berhasil dihapus.');
    }
}
