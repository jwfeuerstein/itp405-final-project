<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lineups', function (Blueprint $table) {
            $table->id();
            $table->text("name");
            $table->integer('player1_id')->unsigned();
            $table->foreign('player1_id')->references('id')->on('players');
            $table->integer('player2_id')->unsigned();
            $table->foreign('player2_id')->references('id')->on('players');
            $table->integer('player3_id')->unsigned();
            $table->foreign('player3_id')->references('id')->on('players');
            $table->integer('player4_id')->unsigned();
            $table->foreign('player4_id')->references('id')->on('players');
            $table->integer('player5_id')->unsigned();
            $table->foreign('player5_id')->references('id')->on('players');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lineups');
    }
}
