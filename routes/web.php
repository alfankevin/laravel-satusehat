<?php

use App\Http\Controllers\ProfileController;
use App\Exports\TindakanExport;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PemeriksaanController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\PractitionerController;
use App\Http\Controllers\PractitionerGroupController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\SoapController;


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
    Route::get('/rekam-medis', [RekamMedisController::class, 'index'])->name('rekam-medis.index');
    Route::get('/antrian-pemeriksaan/{id}', [PemeriksaanController::class, 'create'])->name('antrian.pemeriksaan');
    Route::get('/rekam-medis/fetch', [RekamMedisController::class, 'fetch'])->name('rekam-medis.fetch');

    Route::view('/obat', 'dashboard.master-data.obat.index')->name('obat.index');
    Route::view('/tindakan', 'dashboard.master-data.tindakan.index')->name('tindakan.index');
    Route::view('/diagnosa', 'dashboard.master-data.diagnosa.index')->name('diagnosa.index');
    Route::view('/farmasi', 'dashboard.main-menu.farmasi.index')->name('farmasi.index');

    Route::get('/kasir',[KasirController::class, 'index'])->name('kasir.index');

    // Route::view('/poli', 'dashboard.master-data.poli.index')->name('poli.index');
    Route::get('/poli', [PoliController::class, 'index'])->name('poli.index');
    Route::post('/poli/store', [PoliController::class, 'store'])->name('poli.store');
    Route::put('/poli/{id}', [PoliController::class, 'update'])->name('poli.update');
    Route::delete('/poli/{poli}', [PoliController::class, 'destroy'])->name('poli.destroy');

    Route::get('/practitioner', [PractitionerController::class, 'index'])->name('practitioner.index');
    Route::post('/practitioner/store', [PractitionerController::class, 'store'])->name('practitioner.store');
    Route::delete('/practitioner/{practitioner}', [PractitionerController::class, 'destroy'])->name('practitioner.destroy');

    Route::get('/practitioner-group', [PractitionerGroupController::class, 'index'])->name('practitioner-group.index');
    Route::post('/practitioner-group/store', [PractitionerGroupController::class, 'store'])->name('practitioner-group.store');
    Route::delete('/practitioner-group/{practitionerGroup}', [PractitionerGroupController::class, 'destroy'])->name('practitioner-group.destroy');

});

Route::get('/export-tindakan', function () {
    return Excel::download(new TindakanExport, 'data_tindakan.xlsx');
})->name('export.tindakan');

require __DIR__ . '/auth.php';

Route::view('/404', 'dashboard.main-menu.pendaftaran.404')->name('404');

Route::resource('pasiens', App\Http\Controllers\PasienController::class)->except('create', 'edit', 'show');
Route::resource('practitioners', App\Http\Controllers\PractitionerController::class)->except('create', 'edit', 'show');
Route::resource('pendaftarans', App\Http\Controllers\PendaftaranController::class)->except('create', 'edit', 'show');
