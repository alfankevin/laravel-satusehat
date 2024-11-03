<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class TindakanExport implements FromView
{
    public function view(): View
    {
        // Data dummy untuk tabel Tindakan
        $data = collect([
            ['No' => 1, 'Nama Tindakan' => 'Nebulizer (Inhalasi)', 'Tarif Tindakan' => 75000, 'Fee Dokter' => 75000, 'Fee Asisten' => 0, 'Fee Klinik' => 0, 'Poliklinik' => 'Poli Umum', 'Status' => 'Aktif'],
            ['No' => 2, 'Nama Tindakan' => 'Imunisasi Tetanus', 'Tarif Tindakan' => 100000, 'Fee Dokter' => 80000, 'Fee Asisten' => 10000, 'Fee Klinik' => 10000, 'Poliklinik' => 'Poli Umum', 'Status' => 'Aktif'],
            ['No' => 3, 'Nama Tindakan' => 'Hecting', 'Tarif Tindakan' => 100000, 'Fee Dokter' => 70000, 'Fee Asisten' => 3000, 'Fee Klinik' => 27000, 'Poliklinik' => 'Poli Umum', 'Status' => 'Aktif'],
        ]);

        return view('exports.tindakan', compact('data'));
    }
}
