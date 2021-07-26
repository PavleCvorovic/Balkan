<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHranapoljaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hranapolja', function (Blueprint $table) {
            $table->id();
            $table->string('hrana_vrsta');
            $table->foreign('hrana_vrsta')->references('tip')->on('hrana_ipice');
            $table->boolean('domace');
            $table->string('naziv');
            $table->string('opis');
            $table->string('kolicina');
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
        Schema::dropIfExists('hranapolja');
    }
}
