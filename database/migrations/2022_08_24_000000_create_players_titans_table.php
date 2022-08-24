<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTitansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players_titans', function (Blueprint $table) {
            $table->id();
            $table->integer('player_id')->index();
            $table->integer('titan_id')->index();
            $table->integer('level');
            $table->integer('power');
            $table->tinyInteger('stars');
            $table->tinyInteger('range_color');
            $table->integer('stat_vitality');
            $table->integer('stat_attack');
            $table->integer('stat_elemental_damage');
            $table->integer('stat_elemental_armor');
            $table->unique(['player_id', 'titan_id'], 'pk_players_titans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players_titans');
    }
}
