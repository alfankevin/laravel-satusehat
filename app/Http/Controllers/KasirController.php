<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index(Request $request): View
    {
        // Ambil kunjungan dengan status 'Pending' atau 'InProgress', diurutkan dari yang paling lama dibuat
        $pendaftarans = Pendaftaran::with('pasien')
        ->where('status', 0) // Menampilkan data dengan status = 0
        ->orderBy('created_at', 'asc')
        ->get();

        return view('dashboard.main-menu.kasir.index', compact('pendaftarans'));
    }

    public function bayar($id)
    {
        // Ambil kunjungan dengan status 'Pending' atau 'InProgress', diurutkan dari yang paling lama dibuat
        $pendaftarans = Pendaftaran::with('pasien')
        ->findOrFail($id);

        return view('dashboard.main-menu.kasir.bayar', compact('pendaftarans'));
    }
}
