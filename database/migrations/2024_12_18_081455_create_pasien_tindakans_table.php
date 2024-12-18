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
        Schema::create('pasien_tindakans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasien_id');
            $table->unsignedBigInteger('practitioner_id');
            $table->foreignId('tindakan_id')->constrained();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('pasien_id')->references('id')->on('pasiens')->onDelete('cascade');
            $table->foreign('practitioner_id')->references('id')->on('practitioners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien_tindakans');
    }
};
