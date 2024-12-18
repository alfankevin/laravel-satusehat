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
        Schema::create('pasien_obats', function (Blueprint $table) {
            $table->id(); // Kolom id sebagai primary key
            $table->unsignedBigInteger('pasien_id'); // Kolom pasien_id (foreign key)
            $table->unsignedBigInteger('obat_id'); // Kolom obat_id (foreign key)
            $table->integer('jumlah_obat');
            $table->string('instruksi');
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at secara otomatis

            // Definisikan foreign key
            $table->foreign('pasien_id')->references('id')->on('pasiens')->onDelete('cascade');
            $table->foreign('obat_id')->references('id')->on('obats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien_obats');
    }
};
