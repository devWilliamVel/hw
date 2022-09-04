<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersPetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players_pets', function (Blueprint $table) {
            $table->id();
            $table->integer('player_id')->index();
            $table->integer('pet_id')->index();
            $table->integer('level')->nullable();
            $table->integer('power')->nullable();
            $table->tinyInteger('stars')->nullable();
            $table->tinyInteger('range_color')->nullable();
            $table->unique(['player_id', 'pet_id'], 'pk_players_pets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players_pets');
    }
}
