<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->date('tglDaftar');
            $table->string('keluhan')->nullable();
            $table->string('kunjSakit')->nullable();
            $table->float('sistole')->nullable();
            $table->float('diastole')->nullable();
            $table->float('beratBadan')->nullable();
            $table->float('tinggiBadan')->nullable();
            $table->float('respRate')->nullable();
            $table->float('lingkarPerut')->nullable();
            $table->float('heartRate')->nullable();
            $table->integer('rujukBalik')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->foreignId('pasien_id');
            $table->foreignId('poli_id');
            $table->foreignId('practitioner_id');
            $table->foreignId('tkp_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
