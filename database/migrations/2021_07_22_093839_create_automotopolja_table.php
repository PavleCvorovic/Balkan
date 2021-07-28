<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutomotopoljaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automotopolja', function (Blueprint $table) {
            $table->id();
            $table->string('automoto_vrsta');
            $table->foreign('automoto_vrsta')->references('tip')->on('automoto');
            $table->string('naziv');
            $table->string('marka');
            $table->string('model');
            $table->string('godina_proizvodnje');
            $table->string('kilometraza');
            $table->string('kubikaza');
            $table->string('boja');
            $table->boolean('registrovan');
            $table->string('datum_isteka');
            $table->string('opis');
            $table->string('stanje');
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
        Schema::dropIfExists('automotopolja');
    }
}
