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
            $table->string('opis')->nullable();
            $table->string('stanje')->nullable();
            $table->string('lokacija')->nullable();
            $table->float('cijena');
            $table->string('kontakt');
            $table->float('sirina')->nullable();
            $table->float('duzina')->nullable();
            $table->string('user');
            $table->string('dimenzije')->nullable();

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
