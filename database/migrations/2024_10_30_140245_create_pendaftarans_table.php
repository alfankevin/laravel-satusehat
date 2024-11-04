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
            $table->string('keluhan');
            $table->string('kunjSakit');
            $table->float('sistole');
            $table->float('diastole');
            $table->float('beratBadan');
            $table->float('tinggiBadan');
            $table->float('respRate');
            $table->float('lingkarPerut');
            $table->float('heartRate');
            $table->integer('rujukBalik');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->dateTime('deleted_at');
            $table->integer('deleted_by');
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
