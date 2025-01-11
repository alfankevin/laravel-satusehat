<?php

use App\Http\Controllers\ProfileController;
use App\Exports\TindakanExport;
use App\Http\Controllers\AppInfoController;
use App\Http\Controllers\BayarController;
use App\Http\Controllers\BundleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LaboratController;
use App\Http\Controllers\ObatController;
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
use App\Http\Controllers\PasienPemeriksaanController;
use App\Http\Controllers\PasienDiagnosaController;
use App\Http\Controllers\PasienTindakanController;
use App\Http\Controllers\PasienObatController;
use App\Http\Controllers\SatusehatController;
use App\Http\Controllers\TindakanController;
use Symfony\Component\HttpKernel\Bundle\Bundle;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard',[ DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pasien', PasienController::class);
    Route::get('/pasien-create', [PasienController::class, 'create'])->name('pasien.create');
    Route::resource('kunjungan', PendaftaranController::class);
    Route::get('/kunjungan-create', [PendaftaranController::class, 'create'])->name('kunjungan.create');
    Route::delete('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');


    Route::resource('antrian', PemeriksaanController::class);
    Route::post('/soap', [SoapController::class, 'store'])->name('soap.store');
    Route::get('/rekam-medis', [RekamMedisController::class, 'index'])->name('rekam-medis.index');
    Route::get('/antrian-pemeriksaan/{id}', [PemeriksaanController::class, 'create'])->name('antrian.pemeriksaan');
    Route::get('/rekam-medis/cetak/{id}', [RekamMedisController::class, 'cetak'])->name('rekam-medis.cetak');

    Route::resource('pasien-laborat', PasienPemeriksaanController::class);
    Route::resource('pasien-diagnosa', PasienDiagnosaController::class);
    Route::resource('pasien-tindakan', PasienTindakanController::class);
    Route::resource('pasien-obat', PasienObatController::class);

    Route::resource('obat', ObatController::class);
    Route::resource('tindakan', TindakanController::class)->except('show');

    Route::resource('laborat', LaboratController::class);
    Route::resource('diagnosa', DiagnosaController::class);
    
    Route::view('/farmasi', 'dashboard.main-menu.farmasi.index')->name('farmasi.index');
    Route::view('/users', 'dashboard.master-data.user.index')->name('users.index');
    // Route::view('/modul', 'dashboard.master-data.modul.index')->name('modul.index');

    Route::get('/kasir',[KasirController::class, 'index'])->name('kasir.index');
    Route::get('/bayar/{id}',[KasirController::class, 'bayar'])->name('kasir.bayar');
    Route::get('/kasir/kwitansi/{id}', [KasirController::class, 'cetakKwitansi'])->name('kasir.cetak-kwitansi');

    Route::post('/bayar', [BayarController::class, 'store'])->name('bayar.store');

    // Route::view('/poli', 'dashboard.master-data.poli.index')->name('poli.index');
    Route::get('/poli', [PoliController::class, 'index'])->name('poli.index');
    Route::post('/poli/store', [PoliController::class, 'store'])->name('poli.store');
    Route::put('/poli/{id}', [PoliController::class, 'update'])->name('poli.update');
    Route::delete('/poli/{poli}', [PoliController::class, 'destroy'])->name('poli.destroy');

    Route::resource('practitioner', PractitionerController::class);
    Route::resource('practitioner-group', PractitionerGroupController::class);

});

Route::get('tindakan/export', [TindakanController::class, 'export'])->name('tindakan.export');
Route::post('tindakan/import', [TindakanController::class, 'import'])->name('tindakan.import');

require __DIR__ . '/auth.php';

Route::view('/404', 'dashboard.main-menu.pendaftaran.404')->name('404');
Route::view('/hasil', 'dashboard.main-menu.rekam-medis.hasil-lab')->name('hasil');

Route::resource('pasiens', App\Http\Controllers\PasienController::class)->except('create', 'edit', 'show');
Route::resource('practitioners', App\Http\Controllers\PractitionerController::class)->except('create', 'edit', 'show');
Route::resource('pendaftarans', App\Http\Controllers\PendaftaranController::class)->except('create', 'edit', 'show');



// sinkronisasi data pasien dengan API SatuSehat
Route::post('/sync-satusehat', [SatusehatController::class, 'syncSatusehat'])->name('sync.satusehat');
Route::post('/sync-all-satusehat', [SatusehatController::class, 'syncAllPatients'])->name('sync.all.satusehat');

//setting brigging satusehat
Route::post('/satusehat', [SatusehatController::class, 'storeOrUpdate'])->name('satusehat.store');
Route::get('/modul', [SatusehatController::class, 'index'])->name('modul.index');

// sinkronisasi data practitioner dengan API SatuSehat
Route::post('/sync-all-practitioner', [SatusehatController::class, 'syncAllPractitioner'])->name('sync.all.practitioner');

//dapatkan id satusehat pasien berdasarkan NIK
Route::get('/nik', [PasienController::class, 'getPatientByNIK'])->name('patient.byNIK');

//dapatkan id satusehat practitioner berdasarkan NIK
Route::get('practitioner-nik', [PractitionerController::class, 'getPractitionerByNIK'])->name('practitioner.byNIK');

Route::post('/app-info', [AppInfoController::class, 'store'])->name('app.info.store');


Route::get('/bundle', [BundleController::class, 'index'])->name('bundle.index');
Route::post('/bundle', [BundleController::class, 'storeBundle'])->name('bundle.store');
Route::post('/bundle-api', [BundleController::class, 'storeBundleApi'])->name('bundleapi.store');

Route::post('/api/store-bundle/{id}', [BundleController::class, 'storeBundle']);