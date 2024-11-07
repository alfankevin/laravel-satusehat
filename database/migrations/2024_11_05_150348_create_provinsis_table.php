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
        Schema::create('provinsis', function (Blueprint $table) {
            $table->id();
            $table->string('KD_PROVINSI');
            $table->string('PROVINSI');
            $table->string('ninput_oleh')->nullable();
            $table->string('ninput_tgl')->nullable();
            $table->string('nupdate_oleh')->nullable();
            $table->string('nupdate_tgl')->nullable();
            $table->unique('KD_PROVINSI');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinsis');
    }
};
