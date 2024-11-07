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
        Schema::create('kecamatans', function (Blueprint $table) {
            $table->id();
            $table->string('KD_KECAMATAN');
            $table->string('KD_KABUPATEN');
            $table->string('KECAMATAN');
            $table->string('ninput_oleh')->nullable();
            $table->string('ninput_tgl')->nullable();
            $table->string('nupdate_oleh')->nullable();
            $table->string('nupdate_tgl')->nullable();
            $table->unique('KD_KECAMATAN');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kecamatans');
    }
};
