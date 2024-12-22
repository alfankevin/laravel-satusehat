<?php

namespace App\Http\Controllers;

use App\Http\Requests\PemeriksaanStoreRequest;
use App\Http\Requests\PemeriksaanUpdateRequest;
use App\Http\Requests\PendaftaranUpdateRequest;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PemeriksaanController extends Controller
{
    public function index(Request $request): View
    {
        // Ambil kunjungan dengan status 'Pending' atau 'InProgress', diurutkan dari yang paling lama dibuat
        $pendaftarans = Pendaftaran::with('pasien')
        ->where('status', 0) // Menampilkan data dengan status = 0
        ->orderBy('created_at', 'asc')
        ->get();
    

        // Tentukan antrian sekarang (kunjungan pertama dengan status Pending)
        $antrian_sekarang = $pendaftarans->first() ? $pendaftarans->first()->noAntrian : null;

        // Tentukan antrian selanjutnya (kunjungan setelah antrian sekarang)
        $antrian_selanjutnya = $pendaftarans->skip(1)->first() ? $pendaftarans->skip(1)->first()->noAntrian : null;

        return view('dashboard.main-menu.antrian.index', compact('pendaftarans', 'antrian_sekarang', 'antrian_selanjutnya'));
    }

    public function create(Request $request, $id): View
    {
        $pemeriksaan = Pendaftaran::with('pasien', 'poli', 'obat.obat')->where('id', $id)->first();
        // dd($pemeriksaan);
        $obats = Obat::all();

        return view('dashboard.main-menu.antrian.pemeriksaan', compact('pemeriksaan', 'obats'));
    }

    public function store(PemeriksaanStoreRequest $request): RedirectResponse
    {
        $pendaftaran = Pendaftaran::where('id', $request->input('id'))->update($request->validated());

        return redirect()->back()->with('success', 'Input Pemeriksaan Success!');
    }

    public function update(PendaftaranUpdateRequest $request, Pendaftaran $pendaftaran): RedirectResponse
    {
        $pendaftaran->save();

        return redirect()->route('antrian.index');
    }

    public function destroy(Request $request, Pendaftaran $pendaftaran): RedirectResponse
    {
        $pendaftaran->delete();

        return redirect()->route('antrian.index');
    }
}
