<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasienObatRequest;
use App\Models\PasienObat;
use Illuminate\Http\Request;

class PasienObatController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PasienObatRequest $request)
    {
        $resep = PasienObat::create($request->validated());

        return response()->json([
            'no' => $resep->id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PasienObat  $PasienObat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resep = PasienObat::find($id);

        $resep->delete();

        return response()->json(['success' => true]);
    }
}
