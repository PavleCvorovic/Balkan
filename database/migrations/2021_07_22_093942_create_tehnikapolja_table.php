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
            $table->string('opis')->nullable();
            $table->string('stanje')->nullable();
            $table->string('lokacija')->nullable();
            $table->float('cijena');
            $table->string('kontakt');

            $table->float('sirina')->nullable();
            $table->float('duzina')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('karakteristike')->nullable();
            $table->integer('godina_proizvodnje')->nullable();







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
