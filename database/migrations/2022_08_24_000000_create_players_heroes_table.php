<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersHeroesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players_heroes', function (Blueprint $table) {
            $table->id();
            $table->integer('player_id')->index();
            $table->integer('hero_id')->index();
            $table->integer('level');
            $table->integer('power');
            $table->tinyInteger('stars');
            $table->tinyInteger('range_color');
            $table->integer('stat_vitality');
            $table->integer('stat_physical_attack');
            $table->integer('stat_magik_attack');
            $table->integer('stat_physical_defense');
            $table->integer('stat_magik_defense');
            $table->integer('stat_physical_penetration');
            $table->integer('stat_magik_penetration');
            $table->integer('stat_dodge');
            $table->integer('stat_vampirism');
            $table->integer('stat_critical_hit');
            $table->unique(['player_id', 'hero_id'], 'pk_players_heroes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players_heroes');
    }
}
