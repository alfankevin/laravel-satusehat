<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasienTindakanRequest;
use App\Models\PasienTindakan;
use App\Models\Tindakan;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class PasienTindakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tindakans = PasienTindakan::with('tindakan', 'kunjungan')->get();
        $allTindakans = Tindakan::all(); // For the create modal
        return view('dashboard.rekam-medis.index', compact('tindakans', 'allTindakans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PasienTindakanRequest $request)
    {
        $tindakan = PasienTindakan::create($request->validated());

        return response()->json([
            'no' => $tindakan->id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tindakan = PasienTindakan::find($id);

        $tindakan->delete();

        return response()->json(['success' => true]);
    }
}
