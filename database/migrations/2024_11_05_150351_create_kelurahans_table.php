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
        Schema::create('kelurahans', function (Blueprint $table) {
            $table->id();
            $table->string('KD_KELURAHAN')->unique(); // Kolom unik untuk KD_KELURAHAN
            $table->string('KD_KECAMATAN'); // Kolom untuk foreign key ke kecamatans (bukan ID)
            $table->foreign('KD_KECAMATAN') // Definisikan foreign key
                  ->references('KD_KECAMATAN') // Kolom referensi di tabel kecamatans
                  ->on('kecamatans') // Tabel tujuan
                  ->onDelete('cascade') // Cascade delete jika kecamatan dihapus
                  ->onUpdate('cascade'); // Cascade update jika KD_KECAMATAN berubah
            $table->string('KELURAHAN');
            $table->string('ninput_oleh')->nullable();
            $table->string('ninput_tgl')->nullable();
            $table->string('nupdate_oleh')->nullable();
            $table->string('nupdate_tgl')->nullable();
            $table->timestamps();
        });
        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelurahans');
    }
};
