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
        Schema::create('image_artikels', function (Blueprint $table) {
            $table->increments('id_image_artikels');
            $table->unsignedInteger('artikel_id');
            $table->string('gambar');
            $table->timestamps();

            $table->foreign('artikel_id')->references('id_artikels')->on('artikels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_artikels');
    }
};
