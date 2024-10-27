<?php

namespace App\Http\Controllers;

use App\Http\Requests\PractitionerStoreRequest;
use App\Http\Requests\PractitionerUpdateRequest;
use App\Models\Practitioner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PractitionerController extends Controller
{
    public function index(Request $request): View
    {
        $practitioners = Practitioner::all();

        return view('practitioner.index', compact('practitioners'));
    }

    public function store(PractitionerStoreRequest $request): RedirectResponse
    {
        $practitioner = Practitioner::create($request->validated());

        return redirect()->route('practitioner.index');
    }

    public function update(PractitionerUpdateRequest $request, Practitioner $practitioner): RedirectResponse
    {
        $practitioner->save();

        return redirect()->route('practitioner.index');
    }

    public function destroy(Request $request, Practitioner $practitioner): RedirectResponse
    {
        $practitioner->delete();

        return redirect()->route('practitioner.index');
    }
}
