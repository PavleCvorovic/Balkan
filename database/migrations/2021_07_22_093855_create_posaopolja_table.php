<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosaopoljaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posaopolja', function (Blueprint $table) {
            $table->id();
            $table->string('posao_vrsta');
            $table->foreign('posao_vrsta')->references('tip')->on('posao');
            $table->string('naziv');
            $table->string('opis');
            $table->string('lokacija');
            $table->string('plata');
            $table->string('kontakt');

            $table->float('sirina');
            $table->float('duzina');
            $table->string('user');

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
        Schema::dropIfExists('posaopolja');
    }
}
