<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('nomor_str');
            $table->string('no_handphone');
            $table->unsignedBigInteger('province_id');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->unsignedBigInteger('regencie_id');
            $table->foreign('regencie_id')->references('id')->on('regencies');
            $table->string('pengurus');
            $table->string('lama_seminar');
            $table->string('hari_seminar')->nullable();
            $table->string('kode_unik')->unique();
            $table->string('is_verified');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesertas');
    }
};
