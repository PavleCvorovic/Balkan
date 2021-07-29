<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdjecapoljaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odjecapolja', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('odjeca_vrsta')->unsigned();
            $table->foreign('odjeca_vrsta')->references('id')->on('odjeca');
            $table->string('naziv');
            $table->string('opis');
            $table->string('stanje');
            $table->string('lokacija');
            $table->string('cijena');
            $table->string('kontakt');
            $table->float('sirina');
            $table->float('duzina');
            $table->string('user');
            $table->string('dimenzije');

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
        Schema::dropIfExists('odjecapolja');
    }
}
