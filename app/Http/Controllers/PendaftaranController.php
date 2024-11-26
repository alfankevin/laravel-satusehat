<?php

namespace App\Http\Controllers;

use App\Http\Requests\PendaftaranStoreRequest;
use App\Http\Requests\PendaftaranUpdateRequest;
use App\Models\Poli;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Practitioner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PendaftaranController extends Controller
{
    public function index(Request $request): View
    {
        $pendaftarans = Pendaftaran::with('pasien', 'poli', 'practitioner')->orderBy('tglDaftar')->get();

        $polis = Poli::orderBy('namaPoli')->get();
        $pasiens = Pasien::orderBy('nama')->get();
        $practitioners = Practitioner::orderBy('namaPractitioner')->get();

        return view('dashboard.main-menu.pendaftaran.index', compact('pendaftarans', 'polis', 'pasiens', 'practitioners'));
    }

    public function create(Request $request): View
    {
        $polis = Poli::orderBy('namaPoli')->get();
        $pasiens = Pasien::orderBy('nama')->get();
        $practitioners = Practitioner::orderBy('namaPractitioner')->get();

        return view('dashboard.main-menu.pendaftaran.create', compact('polis', 'pasiens', 'practitioners'));
    }

    public function store(PendaftaranStoreRequest $request): RedirectResponse
    {
        // Ambil noAntrian terakhir
        $lastPendaftaran = Pendaftaran::latest('id')->first();
        $lastNumber = 0;

        // Jika ada data sebelumnya, ambil angka terakhir dari noAntrian
        if ($lastPendaftaran && preg_match('/A-(\d+)/', $lastPendaftaran->noAntrian, $matches)) {
            $lastNumber = (int) $matches[1];
        }

        // Hitung nomor antrian baru
        $newNumber = $lastNumber + 1;

        // Format nomor antrian baru (contoh: A-01, A-02)
        $newNoAntrian = 'A-' . str_pad($newNumber, 2, '0', STR_PAD_LEFT);

        // Buat pendaftaran baru dengan noAntrian
        $pendaftaran = Pendaftaran::create(array_merge(
            $request->validated(),
            ['noAntrian' => $newNoAntrian]
        ));

        // Redirect ke halaman kunjungan
        return redirect()->route('kunjungan.index')->with('success', 'Create Kunjungan Successfully!');
    }


    public function update(PendaftaranUpdateRequest $request, Pendaftaran $pendaftaran): RedirectResponse
    {
        $pendaftaran->save();

        return redirect()->route('kunjungan.index');
    }

    public function destroy(Request $request, Pendaftaran $pendaftaran): RedirectResponse
    {
        $pendaftaran->delete();

        return redirect()->route('kunjungan.index')->with('success', 'Delete Kunjungan Successfully!');
    }
}
