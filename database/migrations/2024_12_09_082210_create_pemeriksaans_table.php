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
        Schema::disableForeignKeyConstraints();

        Schema::create('pasien_pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kunjungan_id');
            $table->foreignId('kategori_pemeriksaan_id')->constrained();
            $table->string('hasil_pemeriksaan');
            $table->float('biaya');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('kunjungan_id')->references('id')->on('pendaftarans')->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien_pemeriksaans');
    }
};
