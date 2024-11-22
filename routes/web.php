<?php

use App\Http\Controllers\ProfileController;
use App\Exports\TindakanExport;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\SoapController;
use App\Models\Soap;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::view('/dashboard', 'dashboard.dashboard')->name('dashboard');
    Route::resource('pasien', PasienController::class);
    Route::get('/pasien-create', [PasienController::class, 'create'])->name('pasien.create');
    Route::resource('kunjungan', PendaftaranController::class);
    Route::get('/kunjungan-create', [PendaftaranController::class, 'create'])->name('kunjungan.create');
    Route::resource('antrian', PemeriksaanController::class);
    Route::post('/soap', [SoapController::class, 'store'])->name('soap.store');
    Route::view('/rekam-medis', 'dashboard.main-menu.rekam-medis.index')->name('rekam-medis.index');
    Route::get('/antrian-pemeriksaan/{id}', [PemeriksaanController::class, 'create'])->name('antrian.pemeriksaan');
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


Route::resource('pasiens', App\Http\Controllers\PasienController::class)->except('create', 'edit', 'show');
Route::resource('practitioners', App\Http\Controllers\PractitionerController::class)->except('create', 'edit', 'show');
Route::resource('pendaftarans', App\Http\Controllers\PendaftaranController::class)->except('create', 'edit', 'show');
