<?php

namespace App\Http\Controllers;


use App\Http\Requests\PasienPemeriksaanRequest;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;

class PasienPemeriksaanController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(PasienPemeriksaanRequest $request)
    {
        $pemeriksaan = Pemeriksaan::create($request->validated());

        return response()->json([
            'no' => $pemeriksaan->id,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pemeriksaan = Pemeriksaan::find($id);

        $pemeriksaan->delete();

        return response()->json(['success' => true]);
    }
}
