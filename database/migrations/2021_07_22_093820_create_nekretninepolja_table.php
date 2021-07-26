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
            $table->string('nekretnine_vrsta');
            $table->foreign('nekretnine_vrsta')->references('tip')->on('nekretnine');
            $table->string('kvadratura');
            $table->string('opis');
            $table->string('tip_vlasnistva');
            $table->string('lokacija');
            $table->string('cijena');
            $table->string('kontakt');
            $table->string('slika');
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
        Schema::dropIfExists('nekretninepolja');
    }
}
