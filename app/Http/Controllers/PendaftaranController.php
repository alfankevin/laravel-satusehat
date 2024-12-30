<?php

namespace App\Http\Controllers;

use App\Http\Requests\PendaftaranStoreRequest;
use App\Http\Requests\PendaftaranUpdateRequest;
use App\Models\Kelurahan;
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
        $query = Pendaftaran::with('pasien', 'poli', 'practitioner')->orderBy('tglDaftar');

        // Filter berdasarkan input pengguna
        if ($request->filled('no_rm')) {
            $query->whereHas('pasien', function ($q) use ($request) {
                $q->where('nomorRm', 'like', '%' . $request->no_rm . '%');
            });
        }

        if ($request->filled('nama_pasien')) {
            $query->whereHas('pasien', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->nama_pasien . '%');
            });
        }

        if ($request->filled('tgl_daftar')) {
            $query->whereDate('tglDaftar', $request->tgl_daftar);
        }

        $pendaftarans = $query->get();
        $polis = Poli::orderBy('namaPoli')->get();
        $pasiens = Pasien::orderBy('nama')->get();
        $practitioners = Practitioner::orderBy('namaPractitioner')->get();

        $latestPasien = Pasien::orderBy('nomorRm', 'desc')->first();
        $nomorRm = $latestPasien->nomorRm + 1;
        $kelurahans = Kelurahan::with('kecamatan.kabupaten.provinsi')->get();
        $pasienBaru = $request->get('pasienBaru') ? Pasien::find($request->get('pasienBaru')) : null;


        $selectedPasienId = session('newPasien')['id'] ?? null; // Nilai default dari session
        return view('dashboard.main-menu.pendaftaran.index', compact('selectedPasienId','pendaftarans', 'polis', 'pasiens', 'practitioners', 'nomorRm', 'kelurahans', 'pasienBaru'));
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

        // Redirect ke route antrian-pemeriksaan dengan ID pendaftaran
        return redirect()->route('antrian.pemeriksaan', ['id' => $pendaftaran->id])
            ->with('success', 'Create Kunjungan Successfully!');
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
