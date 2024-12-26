<?php

namespace App\Http\Controllers;

use App\Http\Requests\PractitionerGroupStoreRequest;
use App\Http\Requests\PractitionerGroupUpdateRequest;
use App\Models\PractitionerGroup;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PractitionerGroupController extends Controller
{
    public function index(Request $request): View
    {
        $practitionerGroups = PractitionerGroup::all();

        return view('dashboard.master-data.practitioner-group.index', compact('practitionerGroups'));
    }

    public function store(PractitionerGroupStoreRequest $request): RedirectResponse
    {
        PractitionerGroup::create($request->validated());
        return redirect()->route('practitioner-group.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(PractitionerGroupUpdateRequest $request, PractitionerGroup $practitionerGroup): RedirectResponse
    {
        // Update data menggunakan data yang telah divalidasi
        $practitionerGroup->update($request->validated());

        return redirect()->route('practitioner-group.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Request $request, PractitionerGroup $practitionerGroup): RedirectResponse
    {
        $practitionerGroup->delete();

        return redirect()->route('practitioner-group.index')->with('success', 'Data berhasil dihapus.');
    }
}
