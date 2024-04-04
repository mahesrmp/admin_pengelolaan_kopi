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
        Schema::create('permintaan_pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kopi');
            $table->string('gambar')->nullable();
            $table->string('harga');
            $table->integer('stok');
            $table->string('lokasi_pengiriman');
            $table->text('deskripsi');
            $table->string('pembeli');
            $table->string('kualitas');
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('permintaan_pembelians');
    }
};
