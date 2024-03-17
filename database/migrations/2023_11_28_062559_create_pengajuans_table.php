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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('petani_id')->unsigned();
            $table->string('foto_ktp');
            $table->string('foto_selfie');
            $table->text('deskripsi_pengalaman');
            $table->string('foto_sertifikat')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('kabupaten')->nullable();
            $table->enum('status', [0, 1, 2])->default(0);
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
        Schema::dropIfExists('pengajuans');
    }
};
