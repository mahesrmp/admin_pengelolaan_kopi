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
        Schema::create('pascas', function (Blueprint $table) {
            $table->id();
            $table->string('tahapan');
            $table->text('deskripsi');
            $table->string('link');
            $table->string('sumber_artikel');
            $table->string('credit_gambar');
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
        Schema::dropIfExists('pascas');
    }
};
