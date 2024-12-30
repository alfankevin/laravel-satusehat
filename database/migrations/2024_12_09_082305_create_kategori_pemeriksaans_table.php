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

        Schema::create('kategori_pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->string('pemeriksaan');
            $table->string('satuan');
            $table->string('nilai_normal');
            $table->float('biaya');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_pemeriksaans');
    }
};
