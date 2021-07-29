<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTehnikapoljaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tehnikapolja', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tehnika_vrsta')->unsigned();
            $table->foreign('tehnika_vrsta')->references('id')->on('tehnika');
            $table->string('naziv');
            $table->string('opis');
            $table->string('stanje');
            $table->string('lokacija');
            $table->string('cijena');
            $table->string('kontakt');

            $table->float('sirina');
            $table->float('duzina');
            $table->string('user');
            $table->string('karakteristike');
            $table->string('godina_proizvodnje');







        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tehnikapolja');
    }
}
