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

        return view('practitionerGroup.index', compact('practitionerGroups'));
    }

    public function store(PractitionerGroupStoreRequest $request): RedirectResponse
    {
        $practitionerGroup = PractitionerGroup::create($request->validated());

        return redirect()->route('practitionerGroup.index');
    }

    public function update(PractitionerGroupUpdateRequest $request, PractitionerGroup $practitionerGroup): RedirectResponse
    {
        $practitionerGroup->save();

        return redirect()->route('practitionerGroup.index');
    }

    public function destroy(Request $request, PractitionerGroup $practitionerGroup): RedirectResponse
    {
        $practitionerGroup->delete();

        return redirect()->route('practitionerGroup.index');
    }
}
