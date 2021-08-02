<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNekretninepoljaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nekretninepolja', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nekretnine_vrsta')->unsigned();
            $table->foreign('nekretnine_vrsta')->references('id')->on('nekretnine');
            $table->string('naziv');
            $table->float('kvadratura');
            $table->string('opis')->nullable();
            $table->string('tip_vlasnistva');
            $table->string('lokacija')->nullable();
            $table->integer('cijena');
            $table->string('kontakt');
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
        Schema::dropIfExists('nekretninepolja');
    }
}
