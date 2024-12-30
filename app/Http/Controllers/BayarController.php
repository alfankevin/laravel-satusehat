<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use Illuminate\Http\Request;

class BayarController extends Controller
{
    /**
     * Store a newly created payment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kunjungan_id' => 'required|exists:pendaftarans,id',
            'total_tagihan' => 'required|numeric|min:0',
            'jumlah_bayar' => 'required|numeric|min:0',
            'kembalian' => 'required|numeric|min:0',
        ]);

        try {
            $bayar = Bayar::create([
                'kunjungan_id' => $request->kunjungan_id,
                'total_tagihan' => $request->total_tagihan,
                'jumlah_bayar' => $request->jumlah_bayar,
                'kembalian' => $request->kembalian,
            ]);

            return redirect()->back()->with('success', 'Pembayaran berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan pembayaran: ' . $e->getMessage());
        }
    }
}
