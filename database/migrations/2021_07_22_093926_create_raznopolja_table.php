<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaznopoljaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raznopolja', function (Blueprint $table) {
            $table->id();
            $table->string('razno_vrsta');
            $table->foreign('razno_vrsta')->references('tip')->on('razno');
            $table->string('naziv');
            $table->string('opis');
            $table->string('lokacija');
            $table->string('cijena');
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
        Schema::dropIfExists('raznopolja');
    }
}
