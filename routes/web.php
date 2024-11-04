<?php

use App\Http\Controllers\ProfileController;
use App\Exports\TindakanExport;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::view('/dashboard', 'dashboard.dashboard')->name('dashboard');
    Route::view('/pasien', 'dashboard.main-menu.pasien.index')->name('pasien.index');
    Route::view('/pasien-create', 'dashboard.main-menu.pasien.create')->name('pasien.create');
    Route::view('/kunjungan', 'dashboard.main-menu.pendaftaran.index')->name('kunjungan.index');
    Route::view('/kunjungan-create', 'dashboard.main-menu.pendaftaran.create')->name('kunjungan.create');
    Route::view('/antrian', 'dashboard.main-menu.antrian.index')->name('antrian.index');
    Route::view('/antrian-pemeriksaan', 'dashboard.main-menu.antrian.pemeriksaan')->name('antrian.pemeriksaan');
    Route::view('/farmasi', 'dashboard.main-menu.farmasi.index')->name('farmasi.index');
    Route::view('/kasir', 'dashboard.main-menu.kasir.index')->name('kasir.index');

    Route::view('/obat', 'dashboard.master-data.obat.index')->name('obat.index');
    Route::view('/tindakan', 'dashboard.master-data.tindakan.index')->name('tindakan.index');
    Route::view('/diagnosa', 'dashboard.master-data.diagnosa.index')->name('diagnosa.index');
    Route::view('/poli', 'dashboard.master-data.poli.index')->name('poli.index');
    Route::view('/practitioner', 'dashboard.master-data.practitioner.index')->name('practitioner.index');
    Route::view('/practitioner-group', 'dashboard.master-data.practitioner-group.index')->name('practitioner-group.index');
    Route::view('/alamat', 'dashboard.master-data.alamat.index')->name('alamat.index');
});

Route::get('/export-tindakan', function () {
    return Excel::download(new TindakanExport, 'data_tindakan.xlsx');
})->name('export.tindakan');

require __DIR__ . '/auth.php';
