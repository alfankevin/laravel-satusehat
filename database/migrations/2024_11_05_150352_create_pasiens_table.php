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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nomorRm');
            $table->string('noKartu');
            $table->string('nama');
            $table->char('sex', 1);
            $table->date('tglLahir');
            $table->integer('jnsPeserta');
            $table->string('golDarah');
            $table->string('noHp');
            $table->string('noKtp');
            $table->string('pstProl');
            $table->string('pstPrb');
            $table->boolean('aktif');
            $table->string('ketAktif');
            $table->string('alamat');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->foreignId('KD_KELURAHAN')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
