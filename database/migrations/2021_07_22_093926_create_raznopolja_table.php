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
            $table->bigInteger('razno_vrsta')->unsigned();
            $table->foreign('razno_vrsta')->references('id')->on('razno');
            $table->string('naziv');
            $table->string('opis')->nullable();
            $table->string('lokacija')->nullable();
            $table->float('cijena');
            $table->string('kontakt')->nullable();
            $table->string('stanje')->nullable();
            $table->float('sirina')->nullable();
            $table->float('duzina')->nullable();
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
