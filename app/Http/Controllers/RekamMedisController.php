<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use Illuminate\View\View;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index(Request $request): View
    {
        $pasienId = $request->input('pasien_id');
    
        // Ambil semua pasien untuk modal
        $pasiens = Pasien::with('kelurahan.kecamatan')->orderByDesc('id')->get();
    
        // Default data pasien dan rekam medis
        $selectedPasien = null;
        $rekamMedis = [];
    
        if ($pasienId) {
            // Ambil data pasien berdasarkan ID
            $selectedPasien = Pasien::with('kelurahan.kecamatan')->find($pasienId);
    
            // Ambil rekam medis pasien yang dipilih
            $rekamMedis = Pendaftaran::with('pasien', 'poli', 'practitioner')
                ->where('pasien_id', $pasienId)
                ->orderBy('tglDaftar')
                ->get();
        }
    
        return view('dashboard.main-menu.rekam-medis.index', compact('pasiens', 'rekamMedis', 'selectedPasien'));
    }
}
