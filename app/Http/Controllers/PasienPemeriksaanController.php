<?php

namespace App\Http\Controllers;


use App\Http\Requests\PasienPemeriksaanRequest;
use App\Models\PasienPemeriksaan;
use Illuminate\Http\Request;

class PasienPemeriksaanController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(PasienPemeriksaanRequest $request)
    {
        $pemeriksaan = PasienPemeriksaan::create($request->validated());

        return response()->json([
            'no' => $pemeriksaan->id,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pemeriksaan = PasienPemeriksaan::find($id);

        $pemeriksaan->delete();

        return response()->json(['success' => true]);
    }
}
