<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('pasiens', App\Http\Controllers\PasienController::class)->except('create', 'edit', 'show');

Route::resource('polis', App\Http\Controllers\PoliController::class)->except('create', 'edit', 'show');

Route::resource('practitioners', App\Http\Controllers\PractitionerController::class)->except('create', 'edit', 'show');

Route::resource('practitioner-groups', App\Http\Controllers\PractitionerGroupController::class)->except('create', 'edit', 'show');

Route::resource('pendaftarans', App\Http\Controllers\PendaftaranController::class)->except('create', 'edit', 'show');
