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
            $table->bigInteger('automoto_vrsta')->unsigned();
            $table->foreign('automoto_vrsta')->references('id')->on('automoto');
            $table->string('naziv');
            $table->string('marka');
            $table->string('model');
            $table->integer('cijena');
            $table->string('kontakt');
            $table->string('index');
            $table->string('stanje')->nullable();
            $table->integer('godina_proizvodnje')->nullable();
            $table->integer('kilometraza')->nullable();
            $table->integer('kubikaza')->nullable();
            $table->string('boja')->nullable();
            $table->boolean('registrovan')->nullable();
            $table->string('datum_isteka')->nullable();
            $table->string('opis')->nullable();
            $table->string('lokacija')->nullable();
            $table->float('sirina')->nullable();
            $table->float('duzina')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
