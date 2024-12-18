<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasienDiagnosaRequest;
use App\Models\PasienDiagnosa;
use App\Models\Kunjungan;
use App\Models\Diagnosa;
use Illuminate\Http\Request;

class PasienDiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diagnosas = PasienDiagnosa::with('diagnosa', 'kunjungan')->get();
        $allDiagnosas = Diagnosa::all(); // For the create modal
        return view('dashboard.rekam-medis.index', compact('diagnosas', 'allDiagnosas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PasienDiagnosaRequest $request)
    {
        $diagnosa = PasienDiagnosa::create($request->validated());

        return response()->json([
            'no' => $diagnosa->id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $diagnosa = PasienDiagnosa::find($id);

        $diagnosa->delete();

        return response()->json(['success' => true]);
    }
}
