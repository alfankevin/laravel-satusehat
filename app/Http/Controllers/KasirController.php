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
            ->orderBy('created_at', 'asc')
            ->get();

        return view('dashboard.main-menu.kasir.index', compact('pendaftarans'));
    }

    public function bayar($id)
    {
        try {
            // Ambil data pendaftaran beserta relasi yang diperlukan
            $pendaftarans = Pendaftaran::with([
                'pasien',
                'poli',
                'obat.obat',
                'laborat.kategoriPemeriksaan',
                'laborat.practitioner',
                'diagnosa.diagnosa',
                'tindakan.tindakan',
                'tindakan.practitioner'
            ])->findOrFail($id);

            // Hitung total biaya dari setiap kategori
            $totalFeeObat = $pendaftarans->obat->sum(function ($obat) {
                return $obat->harga_obat * $obat->jumlah_obat;
            });

            $totalFeeTindakan = $pendaftarans->tindakan->sum('biaya');
            $totalFeeLaborat = $pendaftarans->laborat->sum('biaya');

            // Hitung subtotal keseluruhan
            $subtotalTagihan = $totalFeeObat + $totalFeeTindakan + $totalFeeLaborat;

            // Kirim data ke view
            return view('dashboard.main-menu.kasir.bayar', [
                'pendaftarans' => $pendaftarans,
                'totalFeeObat' => $totalFeeObat,
                'totalFeeTindakan' => $totalFeeTindakan,
                'totalFeeLaborat' => $totalFeeLaborat,
                'subtotalTagihan' => $subtotalTagihan
            ]);
        } catch (\Exception $e) {
            // Handle error jika terjadi kesalahan
            return redirect()->back()->withErrors([
                'error' => 'Terjadi kesalahan saat memuat data pembayaran: ' . $e->getMessage()
            ]);
        }
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
