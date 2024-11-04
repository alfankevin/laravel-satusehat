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
            $table->integer('nomorRm');
            $table->string('noKartu', 13);
            $table->string('nama');
            $table->string('hubunganKeluarga');
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
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->dateTime('deleted_at');
            $table->integer('deleted_by');
            $table->foreignId('kelurahan_id');
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
