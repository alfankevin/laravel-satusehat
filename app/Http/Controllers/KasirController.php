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
        // Ambil pendaftaran dengan relasi yang dibutuhkan
        $pendaftarans = Pendaftaran::with(
            'pasien',
            'poli',
            'obat.obat',
            'laborat.kategoriPemeriksaan',
            'laborat.practitioner',
            'diagnosa.diagnosa',
            'tindakan.tindakan',
            'tindakan.practitioner'
        )->findOrFail($id);

        // Hitung total fee obat
        $totalFeeObat = $pendaftarans->obat->sum(function ($data) {
            return $data->harga_obat * $data->jumlah_obat;
        });

        // Hitung total fee tindakan
        $totalFeeTindakan = $pendaftarans->tindakan->sum('biaya');

        // Hitung total fee laborat
        $totalFeeLaborat = $pendaftarans->laborat->sum('biaya');        

        // Kirim data ke view
        return view('dashboard.main-menu.kasir.bayar', compact( 'pendaftarans', 'totalFeeObat', 'totalFeeTindakan', 'totalFeeLaborat'));
    }

    public function cetakKwitansi($id)
    {
        // Ambil data pendaftaran dengan relasi terkait
        $pendaftaran = Pendaftaran::with(
            'pasien',
            'poli',
            'laborat.kategoriPemeriksaan',
            'practitioner',
            'bayar',
        )->findOrFail($id);

        // Kirim data ke view
        return view('dashboard.main-menu.kasir.kwitansi', compact('pendaftaran'));
    }
}
