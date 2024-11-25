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
        
        // dd($groups);
        return view('dashboard.master-data.practitioner.index', compact('practitioners'));
    }

    public function store(PractitionerStoreRequest $request): RedirectResponse
    {
        $practitioner = Practitioner::create($request->validated());
        // dd($practitioner);
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
